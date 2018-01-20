<?php

class ConsoleController extends Zend_Controller_Action
{

    public function formularioAction()
    {
        $dados = $this->_getAllParams(); //recupera os dados enviados pelo formulario do method POST ou GET
        $modelConsole = new Application_Model_Console();
        
        if (!empty($dados['id_console'])){
            
            $row = $modelConsole->fetchRow('id_console=' .$dados['id_console']);
        
        } else {
        
            $row = $modelConsole->createRow();
        }
        
        $this->view->row = $row;
    }

    public function indexAction()
    {
      $modelConsole = new Application_Model_Console(); // faz conecção com o banco de dados
      $rowSet = $modelConsole->fetchAll(); // recupera todos os dados da tabela do banco de dados
        
        $this->view->rowSet = $rowSet;
      
    }
    public function gravarAction()
    {
    
        $dados = $this->_getAllParams(); //recupera os dados enviados pelo formulario
        
        $modelConsole = new Application_Model_Console();
        
        $modelConsole->gravar($dados);
        
        $this->redirect('console/index');
    }
    
    public function excluirAction()
    {
    
        $dados = $this->_getAllParams(); //recupera os dados enviados pelo formulario
        
        $modelConsole = new Application_Model_Console();
        
        $modelConsole->excluir($dados);
        
        $this->redirect('console/index');
    }

}

