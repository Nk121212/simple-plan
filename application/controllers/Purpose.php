<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Purpose extends CI_Controller {

		public function new_purpose($id=''){

	        $this->load->model('M_crud');

	        $data_helper = $this->M_crud->get_my_helper($this->session->userdata('data_user')[0]['email']);

	        if($id==''){

	            $data = array('main' => 'home/add_purpose', 'helper_list' => $data_helper, 'helper' => array());

	        }else{

	            $id_purpose = base64_decode($id);

	            $detail_purpose = $this->M_crud->get_where('SP_PURPOSE', array('id' => $id_purpose));

	            $get_helper = $this->M_crud->get_where('SP_PURPOSE_HELPER', array('id_purpose' => $id_purpose));

	            $helper = array();
	            $i=0;
	            foreach ($get_helper->result() as $key => $value) {
	                $helper[$i]['email_helper'] = $value->email_helper;
	                $i++;
	            }

	            $data = array('main' => 'home/add_purpose', 'helper_list' => $data_helper, 'purpose_data' => $detail_purpose->result_array(), 'helper' => $helper);

	        }

			$this->load->view('home/home', $data);
		}

		public function view_purpose(){
			$data = array('main' => 'home/view_purpose');
			$this->load->view('home/home', $data);
		}

		public function submit_purpose(){

			$this->load->model('M_crud');
			$this->load->model('M_globals');

			$purpose = $this->input->post('purpose');
			$upload = $this->M_globals->do_upload('upload/purpose/', $purpose);

	        $helper = $this->input->post('helper');

	        unset($_POST['helper']); //unset helper karena tidak akan di save di tabel purpose

			if($upload['status'] == 'ok'){

				$insert = $this->M_crud->post_insert('SP_PURPOSE', $this->input->post(), array('attachment' => $upload['image_path'], 'email_user' => $this->session->userdata('data_user')[0]['email']));

	            $last_insert_id = $this->db->insert_id();

	            foreach ($helper as $key => $value) {
	                //echo $value;
	                $insert_helper = $this->M_crud->post_insert('SP_PURPOSE_HELPER', array('id_purpose' => $last_insert_id, 'email_helper' => $value));
	            }

	            //$insert_helper = $this->M_crud->post_insert('SP_PURPOSE_HELPER', );

				$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Create Purpose Berhasil</div>');

	         	redirect('purpose/new_purpose');

			}else{

				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error, Create Purpose Gagal '.$upload['message'].'</div>');

	         	redirect('purpose/new_purpose');

			}
		}

		public function add_helper($id=''){

	        $this->load->model('M_crud');

	        $data_helper = $this->M_crud->get_my_helper($this->session->userdata('data_user')[0]['email']);

	        if($id==''){

	            $data = array('main' => 'home/add_helper', 'helper_list' => $data_helper);

	        }else{

	            $id_purpose = base64_decode($id);

	            $detail_purpose = $this->M_crud->get_where('SP_PURPOSE', array('id' => $id_purpose));

	            $get_helper = $this->M_crud->get_where('SP_PURPOSE_HELPER', array('id_purpose' => $id_purpose));

	            $helper = array();
	            $i=0;
	            foreach ($get_helper->result() as $key => $value) {
	                $helper[$i] = $value->email_helper;
	                $i++;
	            }

	            $data = array('main' => 'home/add_helper', 'helper_list' => $data_helper, 'purpose_data' => $detail_purpose->result_array(), 'helper' => $helper, 'id_purpose' => $id_purpose);

	        }

			$this->load->view('home/home', $data);
		}

		public function submit_helper(){
			//print_r($this->input->post());
			$this->load->model('M_crud');

			$delfirst = $this->M_crud->delete('SP_PURPOSE_HELPER', array('id_purpose' => $this->input->post('id_purpose')));

			$helper = $this->input->post('helper');

			$i=0;
			$email_helper = array();
			foreach ($helper as $key => $value) {
				$add_helper = $this->M_crud->post_replace('SP_PURPOSE_HELPER', array('id_purpose' => $this->input->post('id_purpose'), 'email_helper' => $value));
				$i++;
			}

			$get_helper_in_purpose = $this->M_crud->get_where('SP_PURPOSE_HELPER', array('id_purpose' => $this->input->post('id_purpose')));

			$email_helper = array();
			$i=0;
			foreach ($get_helper_in_purpose->result() as $key => $value) {
				$email_helper[$i] = $value->email_helper;
				$i++;
			}

			$delete_task_unset_helper = $this->M_crud->delete_where_in('SP_TASK_PURPOSE', array('id_purpose' => $this->input->post('id_purpose')), 'email_helper', $email_helper);

			$get_id_task_unset = $this->M_crud->get_where_not_in('SP_TASK_PURPOSE', 'email_helper', $email_helper, array('id_purpose' => $this->input->post('id_purpose')));

			if(!empty($get_id_task_unset->result_array())){
				foreach ($get_id_task_unset->result() as $key => $value) {
					$id_task = $value->id_task;
					//delete semua progress where id purpose = and id task =
					$delete_progress = $this->M_crud->delete('SP_TASK_PROGRESS', array('id_purpose' => $this->input->post('id_purpose'), 'id_task' => $id_task));
					$delete_progress_log = $this->M_crud->delete('SP_TASK_PROGRESS_LOG', array('id_purpose' => $this->input->post('id_purpose'), 'id_task' => $id_task));
				}
			}

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Update Helper Berhasil</div>');

         	redirect('purpose/view_purpose');
		}

		public function history(){
			$data = array('main' => 'home/history');
			$this->load->view('home/home', $data);
		}

		public function pdf_history($id_purpose){

			$this->load->model('M_crud');
			//echo $id_purpose;
			$dc_id_purpose = base64_decode($id_purpose);

			$where = array(
				'id' => $dc_id_purpose
			);
		
			$purpose_query = $this->M_crud->get_where('SP_PURPOSE', $where);

			$data_purpose = array();
			foreach ($purpose_query->result() as $key => $value) {

				$select = 'MIN(add_at) as real_start, MAX(add_at) as real_finish';
				$getSETask = $this->M_crud->get_where('SP_TASK_PROGRESS_LOG', array('id_purpose' => $value->id), '', '', $select);

				$totalTask = $this->M_crud->get_where('SP_TASK_PURPOSE', array('id_purpose' => $value->id));

				$real_start = $getSETask->row()->real_start;
				$real_finish = $getSETask->row()->real_finish;

				$diff_est = abs(strtotime($value->end_date) - strtotime($value->start_date));
				$years_est = floor($diff_est / (365*60*60*24));
				$months_est = floor(($diff_est - $years_est * 365*60*60*24) / (30*60*60*24));
				$days_est = floor(($diff_est - $years_est * 365*60*60*24 - $months_est*30*60*60*24)/ (60*60*24));

				$diff = abs(strtotime($real_finish) - strtotime($real_start));
				$years = floor($diff / (365*60*60*24));
				$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
				$days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));

				$getHelper =  $this->M_crud->get_where('SP_PURPOSE_HELPER', array('id_purpose' => $value->id));

				$all_helper = array();
				foreach ($getHelper->result() as $key => $dtHelper) {
					$getDataHelper = $this->M_crud->get_where('SP_USER', array('email' => $dtHelper->email_helper));
					$all_helper[] = $getDataHelper->result_array();
				}

				$data_purpose[] = array(
					'id_purpose' => $value->id,
					'purpose' => $value->purpose,
					'est_start' => date('d M Y', strtotime($value->start_date)),
					'est_finish' => date('d M Y', strtotime($value->end_date)),
					'est_interval' => $years_est.' Tahun '. $months_est.' Bulan '. $days_est.' Hari',
					'real_start' => date('d M Y', strtotime($real_start)),
					'real_finish' => date('d M Y', strtotime($real_finish)),
					'real_interval' => $years.' Tahun '. $months.' Bulan '. $days.' Hari',
					'image_purpose' => $value->attachment,
					'total_task' => $totalTask
				);

			}

			//print_r($all_helper);
			$data = array('data_purpose' => $data_purpose, 'data_helper' => $all_helper);
			$this->load->view('home/pdf_history', $data);

		}

	}

?>