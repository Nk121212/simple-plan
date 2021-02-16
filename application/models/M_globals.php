<?php

class M_globals extends CI_Model{

	public function do_upload($upload_path, $file_name)
    {
    	$this->load->library('upload');

        $config['upload_path']          = $upload_path;
        $config['allowed_types']        = 'pdf|PDF|jpg|JPG|jpeg|JPEG|png|PNG';
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
                    'image_path' => '',
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
                	'message' => 'Upload Success',
                	'image_path' => $config['upload_path'].$this->upload->data('file_name'),
                	'color' => 'success'
                );

                return $arr;
                //$this->load->view('upload_success', $data);
        }
    }

}