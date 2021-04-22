<?php
defined('BASEPATH') or exit('Ação não permitida');

class Mensalidades_model extends CI_Model{

	public function get_all(){

//		Cheve Estrangeira

		$this->db->select([
			'mensalidades.*', //Estou recuperando todos os campos da minha tabela mensalidades
			'precificacoes.precificacao_id', // Da minha tabela precificações vou precisar do id,categoria e valor mensalidade
			'precificacoes.precificacao_categoria',
			'precificacoes.precificacao_valor_mensalidade',
			'mensalistas.mensalista_id', // Da minha tabela mensalista vou precisar do id,nome e do dia de vencimento
			'mensalistas.mensalista_nome',
			'mensalistas.mensalista_dia_vencimento',
		]);

// 		O JOIN

		$this->db->join('precificacoes','precificacao_id = mensalidade_precificacao_id', 'LEFT'); //o LEFT permite trazer até registro que não atender esta precificação.
		$this->db->join('mensalistas','mensalista_id = mensalidade_mensalista_id', 'LEFT');

		return $this->db->get('mensalidades')->result(); // Vai trazer todos os valores de mensalidade.

	}
}
