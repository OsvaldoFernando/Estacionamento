<?php
defined('BASEPATH') or exit('Ação não permitida');


class Usuarios extends CI_Controller
{

	/*=============================================
	 =            Verificar se o usuário está logado    =
	 =============================================*/

	public function __construct(){

		parent::__construct();

		if(!$this->ion_auth->logged_in()){
			redirect('login');
		}

	}


	/*=====  End of Section comment block  ======*/


	/*=============================================
	=            tela de listagem           =
	=============================================*/
	public function index()
	{
		$data = array(
			'titulo' => 'Usuários registrados',
			'usuarios' => $this->ion_auth->users()->result(),

			'styles' => array(
				'assets/bundles/datatables/datatables.min.css',
				'assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css',
			),

			'scripts' => array(
				'assets/bundles/datatables/datatables.min.js',
				'assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js',
				'assets/bundles/jquery-ui/jquery-ui.min.js',
				'assets/js/page/datatables.js',

			),

//			Array
//			(
//				[0] => stdClass Object
//			(
//			 [id] => 1
//           [ip_address] => 127.0.0.1
//           [username] => administrator
//			 [password] => $2y$08$200Z6ZZbp3RAEXoaWcMA6uJOFicwNZaqk4oDhqTUiFXFe63MG.Daa
//			 [email] => admin@admin.com
//			   [activation_selector] =>
//            [activation_code] =>
//            [forgotten_password_selector] =>
//            [forgotten_password_code] =>
//            [forgotten_password_time] =>
//            [remember_selector] =>
//            [remember_code] =>
//            [created_on] => 1268889823
//            [last_login] => 1268889823
//            [active] => 1
//            [first_name] => Admin
//			[last_name] => istrator
//			[company] => ADMIN
//			[phone] => 0
//            [user_id] => 1
//        )
//
//)

		);

//		echo '<pre>';
//		print_r($data['usuarios']);
////		print_r($data);
//		exit();

		$this->load->view('layout/header', $data);
		$this->load->view('usuarios/index');
		$this->load->view('layout/footer');
	}

	public function core($usuario_id = NULL)
	{

		if (!$usuario_id) {



			/**
			 *
			 * cadastro de novo usuário
			 *
			 */

			$this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('last_name', 'Sobre Nome', 'trim|required|min_length[4]|max_length[20]');
			$this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[4]|max_length[30]|is_unique[users.username]');
			$this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|required|min_length[5]|max_length[200]|is_unique[users.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]|required');
			$this->form_validation->set_rules('confirmacao', 'Confirmação', 'trim|matches[password]|required');

			if ($this->form_validation->run()) {


				//echo '<pre>';
				// print_r($this->input->post());
				// exit();


				$username = html_escape($this->input->post('username'));
				$password = html_escape($this->input->post('password'));
				$email = html_escape($this->input->post('email'));

				$additional_data = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' =>  $this->input->post('last_name'),
					'active' => $this->input->post('active')
				);

				$group = array($this->input->post('perfil'));

				//Sanitizar array
				$additional_data = html_escape($additional_data);
				$group = html_escape($group);

				/*
				  echo '<pre>';
				   print_r($username);
				   //print_r($password);
				  // print_r($email);
				  // print_r($additional_data);
				   //print_r($group);
				  exit();
				 */

				if($this->ion_auth->register($username,$password,$email,$additional_data,$group)){
					$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
				}else{
					$this->session->set_flashdata('error','Não foi possivel salvar os dados');
				}

				redirect($this->router->fetch_class());




			}else{
				//erro de validação

				$data = array(
					'titulo' => 'Registrar Usuário',
					'sub_titulo' => 'Chegou a hora de cadastrar um novo usuário',
					'icone_view' => 'ik ik-user',
				);

				//visualizar os dados
				// echo '<pre>';
				//  print_r($data);
				// exit();

				$this->load->view('layout/header', $data);
				$this->load->view('usuarios/core');
				$this->load->view('layout/footer');

			}

		} else {

			if (!$this->ion_auth->user($usuario_id)->row()) {

				exit('Usuário não existe');

			} else {

				$perfil_atual = $this->ion_auth->get_users_groups($usuario_id)->row();


				//editar usuário========================================================
				$this->form_validation->set_rules('first_name', 'Nome', 'trim|required|min_length[4]|max_length[20]');
				$this->form_validation->set_rules('last_name', 'Sobre Nome', 'trim|required|min_length[4]|max_length[20]');
				$this->form_validation->set_rules('username', 'Usuário', 'trim|required|min_length[4]|max_length[30]|callback_username_check');
				$this->form_validation->set_rules('email', 'E-mail', 'trim|valid_email|required|min_length[5]|max_length[200]|callback_email_check');
				$this->form_validation->set_rules('password', 'Password', 'trim|min_length[8]');
				$this->form_validation->set_rules('confirmacao', 'Confirmação', 'trim|matches[password]');

				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'first_name',
							'last_name',
							'username',
							'email',
							'password',
							'active',
						),$this->input->post()
					);

					//verificar se a senha vai ser alterada
					$password = $this->input->post('password');

					//não atualiza a senha, remover do array
					if(!$password){
						unset($data['password']);
					}

					//Sanitizar array
					$data = html_escape($data);

					if($this->ion_auth->update($usuario_id, $data)){

						//atualiza o perfil de acesso
						$perfil_post = $this->input->post('perfil');

						if($perfil_atual->id != $perfil_post){
							$this->ion_auth->remove_from_group($perfil_atual->id,$usuario_id);
							$this->ion_auth->add_to_group($perfil_post,$usuario_id);
						}

						$this->session->set_flashdata('sucesso','Dados atualizados com sucesso');
					}else{
						$this->session->set_flashdata('error','Não foi possivel atualizar os dados');
					}

					redirect($this->router->fetch_class());


				} else {
					//erro de validação

					$data = array(
						'titulo' => 'Editar Usuário',
						'sub_titulo' => 'Chegou a hora de editar o usuário',
						'icone_view' => 'ik ik-user',
						'usuario'  => $this->ion_auth->user($usuario_id)->row(),
						'perfil_usuario' => $this->ion_auth->get_users_groups($usuario_id)->row(),
					);

					//visualizar os dados
					// echo '<pre>';
					//  print_r($data['perfil_usuario']);
					//  exit();

					$this->load->view('layout/header', $data);
					$this->load->view('usuarios/core');
					$this->load->view('layout/footer');
				}


				//========================================================
			}
		}
	}

	/*=====  End of Section comment block  ======*/


	/*=============================================
	= validação usando callback para username e email   =
	=============================================*/


	//verificar se o usuário já existe
	public function username_check($username){

		$usuario_id = $this->input->post('usuario_id');

		if($this->core_model->get_by_id('users',array('username' => $username, 'id !=' => $usuario_id ))){
			$this->form_validation->set_message('username_check','Esse usuário já existe');
			return FALSE;
		}else{
			return TRUE;
		}
	}

	//verificar se o email já existe
	public function email_check($email){

		$usuario_id = $this->input->post('usuario_id');

		if($this->core_model->get_by_id('users',array('email' => $email, 'id !=' => $usuario_id ))){
			$this->form_validation->set_message('email_check','Esse e-mail já existe');
			return FALSE;
		}else{
			return TRUE;
		}
	}


	/*=====  End of Section comment block  ======*/


	/*=============================================
	=           Excluir registro           =
	=============================================*/


	public function del($usuario_id = NULL){

		if(!$usuario_id || !$this->core_model->get_by_id('users',array('id'=>$usuario_id))){

			$this->session->set_flashdata('error','Usuário não encontrado.');
			redirect($this->router->fetch_class());

		}else{

			if($this->ion_auth->is_admin($usuario_id)){

				$this->session->set_flashdata('error','Administrador não pode ser excluido.');
				redirect($this->router->fetch_class());
			}

			//deletar registro
			if($this->ion_auth->delete_user($usuario_id)){

				$this->session->set_flashdata('sucesso','Registro excluido com sucesso!');
				redirect($this->router->fetch_class());

			}else{
				$this->session->set_flashdata('error','Não foi possivel excluir o registro.');
				redirect($this->router->fetch_class());
			}

		}

	}


	/*=====  End of Section comment block  ======*/



}


