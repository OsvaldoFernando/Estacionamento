<?php
defined('BASEPATH') or exit('Ação não permitida');


class Formas extends CI_Controller
{

	/*=============================================
	 =            Verificar se o usuário está logado    =
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
			'titulo' => 'Formas de pagamento registradas',
			'formas' => $this->core_model->get_all('formas_pagamentos'),

		);

		//visualizar os dados
		// echo '<pre>';
		//  print_r($data['precificacoes']);
		// exit();

		$this->load->view('layout/header', $data);
		$this->load->view('formas/index');
		$this->load->view('layout/footer');
	}

	public function core($forma_pagamento_id = NULL)
	{


		if (!$forma_pagamento_id) {


			/*=============================================
			=            cadastro            =
			==========================================================================================================================================================*/

			$this->form_validation->set_rules('forma_pagamento_nome', 'Nome da forma de pagamento', 'trim|required|min_length[4]|max_length[30]|is_unique[formas_pagamentos.forma_pagamento_nome]');

//	Enviando no meu banco de dado ------------------------------------------------------------------
			if ($this->form_validation->run()) {

				$data = elements(
					array(
						'forma_pagamento_nome',
						'forma_pagamento_ativa',
					), $this->input->post()
				);

				$data = html_escape($data);
				$this->core_model->insert('formas_pagamentos', $data);
				$this->session->set_flashdata('sucesso', 'Dados enviados com sucesso');
				redirect($this->router->fetch_class());
//	Fim, Enviando no meu banco de dado ----------------------------------------------------------------------------------------
			} else {

				//erro de validação

				$data = array(
					'titulo' => 'Editar forma de pagamento',
				);

				$this->load->view('layout/header', $data);
				$this->load->view('formas/core'); //Chamamos a nossa view Core
				$this->load->view('layout/footer');
			}

			/*=============================================
			=          Fim,  cadastro            =
			==========================================================================================================================================================*/

		} else {
			if (!$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
				$this->session->set_flashdata('error', 'Forma de pagamento não encontrada');
				redirect($this->router->fetch_class());

			} else {
//******************************************************************************
				//editando
				$this->form_validation->set_rules('forma_pagamento_nome', 'Nome da forma de pagamento', 'trim|required|min_length[4]|max_length[30]|callback_forma_check');

//	Enviando no meu banco de dado ------------------------------------------------------------------
				if ($this->form_validation->run()) {

					$data = elements(
						array(
							'forma_pagamento_nome',
							'forma_pagamento_ativa',
						), $this->input->post()
					);

					$data = html_escape($data);
					$this->core_model->update('formas_pagamentos', $data, array('forma_pagamento_id' => $forma_pagamento_id));
					$this->session->set_flashdata('sucesso', 'Dados enviados com sucesso');
					redirect($this->router->fetch_class());
//	Fim, Enviando no meu banco de dado ----------------------------------------------------------------------------------------
				} else {

					//erro de validação

					$data = array(
						'titulo' => 'Editar forma de pagamento',
						'forma' => $this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id)),
					);

//					visualizar os dados
//					echo '<pre>';
//					print_r($data['forma']);
//					exit();

					$this->load->view('layout/header', $data);
					$this->load->view('formas/core'); //Chamamos a nossa view Core
					$this->load->view('layout/footer');
				}
			}
		}
	}


	/*=============================================
 =           Excluir registro           =
 ======================================================================================*/


	public function delete($forma_pagamento_id = NULL)
	{

		if (!$this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id))) {
			$this->session->set_flashdata('error', 'Froma de pagamento não encontrada');
			redirect($this->router->fetch_class());
		} else {

			$this->core_model->delete('formas_pagamentos', array('forma_pagamento_id' => $forma_pagamento_id));
			$this->session->set_flashdata('sucesso', 'Registro excluido com sucesso');
			redirect($this->router->fetch_class());

		}
	}

	/*=============================================
 =           Fim, Excluir registro           =
 ======================================================================================*/

	/*=============================================
	= validação usando callback   =
	=============================================*/

	//verificar se o nome já existe
	public function forma_check($forma_pagamento_nome)
	{

		$forma_pagamento_id = $this->input->post('forma_pagamento_id');

		if ($this->core_model->get_by_id('formas_pagamentos', array('forma_pagamento_nome' => $forma_pagamento_nome, 'forma_pagamento_id !=' => $forma_pagamento_id))) {
			$this->form_validation->set_message('forma_check', 'Forma de pagamento já existe');
			return FALSE;
		} else {
			return TRUE;
		}

	}

}
