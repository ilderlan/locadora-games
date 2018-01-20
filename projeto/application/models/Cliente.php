<?php
class Application_Model_Cliente extends Zend_Db_Table
{
    protected $_name   = 'cliente';
    
    public function gravar($dados)
    {    	
    	date_default_timezone_set('America/Sao_Paulo');
 
    	
    	// Se tiver o id vai alterar, se não tiver, insere
    	if(!empty($dados['id_cliente'])){
    		$dados['dt_modificacao'] = date('Y-m-d H:i:s');
	    	// Resgatando registro no banco pelo ID
    		$row = $this->fetchRow('id_cliente = ' . $dados['id_cliente']);
    	} else {
	    	// Criando linha vazia
    		$dados['dt_criacao'] = date('Y-m-d H:i:s');
	    	$row = $this->createRow();
    	}
    	
    	// Setando valores na linha
    	$row->setFromArray($dados);
    	
    	// Salvando no banco de dados
    	return $row->save();
    }
    
    public function excluir($dados)
    {
    	$this->delete('id_cliente = ' . $dados['id_cliente']);
    }
}
