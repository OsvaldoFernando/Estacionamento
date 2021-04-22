<?php
defined('BASEPATH') or exit('Acesso restrito');

class Home extends CI_Controller
{
	public function index()
	{
		$data = array(
//			Trazer o título
			'titulo' => 'Home',

		);

		$this->load->view('layout/header', $data);
		$this->load->view('home/index');
		$this->load->view('layout/footer');
	}
}
