<?php
//Languages_setup Class
class Languages_setup
{
	function __construct()
	{
		parent::__construct();
	}

	public static function loadlang($lang=null){
		if ($lang == null) {
			$lang = 'en';
		}else{
			$lang = $lang;
		}

		if ($lang != '') {
			require ('config/db_info.php');
			$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
			$sql = "SELECT * FROM languages WHERE languages_status=1 AND languages_type='$lang'";
			$run_sql = mysqli_query($con, $sql);
			while ($dt_lang = mysqli_fetch_assoc($run_sql)) {
				Session::set('languages_code', $dt_lang['languages_text']);
			}
		}
	}
}