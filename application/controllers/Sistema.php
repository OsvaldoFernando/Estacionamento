<?php

defined('BASEPATH') or exit('Acesso restrito');

class Sistema extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('login');
		}
	}

	public function index()
	{
//		Validações
		$this->form_validation->set_rules('sistema_razao_social', 'Razão social', 'trim|required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_nome_fantasia', 'Nome fantasia', 'trim|required|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_telefone_movel', 'Telefone móvel', 'trim|required|min_length[5]|max_length[24]');
		$this->form_validation->set_rules('sistema_email', 'Sistema E-mail', 'trim|required|valid_email|max_length[100]');
		$this->form_validation->set_rules('sistema_site_url', 'Site url', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('sistema_endereco', 'Endereço Sistema', 'trim|required|valid_url|min_length[5]|max_length[145]');
		$this->form_validation->set_rules('sistema_texto_ticket', 'Texto do ticket de estacionamento', 'trim|max_length[500]');

//		============================================= Salvar os dados no banco de dado *****************************************************

		if ($this->form_validation->run()) {
			//		Debug para ver tudo que retorna no meu POST

			$data = elements(
				array(
					'sistema_razao_social',
					'sistema_nome_fantasia',
					'sistema_telefone_movel',
					'sistema_email',
					'sistema_site_url',
					'sistema_site_url',
					'sistema_endereco',
					'sistema_texto_ticket',
				), $this->input->post()
			);

//		**************** Sanitizar =============================================================
			$data = html_escape($data);
//		Vou chamar o meu update

			$this->core_model->update('sistema', $data, array('sistema_id' => 1));

			redirect($this->router->fetch_class());

//			echo '<pre>';
//			print_r($this->input->post());
//			exit();

		} else {
			//Se não retorna na minha view - erro de validação


			$data = array(
				'titulo' => 'Editar informações do sistema',

//			Vou recuperar a informação do sistema com o método by_id tabela sistema e um array de condição sistema_id que é o nome que se vai fazer comparação com parâmetro 1 porque só existe 1 registro
				'sistema' => $this->core_model->get_by_id('sistema', array('sistema_id' => 1)),
			);

//		echo '<pre>';
//		print_r($data['sistema']);
////		print_r($data);
//		exit();

			$this->load->view('layout/header', $data);
			$this->load->view('sistema/index');
			$this->load->view('layout/footer');
		}


	}
}
