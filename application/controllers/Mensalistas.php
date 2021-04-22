<?php
defined('BASEPATH') or exit('Ação não permitida');


class Mensalistas extends CI_Controller
{

	/*=============================================
	 =            Verificar se o Mensalistas está logado    =
	 =============================================*/

	public function __construct()
	{

		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
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
			'titulo' => 'Mensalistas registrados',
			'mensalistas' => $this->core_model->get_all('mensalistas'),


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

		);

//		echo '<pre>';
//		print_r($data['mensalistas']);
//		exit();

		$this->load->view('layout/header', $data);
		$this->load->view('mensalistas/index');
		$this->load->view('layout/footer');
	}


	public function core($mensalista_id = NULL)
	{
		if (!$mensalista_id) {

			/*=============================================
			=            cadastro            =
			=============================================*/

			$this->form_validation->set_rules('mensalista_nome', 'Nome do mensalista', 'trim|required|min_length[4]|max_length[30]');
			$this->form_validation->set_rules('mensalista_sobrenome', 'Sobrenome do mensalista', 'trim|required|min_length[4]|max_length[150]');
			$this->form_validation->set_rules('mensalista_data_nascimento', 'Data Nascimento', 'required');
			$this->form_validation->set_rules('mensalista_email', 'Email de Contato', 'trim|required|valid_email|max_length[50]|is_unique[mensalistas.mensalista_email]');
			$this->form_validation->set_rules('mensalista_endereco', 'Endereço', 'trim|required|min_length[4]|max_length[145]');
			$this->form_validation->set_rules('mensalista_cidade', 'Cidade', 'trim|required|min_length[4]|max_length[80]');
			$this->form_validation->set_rules('mensalista_bairro', 'Bairro', 'trim|required|min_length[4]|max_length[45]');
			$this->form_validation->set_rules('mensalista_complemento', 'Complemento', 'trim|min_length[4]|max_length[145]');
			$this->form_validation->set_rules('mensalista_dia_vencimento', 'Dia Vencimento Mensalista', 'trim|required|integer|greater_than[0]|less_than[32]');
			$this->form_validation->set_rules('mensalista_obs', 'Observação', 'trim|max_length[500]');

			$mensalista_telefone_movel = $this->input->post('mensalista_telefone_movel');

			if (!empty($mensalista_telefone_movel)) {
				$this->form_validation->set_rules('mensalista_telefone_movel', 'Telefone', 'trim|required|min_length[1]|max_length[9]|is_unique[mensalistas.mensalista_telefone_movel]');
			}
//============================================== Guardar alteração -----------------------------------------------------
			if ($this->form_validation->run()) {

//				======================================== Verificação que não permite desativar o mensalista que esta aberto *************

				$mensalista_ativo = $this->input->post('mensalista_ativo');

				$data = elements(
					array(
						'mensalista_nome',
						'mensalista_sobrenome',
						'mensalista_data_nascimento',
						'mensalista_email',
						'mensalista_telefone_movel',
						'mensalista_endereco',
						'mensalista_cidade',
						'mensalista_bairro',
						'mensalista_complemento',
						'mensalista_dia_vencimento',
						'mensalista_obs',
						'mensalista_ativo',
					), $this->input->post()
				);

				$data['mensalista_estado'] = strtoupper($this->input->post('mensalista_estado'));
				//Sanitizar array
				$data = html_escape($data);
				$this->core_model->insert('mensalistas', $data);
				$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
				redirect($this->router->fetch_class());

			} else {
//					erro de validação

				$data = array(
					'titulo' => 'Mensalistas registrados',
					'mensalistas' => $this->core_model->get_all('mensalistas'),


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
				);

				$this->load->view('layout/header', $data);
				$this->load->view('mensalistas/core');
				$this->load->view('layout/footer');

			}

		} else {
			/*=============================================
				  =            Edição       =
				  =============================================*/

			if (!$this->core_model->get_by_id('mensalistas', array('mensalista_id' => $mensalista_id))) {
				$this->session->set_flashdata('error', 'Mensalista não encontrada');
				redirect($this->router->fetch_class());

			} else {
				//editando
				$this->form_validation->set_rules('mensalista_nome', 'nome do mensalista', 'trim|required|min_length[4]|max_length[30]');
				$this->form_validation->set_rules('mensalista_sobrenome', 'Sobrenome do mensalista', 'trim|required|min_length[4]|max_length[150]');
				$this->form_validation->set_rules('mensalista_data_nascimento', 'Data Nascimento', 'required');
				$this->form_validation->set_rules('mensalista_email', 'Email de Contato', 'trim|required|valid_email|max_length[50]|callback_check_email');
				$this->form_validation->set_rules('mensalista_endereco', 'Endereço', 'trim|required|min_length[4]|max_length[145]');
				$this->form_validation->set_rules('mensalista_cidade', 'Cidade', 'trim|required|min_length[4]|max_length[80]');
				$this->form_validation->set_rules('mensalista_bairro', 'Bairro', 'trim|required|min_length[4]|max_length[45]');
				$this->form_validation->set_rules('mensalista_complemento', 'Complemento', 'trim|min_length[4]|max_length[145]');
				$this->form_validation->set_rules('mensalista_dia_vencimento', 'Dia Vencimento Mensalista', 'trim|required|integer|greater_than[0]|less_than[32]');
				$this->form_validation->set_rules('mensalista_obs', 'Observação', 'trim|max_length[500]');

				$mensalista_telefone_movel = $this->input->post('mensalista_telefone_movel');

				if (!empty($mensalista_telefone_movel)) {
					$this->form_validation->set_rules('mensalista_telefone_movel', 'Telefone Movel', 'trim|required|min_length[9]|max_length[15]|callback_check_telefone_movel');
				}

				if ($this->form_validation->run()) {

					$mensalista_ativo = $this->input->post('mensalista_ativo');

					if ($mensalista_ativo == 0) {

						if ($this->db->table_exists('mensalidades')) {

							if ($this->core_model->get_by_id('mensalidades', array('mensalidade_mensalista_id' => $mensalista_id, 'mensalidade_status' => 0))) {
								$this->session->set_flashdata('error', 'Existe <i class="fas fa-hand-holding-usd"></i>&nbsp; mensalidade em aberto para este mensalista');
								redirect($this->router->fetch_class());
							}

						}
					};

//					 echo '<pre>';
//					 print_r($this->input->post());
//					 exit();

					//sanitizar dados
					$data = elements(
						array(
							'mensalista_nome',
							'mensalista_sobrenome',
							'mensalista_data_nascimento',
							'mensalista_email',
							'mensalista_telefone_movel',
							'mensalista_endereco',
							'mensalista_cidade',
							'mensalista_bairro',
							'mensalista_complemento',
							'mensalista_dia_vencimento',
							'mensalista_obs',
							'mensalista_ativo',
						), $this->input->post()
					);

					//Sanitizar array
					$data = html_escape($data);
					$this->core_model->update('mensalistas', $data, array('mensalista_id' => $mensalista_id));
					$this->session->set_flashdata('sucesso', 'Dados salvos com sucesso');
					redirect($this->router->fetch_class());

				} else {

//						erro de validação
					$data = array(
						'titulo' => 'Editar Mensalistas',
						'mensalista' => $this->core_model->get_by_id('mensalistas', array('mensalista_id' => $mensalista_id)),

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

					);

					//visualizar os dados
//					 echo '<pre>';
//					 print_r($data['mensalista']);
//					 exit();

					$this->load->view('layout/header', $data);
					$this->load->view('mensalistas/core');
					$this->load->view('layout/footer');

				}
			}
		}
	}

	/*=========================================
=            validar o e-mail         =
=========================================*/

	public function check_email($mensalista_email)
	{

		$mensalista_id = $this->input->post('mensalista_id');

		if ($this->core_model->get_by_id('mensalistas', array('mensalista_id !=' => $mensalista_id, 'mensalista_email' => $mensalista_email))) {
			$this->form_validation->set_message('check_email', 'O campo {field} já existe, ele deve ser único');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/*=============================================
	=           validar o telefone            =
	=============================================*/
	public function check_telefone_movel($mensalista_telefone_movel)
	{
		$mensalista_id = $this->input->post('mensalista_id');

		if ($this->core_model->get_by_id('mensalistas', array('mensalista_id !=' => $mensalista_id, 'mensalista_telefone_movel' => $mensalista_telefone_movel))) {
			$this->form_validation->set_message('check_telefone_movel', 'O campo {field} já existe, ele deve ser único');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	/*=============================================
=           Excluir registro           =
=============================================*/

	public function delete($mensalista_id = NULL)
	{

		if (!$mensalista_id || !$this->core_model->get_by_id('mensalistas', array('mensalista_id' => $mensalista_id))) {
			$this->session->set_flashdata('error', 'Mensalista não encontrada');
			redirect($this->router->fetch_class());
		}

		if ($this->core_model->get_by_id('mensalistas', array('mensalista_id' => $mensalista_id, 'mensalista_ativo =' => 1))) {
			$this->session->set_flashdata('error', 'Não e possivel excluir mensalista ativo');
			redirect($this->router->fetch_class());
		}

		$this->core_model->delete('mensalistas', array('mensalista_id' => $mensalista_id));
		$this->session->set_flashdata('sucesso', 'Dado excluido com sucesso');
		redirect($this->router->fetch_class());

	}
}
