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

        $postData = $this->input->post();

        $upload = $this->M_globals->do_upload('upload/profile/', $postData['first_name'].'_'.$postData['last_name']);

        if(isset($postData['password'])){
            $hash_password = password_hash($postData['password'], PASSWORD_DEFAULT);

            unset($_POST['password']);

            $join_with_password = array_merge($postData, array('password' => $hash_password, 'image' => $upload['image_path']));

            $update = $this->M_crud->update('SP_USER', $join_with_password);

        }else{
            //password tidak ada
            $update = $this->M_crud->update('SP_USER', array_merge(array_filter($postData), array('image' => $upload['image_path'])));
        }

        if($update){
            //jika update sukses
            $this->session->set_flashdata('message', '<div class="alert alert-'.$upload['color'].'" role="alert">'.ucfirst($upload['status']).', Update Profile Berhasil !, '.$upload['message'].'</div>');
            
        }else{

            $this->session->set_flashdata('message', '<div class="alert alert-'.$upload['color'].'" role="alert">'.ucfirst($upload['status']).', Update Profile Gagal !, '.$upload['message'].'</div>');

        }

        redirect(base_url().'profile');
        
    }

}