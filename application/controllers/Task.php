<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Task extends CI_Controller {

		public function new_task(){

			$this->load->model('M_crud');

			$where = array(
	            'email_helper' => $this->session->userdata('data_user')[0]['email']
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
				$my_purpose = $this->M_crud->get_where_in('SP_PURPOSE', 'id', $id_purpose_by_helper, array('status' => 0));
				$list_purpose = $my_purpose->result();

			}

			$data = array('main' => 'home/add_task', 'purpose' => $list_purpose);
			$this->load->view('home/home', $data);

		}

		public function submit_task(){

			$this->load->model('M_crud');
			$this->load->model('M_globals');

			$task = $this->input->post('task');
			$upload = $this->M_globals->do_upload('upload/task/', $task);

			$logged_in_email = $this->session->userdata('data_user')[0]['email'];
			$post_data = array_merge($this->input->post(), array('email_helper' => $logged_in_email));
			$insert = $this->M_crud->post_insert('SP_TASK_PURPOSE', $post_data, array('attachment' => $upload['image_path']));

			if(!$insert){

				$this->session->set_flashdata('message', '<div class="alert alert-'.$upload['color'].'" role="alert">Create Task Gagal !</div>
				<div class="alert alert-'.$upload['color'].'" role="alert">Attachment '.ucfirst($upload['status']).' '.$upload['message'].'</div>');

			}else{

				$dataProgressAwal = array(
					'id_purpose' => $this->input->post('id_purpose'),
					'id_task' => $this->db->insert_id(),
					'progress' => 0,
				);
				
				$addToProgress = $this->M_crud->post_replace('SP_TASK_PROGRESS', $dataProgressAwal);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Create Task Berhasil !</div>
				<div class="alert alert-'.$upload['color'].'" role="alert">Attachment '.ucfirst($upload['status']).' '.$upload['message'].'</div>');

			}

			redirect(base_url().'task/new_task');
		}

		public function view_task(){

			$this->load->model('M_crud');
			
			$where = array(
	            'email_helper' => $this->session->userdata('data_user')[0]['email']
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
				$my_purpose = $this->M_crud->get_where_in('SP_PURPOSE', 'id', $id_purpose_by_helper, array('status' => 0));
				$list_purpose = $my_purpose->result();

			}

			$data = array('main' => 'home/view_task', 'purpose' => $list_purpose);
			$this->load->view('home/home', $data);
		}

		public function update_task(){

			$this->load->model('M_crud');

			$where = array(
	            'email_helper' => $this->session->userdata('data_user')[0]['email']
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
				'id_purpose' => $this->input->post('id_purpose'),
				'email_helper' => $this->session->userdata('data_user')[0]['email']
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
			$this->load->model('M_globals');

			$upload = $this->M_globals->do_upload('upload/task/progress/', $this->input->post('progress'));

			$postData = $this->input->post();

			$merge = array_merge($postData, array('attachment' => $upload['image_path']));

			//replace ke tabel sp task progress
			$query = $this->M_crud->post_replace('SP_TASK_PROGRESS', $merge);

			if($query){

				//insert ke tabel sp task progress log
				$insert_log = $this->M_crud->post_insert('SP_TASK_PROGRESS_LOG', $merge);

				$check_progress_all_task = $this->M_crud->get_progress_all_task($this->input->post('id_purpose'));

				$progress_all_task = array();
				$i=0;
				foreach ($check_progress_all_task->result() as $key => $value) {
					$progress_all_task[$i] = $value->progress; 
					$i++;
				}

				//print_r($progress_all_task);

				if(min($progress_all_task) < 100) {
					//echo 'ada yg kurang dari seratus bung';
				}else{
					//update status purpose = 1
					$closePurpose = $this->M_crud->dinamicUpdate('SP_PURPOSE', array('status' => 1), array('id' => $this->input->post('id_purpose')));
				}

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Update Progress Persentase Task </div>
				<div class="alert alert-'.$upload['color'].'" role="alert">Attachment '.ucfirst($upload['status']).', '.$upload['message'].' </div>');

				redirect(base_url().'task/update_task');

			}
		}

		public function forward_task(){

			$this->load->model('M_crud');

			$where = array(
				'email_user' => $this->session->userdata('data_user')[0]['email'],
				'status' => 0
			);

			$my_purpose = $this->M_crud->get_where('SP_PURPOSE', $where);

			$data = array('main' => 'home/forward_task', 'purpose' => $my_purpose->result());
			$this->load->view('home/home', $data);

		}

		public function submit_forward_task(){

			$this->load->model('M_crud');
			$this->load->model('M_globals');
			
			$task = $this->input->post('task');
			$upload = $this->M_globals->do_upload('upload/task/', $task);

			//$logged_in_email = $this->session->userdata('data_user')[0]['email'];
			$post_data = $this->input->post();
			$insert = $this->M_crud->post_insert('SP_TASK_PURPOSE', $post_data, array('attachment' => $upload['image_path']));

			if(!$insert){

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed, Forward Task Gagal</div>');

			}else{

				$dataProgressAwal = array(
					'id_purpose' => $this->input->post('id_purpose'),
					'id_task' => $this->db->insert_id(),
					'progress' => 0,
				);
				
				$addToProgress = $this->M_crud->post_replace('SP_TASK_PROGRESS', $dataProgressAwal);
				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Forward Task Berhasil</div>');

			}

			redirect(base_url().'task/forward_task');

		}

		public function get_progress_task(){

			$this->load->model('M_crud');
			//print_r($this->input->post());
			$postData = $this->input->post();
			$query = $this->M_crud->get_where('SP_TASK_PROGRESS', $postData);

			$progress = isset($query->row()->progress) ? $query->row()->progress : 0;
			echo $progress;

		}

		public function getMyTask(){

			header('content-type:application/json');

			$this->load->model('M_crud');

			$postData = $this->input->post();
			//print_r($postData);
			$getTask = $this->M_crud->get_where('SP_TASK_PURPOSE', $postData);

			echo json_encode($getTask->result(), JSON_PRETTY_PRINT);

		}

	}

?>