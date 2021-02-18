<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Helper extends CI_Controller {

	public function view_helper(){

		$this->load->model('M_crud');

		$where = array(
			'email_user' => $this->session->userdata('data_user')[0]['email']
		);

		$a = $this->M_crud->get_where('SP_PURPOSE', $where);

		$data = array(
			'main' => 'home/view_helper',
			'purpose' => $a->result()
		);

		$this->load->view('home/home', $data);

	}

	public function delete_helper(){

		$this->load->model('M_crud');

		//print_r($this->input->post());

		$where = array(
			'id_purpose' => $this->input->post('id_purpose'),
			'email_helper' => $this->input->post('email_helper')
		);

		$get_id_task = $this->M_crud->get_where('SP_TASK_PURPOSE', $where);

		foreach ($get_id_task->result() as $key => $value) {

			$id_task = $value->id;
			$id_purpose = $value->id_purpose;

			$where_array = array(
				'id_task' => $id_task,
				'id_purpose' => $id_purpose
			);

			$delete_progress = $this->M_crud->delete('SP_TASK_PROGRESS', $where_array);
			$delete_progress_log = $this->M_crud->delete('SP_TASK_PROGRESS_LOG', $where_array);

		}

		$delete_task = $this->M_crud->delete('SP_TASK_PURPOSE', $where);

		$delete_helper = $this->M_crud->delete('SP_PURPOSE_HELPER', $where);

		if($delete_helper){

			$message = array(
				'bs_color' => 'success',
				'message' => 'Success',
				'full_message' => 'Hapus Helper Berhasil !'
			);

		}else{

			$message = array(
				'bs_color' => 'danger',
				'message' => 'Failed',
				'full_message' => 'Hapus Helper Gagal !'
			);
		}

		header('content-type:application/json');

		echo json_encode($message);

	}

	public function get_helper(){

		$this->load->model('M_crud');

		$where = array(
            'SP_PURPOSE_HELPER.id_purpose' => $this->input->post('id_purpose')
        );
    
        $helper_count = $this->M_crud->join_2_table('SP_PURPOSE_HELPER', 'SP_USER', 'email_helper', 'email', $where);

       	header('content-type:application/json');

		echo json_encode($helper_count->result());
	}

}