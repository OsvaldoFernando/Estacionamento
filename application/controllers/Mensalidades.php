<?php
defined('BASEPATH') or exit('Ação não permitida');


class Mensalidades extends CI_Controller
{

	public function __construct()
	{

		parent::__construct();

		if (!$this->ion_auth->logged_in()) {
			redirect('login');
		}

		$this->load->model('mensalidades_model');


	}


	public function index()
	{
		$data = array(
			'titulo' => 'Mensalidade registradas',

//			Chamando o model onde tem o JOIN
			'mensalidades' => $this->mensalidades_model->get_all(),


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
//		print_r($data['mensalidades']);
//		exit();

		$this->load->view('layout/header', $data);
		$this->load->view('mensalidades/index');
		$this->load->view('layout/footer');
	}

	public function core($mensalidade_id = NULL)
	{

		if (!$mensalidade_id) {

			/*=============================================
				   =            cadastro            =
				   =============================================*/

			$this->form_validation->set_rules('mensalidade_mensalista_id','Mensalista', 'required');
			$this->form_validation->set_rules('mensalidade_precificacao_id','Categoria', 'required');
			$this->form_validation->set_rules('mensalidade_data_vencimento','Data vencimento', 'required|callback_check_existe_mensalidade|callback_check_data_valida|callback_check_data_com_dia_vencimento');

			if($this->form_validation->run()){

				// echo '<pre>';
				// print_r($this->input->post());
				// exit();


				$data = elements(
					array(
						'mensalidade_mensalista_id',
						'mensalidade_precificacao_id',
						'mensalidade_valor_mensalidade',
						'mensalidade_mensalista_dia_vencimento',
						'mensalidade_data_vencimento',
						'mensalidade_status',
					),$this->input->post()
				);



				$data['mensalidade_mensalista_id'] = $this->input->post('mensalidade_mensalista_hidden_id');
				$data['mensalidade_precificacao_id'] = $this->input->post('mensalidade_precificacao_hidden_id');

				if($data['mensalidade_status'] == 1){

					$data['mensalidade_data_pagamento'] = date('Y-m-d H:i:s');

				}


				$data = html_escape($data);
				$this->core_model->insert('mensalidades',$data);
				$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
				redirect($this->router->fetch_class());


			}else{


				$data = array(
					'titulo' => 'Cadastar mensalidade',
					'texto_modal' => 'Os dados estão corretos? </br></br> Depois de salva só será possivel alterar a "Categoria" e a "Situação"',
					'valor_btn'   => 'Salvar',
					'precificacoes' => $this->core_model->get_all('precificacoes',array('precificacao_ativa'=> 1)),
					'mensalistas'   => $this->core_model->get_all('mensalistas',array(' mensalista_ativo'=> 1)),

					'styles' => array(
						'plugins/select2/dist/css/select2.min.css',
					),

					'scripts' => array(
						'plugins/select2/dist/js/select2.min.js',
						'js/mensalidades/mensalidades.js',
						'plugins/mask/jquery.mask.min.js',

					),

				);

				//visualizar os dados
				// echo '<pre>';
				//print_r($data['mensalidade']);
				// exit();

				// echo '<pre>';
				// print_r($data['precificacoes']);
				// exit();
				// echo '<pre>';
				// print_r($data['mensalistas']);
				// exit();


				$this->load->view('layout/header', $data);
				$this->load->view('mensalidades/core');
				$this->load->view('layout/footer');

			}

			/*=====  End of Section comment block  ======*/

		} else {

			if (!$this->core_model->get_by_id('mensalidades', array('mensalidade_id' => $mensalidade_id))) {
				$this->session->set_flashdata('error', 'Mensalidade não encontrada');
				redirect($this->router->fetch_class());
			} else {

				$this->form_validation->set_rules('mensalidade_precificacao_id', 'categoria', 'required');

				if ($this->form_validation->run()) {

					//Vou pegar todos os nomes do campo do POST
//					echo '<pre>';
//					print_r($this->input->post());
//					exit();

					$data = elements(
						array(
							'mensalidade_precificacao_id',
							'mensalidade_valor_mensalidade',
							'mensalidade_mensalista_dia_vencimento',
							'mensalidade_status',
						), $this->input->post()
					);

					/*
					 * Recuperar o valor do campo hidden
					 */
					$data['mensalidade_mensalista_id'] = $this->input->post('mensalidade_mensalista_hidden_id');
					$data['mensalidade_precificacao_id'] = $this->input->post('mensalidade_precificacao_hidden_id');

					/*
					 * Se for igual a 1 está recebendo valor
					 */
					if ($data['mensalidade_status'] == 1) {

						$data['mensalidade_data_pagamento'] = date('Y-m-d H:i:s');
					}

					$data = html_escape($data);


					$this->core_model->update('mensalidades',$data,array('mensalidade_id' => $mensalidade_id));
					$this->session->set_flashdata('sucesso','Dados salvos com sucesso');
					redirect($this->router->fetch_class());




				} else {
//					Erro de validação, Se ele não existe trago toda minha view

					$data = array(
						'titulo' => 'Editar mensalidade',
						'texto_modal' => 'Os dados estão corretos?</br></br> Depois de guardar só será possível alterar a "Categoria" e a "Situação"',
						'valor_btn' => 'enviar',

						'styles' => array(
							'assets/plugin/select2/dist/css/select2.min.css',
						),

						'scripts' => array(
							'assets/plugin/select2/dist/js/select2.min.js',
							'assets/js/mensalidades/custom.js',
							'assets/mensalidades/mensalidades.js',
						),

//					Preciso enviar para o meu controlador as minhas precificações

						'precificacoes' => $this->core_model->get_all('precificacoes', array('precificacao_ativa' => 1)),
						'mensalistas' => $this->core_model->get_all('mensalistas', array('mensalista_ativo' => 1)),
						'mensalidades' => $this->core_model->get_by_id('mensalidades', array('mensalidade_id' => $mensalidade_id)),
					);

					$this->load->view('layout/header', $data);
					$this->load->view('mensalidades/core');
					$this->load->view('layout/footer');
				}
			}
		}
	}
}
