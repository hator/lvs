<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class SiteController {

	protected $module;
	protected $view;
	protected $params = array();

	public function checkForModule($name) {
		return file_exists(BASEPATH.'modules/'. $name .'.php');
	}
	
	public function checkForView($name) {
		return file_exists(BASEPATH.'views/'. $name .'.php');
	}
	
	public function setModule($name) {
		$this->module = $name;
	}
	
	public function getModule() {
		return $this->module;
	}
	
	public function setView($name) {
		$this->view = $name;
	}
	
	public function getView() {
		return $this->view;
	}
	
	public function executeModule() {
		try {
			require_once BASEPATH.'modules/'. $this->module .'.php';
		} catch (Exception $e) {
			echo '<p>Wystąpił błąd modułu <span style="font-weight: bold;">'. $this->module .'</span>: '. $e->getMessage() .'</p>';
		}
	}
	
	public function executeView() {
		try {
			require_once BASEPATH.'views/'. $this->view .'.php';
		} catch (Exception $e) {
			echo '<p>Wystąpił błąd widoku <span style="font-weight: bold;">'. $this->view .'</span>: '. $e->getMessage() .'</p>';
		}
	}
	
	public function setParam($name, $value) {
		$this->params[$name] = $value;
	}
	
	public function getParam($name) {
		return $this->params[$name];
	}

}

?>