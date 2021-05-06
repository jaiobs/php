<?php

/* * ***
 *
 * Description of Auth Controller
 *
 * *** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load model
        $this->load->model('Auth_model', 'auth');
        $this->load->model('List_model', 'list');
        $this->load->library('form_validation');
    }

    public function index() {
		$this->login();
	}
    
    // login method
    public function login() {        
        $data = array();
        $data['metaDescription'] = 'Login';
        $data['metaKeywords'] = 'Login';
        $data['title'] = "Login";
        $data['breadcrumbs'] = array('Login' => '#');
        
        $this->load->view('auth/login', $data);
    }
    

    // action login method
    function doLogin() {        
        // Check form  validation
        $this->load->library('form_validation');
        $this->form_validation->set_rules('user_name', 'Email', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            //Field validation failed.  User redirected to login page
            $this->login();
        } else {
          $sessArray = array();
            //Field validation succeeded.  Validate against database
            $username = $this->input->post('user_name');
            $password = $this->input->post('password');
            
            $this->auth->setEmail($username);
            $this->auth->setPassword($password);
            //query the database
            $result = $this->auth->login();
            if (!empty($result) && count($result) > 0) {
                foreach ($result as $row) {
                    $authArray = array(
                        'user_id' => $row->user_id,
                        'email' => $row->email,
                        'is_authenticate_user' => TRUE,
                    );
                    $this->session->set_userdata('ci_session_key_generate', TRUE);
                    $this->session->set_userdata('ci_seesion_key', $authArray);                  
                }
                $this->dashboard();
            } else {
                $this->session->set_flashdata('err', "Invalid Password");
                $this->login();
            }
        }
    }

    //redirect to dashboard
    public function dashboard() {
        $result = array();
        $result['data']=$this->list->fetch_records();
        $result['metaDescription'] = 'List';
        $result['metaKeywords'] = 'List';
        $result['title'] = "List";
        $this->load->view('dashboard/list',$result);
    }

    //logout method
    public function logout() {
        $this->session->unset_userdata('ci_seesion_key');
        $this->session->unset_userdata('ci_session_key_generate');
        $this->session->sess_destroy();
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
        redirect('auth/login');
    }   

}
?>