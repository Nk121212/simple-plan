<?php

class M_auth extends CI_Model{

	public function save_log_confirmation($array){

		$now = now('Asia/Jakarta');
		$dtformat = date('Y-m-d H:i:s', $now);

		$data = array(
			'email' => $array['email'],
			'otp' => $array['kode_otp'],
			'valid_until' => date("Y-m-d H:i:s", strtotime($dtformat." +10 minutes"))
		);

		$query = $this->db->replace('sp_confirmation_log', $data);

		return $query;

	}

	public function save_user($array){

		$data = array(
			'email' => $array['email'],
			'first_name' => $array['first_name'],
			'last_name' => $array['last_name'],
			'password' => password_hash($array['password'], PASSWORD_DEFAULT)
		);

		$query = $this->db->replace('sp_user', $data);

		return $query;

	}

	public function check_valid_time($email='', $otp=''){

		$now = now('Asia/Jakarta');
		$dtformat = date('Y-m-d H:i:s', $now);

		$where = array(
			'email' => $email,
			'otp' => $otp,
			'valid_until >=' => $dtformat
		);

		$this->db->select('*');
		$this->db->from('sp_confirmation_log');
		$this->db->where($where);
		$query = $this->db->get();

		return$query;

	}

	public function activate_user($email=''){

		$data = array(
	        'status' => 1,
		);

		$this->db->where('email', $email);
		$query = $this->db->update('sp_user', $data);

		return $query;

	}

	public function is_user_exist(){
		$this->db->select('*');
		$this->db->from('sp_user');
		$this->db->where('email', $this->input->post('email'));
		$this->db->where('status', 1);
		$query = $this->db->get();

		return $query;

	}

}