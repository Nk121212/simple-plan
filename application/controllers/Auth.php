<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function login_page()
	{
		$this->load->view('login');
	}

	public function random_string(){
		$random = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 5);
		return $random;
	}

	public function register(){

		$this->load->library('email');
	    $this->config->load('email'); // load config.php di config folder

	    $config = $this->config->item('email'); //load return response dari config class by array key

	    $this->email->initialize($config);
	    $this->email->set_newline("\r\n");
	    $this->email->from('mail@SP.com', 'Simple Plan');
	    $this->email->to($this->input->post('email'));
	    $this->email->subject('Registrasi Akun Simple Plan');

		$postData = xssPrevent($this->input->post());
		$post = array_merge($postData, array('kode_otp' => $this->random_string()));

	    $data = array('post_data' => $post);
	    $this->email->message($this->load->view('email/register', $data, true));


	    if ($this->email->send()){

	    	$this->load->model('M_auth');

	    	$save_user = $this->M_auth->save_user($post);
	    	$save_to_log = $this->M_auth->save_log_confirmation($post);

	    	$this->session->set_flashdata('message', '<div class="alert alert-info" role="alert">Selamat, anda telah berhasil registrasi, Silakan buka email <b>(Inbox / Spam)</b> dan masukan kode verifikasi yang dikirim ke amail anda.</div><div class="alert alert-warning" role="alert">Kode verifikasi hanya valid selama 10 Menit setelah registrasi.</div>');

         	redirect('auth/confirmation_page');

	    }         
	    else{
	        show_error($this->email->print_debugger());
	    }

	}

	public function confirmation_page(){

		$this->load->view('confirmation');

	}

	public function submit_confirmation(){

		$this->load->model('M_auth');

		$email = $this->input->post('email');
		$otp = $this->input->post('otp');

		$check = $this->M_auth->check_valid_time($email, $otp);

		if($check->num_rows() === 0){

			$this->session->set_flashdata("message", "<div class='alert alert-warning' role='alert'>Verifikasi Gagal, pastikan kode OTP sudah sesuai</div>");

			redirect("auth/confirmation_page");

		}else{

			$this->M_auth->activate_user($email);
			$this->session->set_flashdata("message", "<div class='input-group col-lg-12 mb-4 alert alert-info text-center' role='alert'>Verifikasi Berhasil, Silakan login untuk memulai</div>");

			redirect("auth/login_page");

		}

	}

	public function submit_login(){

		$this->load->model('M_auth');

		$check = $this->M_auth->is_user_exist();

		//print_r($check->num_rows());

		if($check->num_rows() > 0){

			if (password_verify($this->input->post('password'), $check->row()->password)) {

				//echo 'verifiy oke';

				$data_login = array(
					'data_user' => $check->result_array(),
					'login' => true
				);

	            $this->session->set_userdata($data_login);

	            redirect('home');

	        } else {

	        	//echo 'verifiy gagal';

	            $this->session->set_flashdata("message", "<div class='input-group col-lg-12 mb-4 alert alert-info text-center' role='alert'>Login Gagal, periksa kembali email dan password</div>");
				
				redirect('auth/login_page');

	        }

		} else {

			$this->session->set_flashdata("message", "<div class='input-group col-lg-12 mb-4 alert alert-info text-center' role='alert'>Login Gagal, user tidak ditemukan</div>");
				
			redirect('auth/login_page');

		}

	}

	public function submit_logout() {

		$this->session->sess_destroy();

		redirect(base_url().'auth/login_page');

	}

}
