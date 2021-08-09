<?php
//Theme_settings Controller
class Theme_settings extends BaseController
{
	public function __construct(){
		parent::__construct();
	}
	
	public function headersave()
	{
		$data = $this->model->headersave('theme_settings');
		return $data;
	}

}