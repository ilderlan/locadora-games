<?php

class GeneroController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$modelGenero = new Application_Model_Genero();
		
		$rowSet = $modelGenero->fetchAll();
		$this->view->rowSet = $rowSet;
	}
	
	public function formularioAction()
	{
		$dados = $this->_getAllParams();
		
		$modelGenero = new Application_Model_Genero();
		
		if(!empty($dados['id_genero'])){
			$row = $modelGenero->fetchRow('id_genero = ' . $dados['id_genero']);
		} else {
			$row = $modelGenero->createRow();
		}
		
		$this->view->row = $row;
	}
	
	public function gravarAction()
	{
		$dados = $this->_getAllParams();
		$modelGenero = new Application_Model_Genero();
		
        
        $id_genero = $modelGenero->gravar($dados);
		
		$this->redirect('genero/index');
        
        
	}
	
	public function excluirAction()
	{
		$dados = $this->_getAllParams();
		$modelGenero = new Application_Model_Genero();
		
		$modelGenero->excluir($dados);
		
		$this->redirect('genero/index');
	}
}

