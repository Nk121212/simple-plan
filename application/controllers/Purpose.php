<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Purpose extends CI_Controller {

		public function new_purpose($id=''){

	        $this->load->model('M_crud');

	        $data_helper = $this->M_crud->get_my_helper($this->session->userdata('email'));

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

				$insert = $this->M_crud->post_insert('SP_PURPOSE', $this->input->post(), array('attachment' => $upload['image_path'], 'email_user' => $this->session->userdata('email')));

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

	        $data_helper = $this->M_crud->get_my_helper($this->session->userdata('email'));

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
			foreach ($helper as $key => $value) {
				$add_helper = $this->M_crud->post_insert('SP_PURPOSE_HELPER', array('id_purpose' => $this->input->post('id_purpose'), 'email_helper' => $value));
				$i++;
			}

			$this->session->set_flashdata('message', '<div class="alert alert-primary" role="alert">Success, Add Helper Berhasil</div>');

         	redirect('purpose/view_purpose');
		}

	}

?>