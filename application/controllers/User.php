<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

	public function index()	{
		$this->load->view('main');
	}

	public function login(){
		$mobile = $this->agent->is_mobile();
		$this->load->view("login", $mobile);
	}

	public function login_action(){
		$session = $this->session->userdata("username");

		if( isset($session) || !empty($session) )
			redirect("https://nekop.kr/");

		$username = $this->input->post("username");
		$password = hash("sha256", $this->input->post("password"));

		if( !isset($username) || empty($username) )
			redirect("https://nekop.kr/");

		$result = $this->db->get_where("user", 
				array(
					"username" => $username,
					"password" => $password
				)
		)->result();

		if( empty($result) )
			redirect("https://nekop.kr/user/login");

		$resObj = $result[0];
		$this->session->set_userdata("username", $resObj->username);
		$this->session->set_userdata("auth", $resObj->auth);

		redirect("https://nekop.kr/service");
	}

	public function logout(){
		$session = $this->session->userdata("username");

		if( !isset($session) || empty($session) )
			redirect("https://nekop.kr");

		$this->session->sess_destroy();
		redirect("https://nekop.kr");
	}
}
