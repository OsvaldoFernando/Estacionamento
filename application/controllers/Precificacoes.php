<?php
defined('BASEPATH') or exit('Acesso proibido');

class Precificacoes extends CI_Controller
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
		$data = array(
			'titulo' => 'Precificações registradas',

//			Estamos a trazer toda informações da tabela precificaoes
			'precificacoes' => $this->core_model->get_all('precificacoes'),

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
//		print_r($data['precificacoes']);
//		exit();

		$this->load->view('layout/header', $data);
		$this->load->view('precificacoes/index');
		$this->load->view('layout/footer');
	}

//	================================  Alterar  **********************************************************************
	public function core($precificacao_id = NULL)
	{

		if (!$precificacao_id) {

// ================================  Cadastrando -------------------------------------------------------------------------------------------------------------

			//				=================================== Form_validation +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++


			$this->form_validation->set_rules('precificacao_categoria', 'Categoria', 'trim|required|min_length[5]|max_length[30]|is_unique[precificacoes.precificacao_categoria]');
			$this->form_validation->set_rules('precificacao_valor_hora', 'Valor hora', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('precificacao_valor_mensalidade', 'Valor mensalidade', 'trim|required|max_length[50]');
			$this->form_validation->set_rules('precificacao_numero_vagas', 'Número vagas', 'trim|required|integer|greater_than[0]');

			if ($this->form_validation->run()) {

//					Printar tudo que vem do nosso Post

//					echo '<pre>';
//					print_r($this->input->post());
//					exit();

//					============================== Array para salvar os dados -----------------------------------------------------------

				$data = elements(
					array(
						'precificacao_categoria',
						'precificacao_valor_hora',
						'precificacao_valor_mensalidade',
						'precificacao_numero_vagas',
						'precificacao_ativa',
					), $this->input->post()
				);

				$data = html_escape($data);

				$this->core_model->insert('precificacoes', $data);
				redirect($this->router->fetch_class());

//					==============================Fim  Array para salvar os dados -----------------------------------------------------------
			} else {
//					Erro de validação

				//				============================ View Alterar ************************************************************************************

				$data = array(
					'titulo' => 'Registrar precificações',

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
				$this->load->view('precificacoes/core');
				$this->load->view('layout/footer');
			}
// ================================ Fim Cadastrando -------------------------------------------------------------------------------------------------------------
		} else {
//			Atualizando

			if (!$this->core_model->get_by_id('precificacoes', array('precificacao_id' => $precificacao_id))) {
				$this->session->set_flashdata('error', 'Precificação não encontrada');
				redirect($this->router->fetch_class());

			} else {

//				=================================== Form_validation +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

				$this->form_validation->set_rules('precificacao_categoria', 'Categoria', 'trim|required|min_length[5]|max_length[30]|callback_check_categoria');
				$this->form_validation->set_rules('precificacao_valor_hora', 'Valor hora', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('precificacao_valor_mensalidade', 'Valor mensalidade', 'trim|required|max_length[50]');
				$this->form_validation->set_rules('precificacao_numero_vagas', 'Número vagas', 'trim|required|integer|greater_than[0]');

				if ($this->form_validation->run()) {

//					Printar tudo que vem do nosso Post

//					echo '<pre>';
//					print_r($this->input->post());
//					exit();

//					============================== Array para salvar os dados -----------------------------------------------------------
//					Recuperar o valor vindo do post

					$precificacao_ativa = $this->input->post('precificacao_ativa');

					if ($precificacao_ativa == 0) {

						if ($this->db->table_exists('estacionar')) {

							if ($this->core_model->get_by_id('estacionar', array('estacionar_precificacao_id' => $precificacao_id, 'estacionar_status' => 0))) {
								$this->session->set_flashdata('error', 'Esta categoria está sendo utilizada em <i class="fas fa-parking"></i>&nbsp; estacionar');
								redirect($this->router->fetch_class());
							}

						}
					}

					if ($precificacao_ativa == 0) {

						if ($this->db->table_exists('mensalidades')) {

							if ($this->core_model->get_by_id('mensalidades', array('mensalidade_precificacao_id' => $precificacao_id, 'mensalidade_status' => 0))) {
								$this->session->set_flashdata('error', 'Esta categoria está sendo utilizada em <i class="fas fa-hand-holding-usd"></i>&nbsp; Mensalidades');
								redirect($this->router->fetch_class());
							}

						}
					}


					$data = elements(
						array(
							'precificacao_categoria',
							'precificacao_valor_hora',
							'precificacao_valor_mensalidade',
							'precificacao_numero_vagas',
							'precificacao_ativa',
						), $this->input->post()
					);

					$data = html_escape($data);

					$this->core_model->update('precificacoes', $data, array('precificacao_id' => $precificacao_id));
					redirect($this->router->fetch_class());

//					==============================Fim  Array para salvar os dados -----------------------------------------------------------
				} else {
//					Erro de validação

					//				============================ View Alterar ************************************************************************************

					$data = array(
						'titulo' => 'Editar precificações',

//			Vou recuperar do meu banco a precificação que estou tentando editar
						'precificacao' => $this->core_model->get_by_id('precificacoes', array('precificacao_id' => $precificacao_id)),

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

//				echo '<pre>';
//				print_r($data['precificacao']);
//				exit();

					$this->load->view('layout/header', $data);
					$this->load->view('precificacoes/core');
					$this->load->view('layout/footer');
				}


			}
		}

	}

	public function check_categoria($precificacao_categoria)
	{
//		================= Recuperar o id da precificação ********************
		$precificacao_id = $this->input->post('precificacao_id');

		if ($this->core_model->get_by_id('precificacoes', array('precificacao_categoria' => $precificacao_categoria, 'precificacao_id !=' => $precificacao_id))) {
			// Se existir atendendo o código acima, existe não podes cadastrar e faz um redirect

			$this->form_validation->set_message('check_categoria', 'Estacategoria ja existe');

			return FALSE;
		} else {
			return TRUE;
		}
	}

	public function delete($precificacao_id = NULL)
	{

//		======================= Verificar se ela não existir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if (!$this->core_model->get_by_id('precificacoes', array('precificacao_id' => $precificacao_id))) {
			$this->session->set_flashdata('error', 'Precificação não encontrada');
			redirect($this->router->fetch_class());
		}
//		======================= Fim Verificar se ela não existir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//		======================= Verificar se ela existir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		if ($this->core_model->get_by_id('precificacoes', array('precificacao_id' => $precificacao_id, 'precificacao_ativa' => 1))) {
			$this->session->set_flashdata('error', 'Precificação ativa não pode ser excluída');
			redirect($this->router->fetch_class());
		}
//		======================= Fim Verificar se ela existir +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

//		======================= Chamar o método de exclusão  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
		$this->core_model->delete('precificacoes', array('precificacao_id' => $precificacao_id));
		redirect($this->router->fetch_class());
//		======================= Fim Chamar o método de exclusão  +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	}
}
