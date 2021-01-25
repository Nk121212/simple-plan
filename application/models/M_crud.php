<?php

class M_crud extends CI_Model{

	public function post_insert($table_name, $postData, $attachment=''){

		if($attachment != ''){

			$merge = array_merge($attachment, xssPrevent($postData));
			$data = $merge;

		}else{

			$data = xssPrevent($postData);
			
		}

		$query = $this->db->insert($table_name, $data);

		return $query;
	}

	public function get_all($table, $offset='', $limit=''){

		$this->db->select('*');
		$this->db->from($table);

		if($offset == '' && $limit == ''){
			
		}else{
			$this->db->limit($limit, $offset);
		}

		$query = $this->db->get();

		return $query;

	}

	public function get_my_helper($my_email){

		$where = array(
			'email !=' => $my_email
		);

		$this->db->select('*');
		$this->db->from('SP_USER');
		$this->db->where($where);

		$query = $this->db->get();

		return $query;

	}

	public function get_where($table, $where, $offset='', $limit=''){

		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($where);
		$is_limit = ($offset == '' || $limit == '') ? '' : $this->db->limit($limit, $offset);
		$query = $this->db->get();

		return $query;

	}

}

?>