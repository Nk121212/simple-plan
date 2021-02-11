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

	public function post_replace($table_name, $postData){

		$data = xssPrevent($postData);
		$query = $this->db->replace($table_name, $data);

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

	public function delete($table, $where){
		$this->db->delete($table, $where);
		return $this;
	}

	public function get_where_in($table, $field_in, $value_field_in){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where_in($field_in, $value_field_in);
		$query = $this->db->get();
		return $query;
	}

	public function join_2_table($table1, $table2, $field_on1, $field_on2, $where='', $group_by='', $offset='', $limit='', $select=''){
		$this->db->select($select == '' ? '*' : $select);
		$this->db->from($table1);
		$this->db->join($table2, $table2.'.'.$field_on2.' = '.$table1.'.'.$field_on1);
		$where == '' ? '' : $this->db->where($where);
		$group_by == '' ? '' : $this->db->group_by($group_by);
		$is_limit = ($offset == '' || $limit == '') ? '' : $this->db->limit($limit, $offset);
		$query = $this->db->get();
		return $query;
	}

	public function join_multiple_table($param='', $where='', $group_by='', $offset='', $limit='', $select='', $order_field='', $order_key=''){
		
		$this->db->select($select == '' ? '*' : $select);
		$this->db->from($param['table'][0]);

		foreach ($param['table_join_key'] as $key => $value) {
		$tbl_join_key = explode("_", $value);
		$field_join_key = explode("_", $param['field_join_key'][$key]);
		//echo $tbl_join_key[0];
		//echo $tbl_join_key[1];
		$this->db->join($param['table'][$tbl_join_key[0]], $param['table'][$tbl_join_key[0]].'.'.$param['field'][$field_join_key[0]].' = '.$param['table'][$tbl_join_key[1]].'.'.$param['field'][$field_join_key[1]]);
		}

		$where == '' ? '' : $this->db->where($where);
		$group_by == '' ? '' : $this->db->group_by($group_by);
		$order_field == '' ? '' : $this->db->order_by($order_field, $order_key);
		$is_limit = ($offset == '' || $limit == '') ? '' : $this->db->limit($limit, $offset);

		$query = $this->db->get();
		return $query;
		
	}

}

?>