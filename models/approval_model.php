<?php
//approval Models
class approval_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		if ($_POST['csrf_token_approval']==$_SESSION['csrf_token_approval']) {
			$approval_officer = $_POST['approval_officer'];
			$approval_temp = $_POST['approval_temp'];
			if ($approval_temp == 1) {
				$approval_temp_officer = $_POST['approval_temp_officer'];
				$stmt = $this->db->prepare("INSERT INTO `$table`(approval_officer,approval_temp,approval_temp_officer) VALUES ($approval_officer,$approval_temp,$approval_temp_officer)");
				if ( $stmt->execute() === TRUE ) {
					$smtp_main_menu = $this->db->prepare("SELECT username FROM users WHERE user_emp_id=$approval_temp_officer");
					$smtp_main_menu->execute();
					$dts = $smtp_main_menu->fetchObject();
					$auth = 'salman,'.$dts->username;
					$stmnt = $this->db->prepare("UPDATE main_menu SET main_menu_has_access='$auth' WHERE main_menu_name='REQUISITIONS_APPROVAL'");
					if($stmnt->execute()){
						return 'SUCCESS';
					}
				}else{
					unset($_SESSION['csrf_token_approval']);
					return 'FAILED';
				}
			}else{
				$approval_temp = 0;
				$approval_temp_officer = 0;
				$stmt = $this->db->prepare("INSERT INTO `$table`(approval_officer,approval_temp,approval_temp_officer) VALUES ($approval_officer,$approval_temp,$approval_temp_officer)");
				if ( $stmt->execute() === TRUE ) {
					$smtp_main_menu = $this->db->prepare("SELECT username FROM users WHERE user_emp_id=$approval_officer");
					$smtp_main_menu->execute();
					$dts = $smtp_main_menu->fetchObject();
					$auth = 'salman,'.$dts->username;
					$stmnt = $this->db->prepare("UPDATE main_menu SET main_menu_has_access='$auth' WHERE main_menu_name='REQUISITIONS_APPROVAL'");
					if($stmnt->execute()){
						return 'SUCCESS';
					}
				}else{
					unset($_SESSION['csrf_token_approval']);
					return 'FAILED';
				}
			}
		}else{
			unset($_SESSION['csrf_token_approval']);
			return 'FAILED2';
		}
	}
	
}