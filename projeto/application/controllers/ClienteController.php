<?php

class ClienteController extends Zend_Controller_Action
{

public function indexAction()
	{
		$modelCliente = new Application_Model_Cliente();
		
		$rowSet = $modelCliente->fetchAll();
		$this->view->rowSet = $rowSet;
	}
	
	public function formularioAction()
	{
		$dados = $this->_getAllParams();
		
		$modelCliente = new Application_Model_Cliente();
		
		if(!empty($dados['id_cliente'])){
			$row = $modelCliente->fetchRow('id_cliente = ' . $dados['id_cliente']);
		} else {
			$row = $modelCliente->createRow();
		}
		
		$this->view->row = $row;
		
		$modelUf = new Application_Model_Uf();
		$this->view->rowSetUf = $modelUf->fetchAll(null, 'nome');
		
		$modelMunicipio = new Application_Model_Municipio();
		$this->view->rowSetMunicipio = $modelMunicipio->fetchAll("id_uf = '{$row->id_uf}'", 'nome');
	}
	
	public function carregarMunicipioAction(){
	
		$this->_helper->layout->disableLayout();
		$dados = $this->_getAllParams();
		$modelMunicipio = new Application_Model_Municipio();
		$this->view->rowSetMunicipio = $modelMunicipio->fetchAll("id_uf ='{$dados['id_uf']}'", 'nome');
	
	}
	
	public function gravarAction()
	{
		$dados = $this->_getAllParams();
		
		$modelCliente = new Application_Model_Cliente();		
        
        $id_cliente = $modelCliente->gravar($dados);				
		$this->redirect('cliente/index');        
	}
	
	public function excluirAction()
	{
		$dados = $this->_getAllParams();
		$modelCliente = new Application_Model_Cliente();
		
		$modelCliente->excluir($dados);
		
		$this->redirect('cliente/index');
	}

}

