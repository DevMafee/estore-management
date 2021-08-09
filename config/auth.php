<?php
//Auth Class
class Auth
{
	function __construct()
	{
		parent::__construct();
	}

	public static function check($user_type=null, $controller=null){
		if ($controller == null) {
			$controller = 'dashboard';
		}
		$ac = 'SUCCESS';
		require ('config/db_info.php');
		$con = mysqli_connect($host, $dbuser, $dbpassword, $dbname);
		$sql = "SELECT * FROM user_type WHERE user_type_id=$user_type";
		$run_sql = mysqli_query($con, $sql);
		if (!empty($run_sql) && mysqli_num_rows($run_sql) > 0) {
			while ($dt_access = mysqli_fetch_assoc($run_sql)) {
				$user_type_access = $dt_access['user_type_access'];
				if ($user_type_access == 'all') {
					$ac = 'SUCCESS';
				}else{
					$assess = explode(',', $user_type_access);
					if (in_array($controller, $assess)) {
						$ac = 'SUCCESS';
					}else{
						// $ac = 'FAILED';
						$ac = 'SUCCESS';
					}
				}
				
			}
			$controller = strtoupper($controller);
			Session::set('title', $controller);
			if (Session::get('loggedIn') == false) {
				header('location: '.url('login'));
			}elseif(Session::get('loggedIn') == true && $ac == 'FAILED'){
				header('location: '.url('dashboard'));
			}else{
				
			}
		}else{
			header('location: '.url('login'));
		}
	}
}