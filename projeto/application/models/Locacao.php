<?php
class Application_Model_Locacao extends Zend_Db_Table
{
    protected $_name   = 'locacao';
    
    public function gravar($dados)
    {    	
    	date_default_timezone_set('America/Sao_Paulo');
    	
    	// Se tiver o id vai alterar, se não tiver, insere
    	if(!empty($dados['id_locacao'])){
	    	// Resgatando registro no banco pelo ID
    		$row = $this->fetchRow('id_locacao = ' . $dados['id_locacao']);
    	} else {
	    	// Criando linha vazia
    		$dados['dt_locacao'] = date('Y-m-d H:i:s');
	    	$row = $this->createRow();
    	}
    	
    	// Setando valores na linha
    	$row->setFromArray($dados);
    	
    	// Salvando no banco de dados
    	return $row->save();
    }
    
    public function recuperarLocacao(){
    	
    	$select = $this->getDefaultAdapter()->select()
    	->from(array('l'=>'locacao'))
    	->join(array('c'=>'cliente'), 'c.id_cliente = l.id_cliente', array('cliente'=>'nome_cliente'))
    	->join(array('g'=>'game'), 'g.id_game = l.id_game', array('game'=>'nome_game'))
    	//     				   ->where('id_venda = ?', '1')
    	->order('dt_devolucao desc');
    	
    	return $select->query();
    	
    }
    
    public function excluir($dados)
    {
    	$this->delete('id_locacao = ' . $dados['id_locacao']);
    }
}
