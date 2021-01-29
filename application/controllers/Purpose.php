<?php

defined('BASEPATH') OR exit('No direct script access allowed');

	class Purpose extends CI_Controller {

		public function new_purpose($id=''){

	        $this->load->model('M_crud');

	        $data_helper = $this->M_crud->get_my_helper($this->session->userdata('email'));

	        if($id==''){

	            $data = array('main' => 'home/add_purpose', 'helper_list' => $data_helper);

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

			$purpose = $this->input->post('purpose');
			$upload = $this->do_upload('upload/', $purpose);

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

		public function do_upload($upload_path, $file_name)
	    {
	    	$this->load->library('upload');

	        $config['upload_path']          = $upload_path;
	        $config['allowed_types']        = '*';
	        $config['max_size']             = 1300;
	        $config['max_width']            = 6000;
	        $config['max_height']           = 6000;
	        $config['file_name']           	= $file_name;
	        $config['overwrite']           	= true;
	        $config['encrypt_name']         = true;

	        $this->load->library('upload', $config);
	        $this->upload->initialize($config);

	        if ( ! $this->upload->do_upload('upload'))
	        {
	                $error = array('error' => $this->upload->display_errors());
	                $arr = array(
	                	'status' => 'error',
	                	'message' => $this->upload->display_errors(),
	                	'color' => 'danger'
	                );

	                return $arr;

	                //$this->load->view('upload_form', $error);
	        }
	        else
	        {
	                $data = array('upload_data' => $this->upload->data());
					$arr = array(
	                	'status' => 'ok',
	                	'message' => 'upload success',
	                	'image_path' => $config['upload_path'].$this->upload->data('file_name'),
	                	'color' => 'primary'
	                );

	                return $arr;
	                //$this->load->view('upload_success', $data);
	        }
	    }

	}

?>