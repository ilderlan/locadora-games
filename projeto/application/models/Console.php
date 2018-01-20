<?php 

class Application_Model_Console extends Zend_Db_Table
{
    protected $_name = 'console';
    
    public function gravar($dados)
    {
        
        //Se tiver o id vai alterar, senão tiver, insere
        if(!empty($dados['id_console'])) {
            
            // Resgatando refistro no banco pelo ID
            $row = $this->fetchRow('id_console=' .$dados['id_console']);
        
        }else {

             $row = $this->createRow(); //criando linha vazia
        }
       
        $row->setFromArray($dados); //seta valores na linha
        $row->save(); //salvando no banco de dados (salva a operação feita acima)
    }
    
    public function excluir($dados)
    {
    
        $row = $this->fetchRow('id_console=' .$dados['id_console']);
        $row->delete();
        
    }
}