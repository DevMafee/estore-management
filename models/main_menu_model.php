<?php
//Main_menu Models
class Main_menu_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	public function save($table)
	{
		$main_menu_name = $_POST['main_menu_name'];
		$main_menu_icon = $_POST['main_menu_icon'];
		$main_menu_rank = $_POST['main_menu_rank'];
		$main_menu_link = $_POST['main_menu_link'];
		$main_menu_has_access = '1';
		$main_menu_access = $_POST['main_menu_has_access'];
		$count = count($main_menu_access);
		for ($i=0; $i<$count; $i++) {
			$main_menu_has_access .= ','.$main_menu_access[$i];
		}
		
		$stmt = $this->db->prepare("INSERT INTO `$table`(`main_menu_name`, `main_menu_icon`, `main_menu_rank`, `main_menu_link`, `main_menu_has_access`) VALUES ('$main_menu_name', '$main_menu_icon', '$main_menu_rank', '$main_menu_link', '$main_menu_has_access')");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
	public function update($id,$table)
	{
		$main_menu_id = $_POST['main_menu_id_'.$id];
		$main_menu_name = $_POST['main_menu_name_'.$id];
		$main_menu_icon = $_POST['main_menu_icon_'.$id];
		$main_menu_rank = $_POST['main_menu_rank_'.$id];
		$main_menu_link = $_POST['main_menu_link_'.$id];
		$main_menu_has_access = '1';
		$main_menu_access = $_POST['main_menu_has_access_'.$id];
		$count = count($main_menu_access);
		for ($i=0; $i<$count; $i++) {
			$main_menu_has_access .= ','.$main_menu_access[$i];
		}
		
		$main_menu_status = $_POST['main_menu_status_'.$id];

		$stmt = $this->db->prepare("UPDATE $table SET `main_menu_name`='$main_menu_name', `main_menu_icon`='$main_menu_icon', `main_menu_rank`=$main_menu_rank, `main_menu_link`='$main_menu_link', `main_menu_has_access`='$main_menu_has_access', `main_menu_status`='$main_menu_status' WHERE `main_menu_id`=$main_menu_id");
		if ( $stmt->execute() === TRUE ) {
			return 'SUCCESS';
		}else{
			return 'FAILED';
		}
	}
	
}