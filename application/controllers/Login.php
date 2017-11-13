<?php 
	defined('BASEPATH') OR exit('No direct script access allowed');

	/**
	 * login class - handle login module	 
	 */
	class Login extends CI_Controller {

		public function __construct(){
			parent::__construct();
			$this->output->enable_profiler(TRUE);
			$this->load->model(array('user_model'));
			$this->user_model->user_auth('login');
		}

		/**
		 * index function - load login form
		 *
		 * @return void
		 */
		public function index(){
			$this->load->view('login/login_index_view');
		}

		/**
		 * verify function - handle login verification of user
		 *
		 * @return mixed - redirect to either dashboard or login page
		 */
		public function verify(){
			if($this->input->server('REQUEST_METHOD') == 'POST'){
				
				// set validation
				$this->form_validation->set_rules(
					'username',
					'user name',
					'trim|required|xss_clean|min_length[5]|max_length[20]|regex_match[/^[a-z0-9_-]+$/]'
				);
				
				$this->form_validation->set_rules(
					'password',
					'password',
					'trim|required|xss_clean|min_length[6]|max_length[30]'
				);

				// run form validation
				if($this->form_validation->run() === false){
					$this->load->view('login/login_index_view');
				}else{

					// clean inputs
					$username = clean_input($this->input->post('username'));
					$password = clean_input($this->input->post('password'));

					// check login result
					$login_result = $this->user_model->resolve_login($username, $password);

					if($login_result === TRUE){
						// get user information
						$user_data = $this->user_model->get_user_by_key('username', $username);

						$session_data = array(
							'user_id' => $user_data[0]['user_id'],
							'user_type' => $user_data[0]['user_type'],
							'username' => $user_data[0]['username'],
							'page_access' => $user_data[0]['page_access'],
							'login_status' => TRUE,
							'logged_in' => TRUE,
						);
						
						$this->session->set_userdata($session_data);						

						redirect("dashboard");
					}else{
						$data['login_status'] = FALSE;

						$this->load->view('login/login_index_view', $data);
					}
				}				
			}else{
				redirect('custom_error/error/access_denied');
			}
		}
}
