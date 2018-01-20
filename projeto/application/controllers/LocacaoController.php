<?php

class LocacaoController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$modelLocacao = new Application_Model_Locacao();
		
		$rowSet = $modelLocacao->recuperarLocacao();
		$this->view->rowSet = $rowSet;
	}
	
	public function formularioAction()
	{
		$dados = $this->_getAllParams();
		
		$modelLocacao = new Application_Model_Locacao();
		
		if(!empty($dados['id_locacao'])){
			$row = $modelLocacao->fetchRow('id_locacao = ' . $dados['id_locacao']);
		} else {
			$row = $modelLocacao->createRow();
		}
		
		$this->view->row = $row;
		
		$modelCliente = new Application_Model_Cliente();
		$this->view->rowSetCliente = $modelCliente->fetchAll(null, 'nome_cliente');
        
        $modelConsole = new Application_Model_Console();
		$this->view->rowSetConsole = $modelConsole->fetchAll(null, 'nome_console');
		
        $modelGame = new Application_Model_Game();
		$this->view->rowSetGame = $modelGame->fetchAll("id_console = '{$row->id_console}'", 'nome_game');
		
	}
	
	public function gravarAction()
	{
		$dados = $this->_getAllParams();
		$modelLocacao = new Application_Model_Locacao();		
        
        $modelLocacao->gravar($dados);
		
		$this->redirect('locacao/index');        
	}
	
	public function excluirAction()
	{
		$dados = $this->_getAllParams();
		$modelLocacao = new Application_Model_Locacao();
		
		$modelLocacao->excluir($dados);
		
		$this->redirect('locacao/index');
	}
    
    public function carregarGameAction(){
        
        $this->_helper->layout->disableLayout();
        $dados = $this->_getAllParams();
        $modelGame = new Application_Model_Game();
		$this->view->rowSetGame = $modelGame->fetchAll("id_console ='{$dados['id_console']}'", 'nome_game');

    }
}

