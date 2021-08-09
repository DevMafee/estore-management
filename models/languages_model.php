<?php
//languages Models
class languages_Model extends Model
{
	function __construct()
	{
		parent::__construct();
	}

	public function save($table)
	{
		if ($_SESSION['csrf_token_languages'] == $_POST['csrf_token_languages']) {
			$languages_code = $_POST['languages_code'];
			$languages_en = $_POST['languages_en'];
			$languages_bn = $_POST['languages_bn'];

			$stmt_en = $this->db->prepare("INSERT INTO $table(languages_type, languages_code, languages_text) VALUES ('en', '$languages_code', '$languages_en')");
			$stmt_bn = $this->db->prepare("INSERT INTO $table(languages_type, languages_code, languages_text) VALUES ('bn', '$languages_code', '$languages_bn')");
			if ($stmt_en->execute() === TRUE && $stmt_bn->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED';
			}
		} else {
			return 'FAILED';
		}
	}

	public function update($table, $id)
	{
		$csrf_token = $_POST['csrf_token_' . $id];
		if ($csrf_token == $_SESSION['csrf_token_' . $id]) {
			$languages_text = $_POST['languages_text_' . $id];

			$stmt = $this->db->prepare("UPDATE `$table` SET languages_text='$languages_text' WHERE `languages_id`=$id");
			if ($stmt->execute() === TRUE) {
				return 'SUCCESS';
			} else {
				return 'FAILED';
			}
		}
	}
}
