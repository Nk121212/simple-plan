
<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ask_help extends CI_Controller {

	public function index(){
		$data = array('main' => 'home/ask_help');
		$this->load->view('home/home', $data);
	}

	public function view_purpose(){
		$data = array('main' => 'home/view_purpose');
		$this->load->view('home/home', $data);
	}

	public function add_helper_modal(){
		$this->load->view('home/modals/add_helper');
	}

	public function submit_purpose(){
		$this->load->model('M_crud');
		//print_r($this->input->post());
		$purpose = $this->input->post('purpose');
		$upload = $this->do_upload('upload/', $purpose);

		if($upload['status'] == 'ok'){

			$insert = $this->M_crud->post_insert('SP_PURPOSE', array('attachment' => $upload['image_path']));

			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Success, Create Purpose Berhasil</div>');

         	redirect('ask_help/index');

		}else{

			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Error, Create Purpose Gagal</div>');

         	redirect('ask_help/index');

		}
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
