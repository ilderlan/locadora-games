<?php
class Application_Model_Game extends Zend_Db_Table
{
    protected $_name   = 'game';
    
    public function gravar($dados)
    {
    	if(isset($dados['disponibilidade'])){
    		
    		$dados['disponibilidade'] = 1;
    	}
    	else{
    		
    		$dados['disponibilidade'] = 0;
    	}
    	// Se tiver o id vai alterar, se não tiver, insere
    	if(!empty($dados['id_game'])){
	    	// Resgatando registro no banco pelo ID
    		$row = $this->fetchRow('id_game = ' . $dados['id_game']);
    	} else {
	    	// Criando linha vazia
	    	$row = $this->createRow();
    	}
    	
    	// Setando valores na linha
    	$row->setFromArray($dados);
    	
    	// Salvando no banco de dados
    	return $row->save();
    }
    
    public function recuperarGame(){
    	 
    	$select = $this->getDefaultAdapter()->select()
    	->from(array('g'=>'game'))
    	->join(array('a'=>'genero'), 'a.id_genero = g.id_genero', array('genero'=>'nome_genero'))
    	->join(array('c'=>'console'), 'c.id_console = g.id_console', array('console'=>'nome_console'))
    	//     				   ->where('id_venda = ?', '1')
    	->order('disponibilidade desc');
    	 
    	return $select->query();
    	 
    }
    
    public function excluir($dados)
    {
    	$this->delete('id_game = ' . $dados['id_game']);
    }
}
