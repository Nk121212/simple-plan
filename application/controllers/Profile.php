<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profile extends CI_Controller {

    public function index(){

        $this->load->model('M_crud');

        $my_profile = $this->M_crud->get_where('SP_USER', array('email' => $this->session->userdata('data_user')[0]['email']));

        $data = array('main' => 'home/profile', 'profile' => $my_profile->result_array());
		$this->load->view('home/home', $data);
    }

    public function submit_update(){

        $this->load->model('M_crud');
        $this->load->model('M_globals');

        $postData = array_filter($this->input->post());

        $upload = $this->M_globals->do_upload('upload/profile/', $postData['first_name'].'_'.$postData['last_name']);

        if(isset($postData['password'])){

            $hash_password = password_hash($postData['password'], PASSWORD_DEFAULT);    

            unset($_POST['password']);

            if($upload['image_path'] == ''){
                $array_merge = array('password' => $hash_password);
            }else{
                $array_merge = array('password' => $hash_password, 'image' => $upload['image_path']);
            }

            $join_with_password = array_merge($postData, $array_merge);

            $update = $this->M_crud->update('SP_USER', $join_with_password);

        }else{
            //password tidak ada
            if($upload['image_path'] == ''){
                $array_merge = array();
            }else{
                $array_merge = array('image' => $upload['image_path']);
            }

            $update = $this->M_crud->update('SP_USER', array_merge($postData, $array_merge));
        }

        if($update){
            //jika update sukses
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Update Profile Success !</div>
            <div class="alert alert-'.$upload['color'].'" role="alert">'.ucfirst($upload['message']).'</div>');
            
        }else{

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Update Profile Gagal !</div>
            <div class="alert alert-'.$upload['color'].'" role="alert">'.ucfirst($upload['message']).' !</div>');

        }

        redirect(base_url().'profile');
        
    }

}