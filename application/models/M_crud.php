<?php

class M_crud extends CI_Model{

	public function post_insert($table_name, $attachment=''){

		if($attachment != ''){

			$merge = array_merge($attachment, $this->input->post());
			$data = $merge;

		}else{

			$data = $this->input->post();
			
		}

		$query = $this->db->insert($table_name, $data);

		return $query;
	}

}

?>