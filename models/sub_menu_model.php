<?php
//Sub_menu Models
class Sub_menu_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$sub_menu_name = $_POST['sub_menu_name'];
		$sub_menu_icon = $_POST['sub_menu_icon'];
		$sub_menu_rank = $_POST['sub_menu_rank'];
		$sub_menu_main = $_POST['sub_menu_main'];
		$sub_menu_link = $_POST['sub_menu_link'];
		$stmt = $this->db->prepare("INSERT INTO `$table`(`sub_menu_name`, `sub_menu_link`, `sub_menu_main`, `sub_menu_rank`, `sub_menu_icon`) VALUES ('$sub_menu_name', '$sub_menu_link', '$sub_menu_main', '$sub_menu_rank', '$sub_menu_icon')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		$sub_menu_id = $_POST['sub_menu_id'];
		$sub_menu_name = $_POST['sub_menu_name'];
		$sub_menu_main = $_POST['sub_menu_main'];
		$sub_menu_icon = $_POST['sub_menu_icon'];
		$sub_menu_rank = $_POST['sub_menu_rank'];
		$sub_menu_link = $_POST['sub_menu_link'];
		$sub_menu_status = $_POST['sub_menu_status'];

		$stmt = $this->db->prepare("UPDATE $table SET `sub_menu_name`='$sub_menu_name', `sub_menu_main`='$sub_menu_main', `sub_menu_icon`='$sub_menu_icon', `sub_menu_rank`=$sub_menu_rank, `sub_menu_link`='$sub_menu_link', `sub_menu_status`='$sub_menu_status' WHERE `sub_menu_id`=$sub_menu_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}