<?php
class Basic
{
	function __construct()
	{
		if (isset($_GET['url'])) {
			$url = $_GET['url'];
			if ($url != '') {
				$url_array = explode("/", $url);
				$count = count($url_array);
				$controller = 'home';
				if ($count == 1) {
					$controller = $url_array[0];
					$method = 'index';
					$value = '';
				}elseif ($count == 2) {
					$controller = $url_array[0];
					if ($url_array[1] != '') {
						$method = $url_array[1];
					}else{
						$method = 'index';
					}
					$value = '';
				}elseif($count >= 3){
					$controller = $url_array[0];
					$method = $url_array[1];
					if ($url_array[2] != '') {
						$value = $url_array[2];
					}
				}else{
					$controller = 'home';
					$method = 'index';
					$value = '';
				}
				
				$file = './controllers/'.$controller.'.php';

				if (file_exists($file)) {
					require $file;
					$data = new $controller;
					$data->loadModel($controller);
					if (isset($value) && $value != '') {
						echo $data->$method($value);
					}else{
						echo $data->$method();
					}
					
				}else{
					include('views/404.php');
				}
			}
		}else{
			require ('./controllers/home.php');
			$data = new Home();
			echo $data->index();
		}
	}
}