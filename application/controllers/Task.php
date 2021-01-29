<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Task extends CI_Controller {

		public function new_task(){

			$this->load->model('M_crud');

			$where = array(
	            'email_helper' => $this->session->userdata('email')
	        );

			$my_purpose = $this->M_crud->get_where('SP_PURPOSE_HELPER', $where);

			$id_purpose_by_helper = array();
			$i=0;
			foreach ($my_purpose->result() as $key => $value) {
				//echo $value->id_purpose;
				$id_purpose_by_helper[$i] = $value->id_purpose;
				$i++;
			}

			$my_purpose = $this->M_crud->get_where_in('SP_PURPOSE', 'id', $id_purpose_by_helper);

			$data = array('main' => 'home/add_task', 'purpose' => $my_purpose->result());
			$this->load->view('home/home', $data);

		}

		public function submit_task(){
			print_r($this->input->post());
		}

	}

?>