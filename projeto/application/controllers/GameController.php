<?php

class GameController extends Zend_Controller_Action
{
	public function indexAction()
	{
		$modelGame = new Application_Model_Game();
		
		$rowSet = $modelGame->recuperarGame();
		$this->view->rowSet = $rowSet;
	}
	
	public function formularioAction()
	{
		$dados = $this->_getAllParams();
		
		$modelGame = new Application_Model_Game();
		
		if(!empty($dados['id_game'])){
			$row = $modelGame->fetchRow('id_game = ' . $dados['id_game']);
		} else {
			$row = $modelGame->createRow();
		}
		
		$this->view->row = $row;
		
		$modelGenero = new Application_Model_Genero();
		$this->view->rowSetGenero = $modelGenero->fetchAll(null, 'nome_genero');
		
		$modelConsole = new Application_Model_Console();
		$this->view->rowSetConsole = $modelConsole->fetchAll(null, 'nome_console');
	}
	
	public function gravarAction()
	{
		$dados = $this->_getAllParams();
		$modelGame = new Application_Model_Game();		
        
        $id_game = $modelGame->gravar($dados);	
        $foto = $this->uploadFoto($id_game);
        
        $dadosUpdate['foto'] = $foto;
        $modelGame->update($dadosUpdate, "id_game = $id_game");
        
		$this->redirect('game/index');        
	}
	
	public function uploadFoto($id_game)
	{
		if(isset($_FILES['foto'])&& $_FILES['foto']['error'] == 0){
	
			$origem = $_FILES['foto']['tmp_name'];
			$extensao = substr($_FILES['foto']['name'], strrpos($_FILES['foto']['name'], '.'));
			$destino = 'img/fotos/' . $id_game . $extensao;
	
			move_uploaded_file($origem, $destino);
			return $id_game . $extensao;
		}
	}
	
	public function excluirAction()
	{
		$dados = $this->_getAllParams();
		$modelGame = new Application_Model_Game();
		
		$modelGame->excluir($dados);
		
		$this->redirect('game/index');
	}
    
    public function carregarGeneroAction(){
        
        $this->_helper->layout->disableLayout();
        $dados = $this->_getAllParams();
        $modelGenero = new Application_Model_Genero();
		$this->view->rowSetGenero = $modelGenero->fetchAll("id_genero ='{$dados['id_genero']}'", 'nome_genero');

    }
}

