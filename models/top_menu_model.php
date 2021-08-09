<?php
//Top_menu Models
class Top_menu_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$top_menu_name = $_POST['top_menu_name'];
		$top_menu_icon = $_POST['top_menu_icon'];
		$top_menu_rank = $_POST['top_menu_rank'];
		$top_menu_link = $_POST['top_menu_link'];
		$stmt = $this->db->prepare("INSERT INTO `$table`(`top_menu_name`, `top_menu_icon`, `top_menu_rank`, `top_menu_link`) VALUES ('$top_menu_name', '$top_menu_icon', '$top_menu_rank', '$top_menu_link')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($table)
	{
		$top_menu_id = $_POST['top_menu_id'];
		$top_menu_name = $_POST['top_menu_name'];
		$top_menu_icon = $_POST['top_menu_icon'];
		$top_menu_rank = $_POST['top_menu_rank'];
		$top_menu_link = $_POST['top_menu_link'];
		$top_menu_status = $_POST['top_menu_status'];

		$stmt = $this->db->prepare("UPDATE $table SET `top_menu_name`='$top_menu_name', `top_menu_icon`='$top_menu_icon', `top_menu_rank`=$top_menu_rank, `top_menu_link`='$top_menu_link', `top_menu_status`='$top_menu_status' WHERE `top_menu_id`=$top_menu_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}