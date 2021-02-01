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

			if (empty($id_purpose_by_helper)){
				$list_purpose = array();
			} else {
				$my_purpose = $this->M_crud->get_where_in('SP_PURPOSE', 'id', $id_purpose_by_helper);
				$list_purpose = $my_purpose->result();

			}

			$data = array('main' => 'home/add_task', 'purpose' => $list_purpose);
			$this->load->view('home/home', $data);

		}

		public function submit_task(){

			$this->load->model('M_crud');
			//print_r($this->input->post());
			$logged_in_email = $this->session->userdata('email');
			$post_data = array_merge($this->input->post(), array('email_helper' => $logged_in_email));
			//print_r($data);
			$insert = $this->M_crud->post_insert('SP_TASK_PURPOSE', $post_data);

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Create Task Berhasil</div>');
			redirect(base_url().'task/new_task');
		}

		public function view_task(){
			$data = array('main' => 'home/view_task');
			$this->load->view('home/home', $data);
		}

		public function update_task(){

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

			if (empty($id_purpose_by_helper)){
				$list_purpose = array();
			} else {
				$my_purpose = $this->M_crud->get_where_in('SP_PURPOSE', 'id', $id_purpose_by_helper);
				$list_purpose = $my_purpose->result();

			}

			$data = array('main' => 'home/update_task', 'purpose' => $list_purpose);
			$this->load->view('home/home', $data);

		}

		public function get_task_by_purpose(){

			$this->load->model('M_crud');

			header('content-type:application/json');

			$where_purpose = array(
				'id_purpose' => $this->input->post('id_purpose')
			);

			$my_task = $this->M_crud->get_where('SP_TASK_PURPOSE', $where_purpose);

			$data = array(
				'resl_resp' => $my_task->result(),
				'data' => array()
			);

			foreach ($my_task->result() as $key => $value) {
				$data['data'][] = array(
					'id' => $value->id,
					'task' => $value->task
				);
			}

			echo json_encode($data);

		}

		public function submit_progress(){

			$this->load->model('M_crud');

			$postData = $this->input->post();

			$query = $this->M_crud->post_insert('SP_TASK_PROGRESS', $postData);

			if($query){

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Update progress persentase task </div>');

				redirect(base_url().'task/update_task');

			}
		}

	}

?>