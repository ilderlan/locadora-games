<?php

class App_Controller_plugin_acl extends Zend_Controller_Plugin_Abstract {
	
	/* public function preDispatch(Zend_Controller_Request_Abstract $request) {
		
		$paginasPublicas = array (
				'funcionario/login',
				'funcionario/autenticar',
				'funcionario/logout',
				'error/error',
		);
		
		$paginasAdministrador = array (
				'funcionario/index',
				'funcionario/formulario',
				'funcionario/gravar',
				'perfil/index',
				'perfil/formulario',
				'cliente/index',
				'cliente/formulario',
				'cliente/gravar',
				'fornecedor/index',
				'fornecedor/formulario',
				'fornecedor/gravar',
				'venda/index',
				'venda/formulario',
				'venda/carregar-produto',
				'venda/gravar',
				'produto/index',
				'produto/formulario',
				'venda/gravar',
				'produto/gravar',
		);
		
		$paginasVendedor = array(
				'cliente/index',
				'venda/index',
				'venda/formulario',
				'venda/carregar-produto',
				'venda/gravar',
				'produto/index',
				'funcionario/gravar',
				'funcionario/formulario',
		);
		
		$controller = $request->getControllerName();
		$action = $request->getActionName();
		
		$url = $controller . '/' . $action;
		
		if(in_array($url, $paginasPublicas)){
			return  true;			
		}
		
		if(!empty($_SESSION['id_funcionario'])){
			if($_SESSION['id_perfil'] == 2 && in_array($url, $paginasAdministrador)){
				return true;	
			}
			if($_SESSION['id_perfil'] == 1 && in_array($url, $paginasVendedor)){
				return true;
			}
		}
		
		$request->setControllerName('funcionario');
		$request->setActionName('login');
	} */
}