<?php

	function home(){
		// return "//mocatestore.gov.bd/";//Live Server
	return "http://202.86.217.200:800/estore/";//Server
	}
	function base_url($what){
		if ($what == 'site_link') {
			return home();
		}elseif ($what == 'title') {
			return 'SIMEC';
		}else{
			return 'NOTHING';
		}
	}

	function url($link){
		if ($link == './' || $link == '/' || $link == '') {
			return home().'dashboard';
		}else{
			return home().$link;
		}
	}


?>