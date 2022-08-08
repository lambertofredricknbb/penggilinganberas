<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent:: __construct();
		$this->load->model('M_auth');
		$this->load->library('form_validation');
	}
	public function index()
	{
		$this->load->view('auth/login');
	}
	public function proses_login()
	{
		$this->form_validation->set_rules('username', 'User', 'trim|required');
		$this->form_validation->set_rules('password', 'Pass', 'trim|required');
		// $this->form_validation->set_rules('captcha', 'Cap', 'trim|callback_check_captcha|required');
		// if ($this->input->post('captcha') == $this->session->userdata('mycaptcha')) {
		// 	$this->form_validation->set_rules('username', 'User', 'trim|required');
			if ($this->form_validation->run() == false) {
				redirect('auth/index');
				// echo "salah username";
			}else{
				$username = $this->input->post('username', TRUE);
				$password = $this->input->post('password', TRUE);
				$validate = $this->M_auth->cek_login($username, $password);
				if ($validate->num_rows() > 0) {
					$data = $validate->result_array()[0];
					$username = $data['username'];
					$password = $data['password'];
					$email =  $data['email'];
					$level = $data['level'];

					$session = array(
						'username' => $username,
						'password' => $password,
						'email' => $email,
						'level' => $level
					);
					$this->session->set_userdata($session);
					redirect('admin/index');
					// if ($jabatan === 1) {
					// 	redirect('admin/index');
					// }
					// if ($level === 2) {
					// 	redirect('');
					// }
				}else{
					redirect('auth/index');
				}
			}
		
	}

	public function logout()
	{
		$this->session->unset_userdata('username');
		$this->session->unset_userdata('password');
		session_destroy();
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">
			Selamat Akun Telah Logout!!
			</div>');
		redirect('auth/index');
	}

}
