<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_post');
        $this->load->model('m_login');
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation', 'email'));
        $this->load->database();
    }

    function login() {
        
        //If already logged in
        if ($this->session->userdata("userid")) {
            redirect(base_url() . 'blog/');
        }

        if ($this->input->post()) {//data inputed for login
            
            $email = $this->input->post('email', TRUE);
            $password = $this->input->post('password', TRUE);

            $user = $this->m_login->login($email, $password);
            
            if ($user) { 
                $this->session->set_userdata('userid', $user['userid']);
                $this->session->set_userdata('email', $user['email']);   
            } else {
                //TODO : Enter a javascript prompt to say "Incorrect Username or Password"
            }
            
             redirect(base_url() . 'blog/');
       }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'blog/');
    }

    function register($start=0) {
        
        
        $data['posts'] = $this->m_post->get_posts(5, $start);
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/index.php/blog/page/';//url to set pagination
        $config['total_rows'] = $this->m_post->get_post_count();
        $config['per_page'] = 5; 
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config); 
        $data['pages'] = $this->pagination->create_links(); //Links of pages
        $data['userinfo'] = $this->session->all_userdata();
        
        
        
        //set validation rules
//        $this->form_validation->set_rules('fname', 'First Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
//        $this->form_validation->set_rules('lname', 'Last Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('fullname', 'Full Name', 'trim|required|alpha|min_length[3]|max_length[30]|xss_clean');
        $this->form_validation->set_rules('email', 'Email ID', 'trim|required|valid_email|is_unique[userinfo.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|md5');
        $this->form_validation->set_rules('cpassword', 'Confirm Password', 'trim|required|matches[password]|md5');

        //validate form input
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('header', $data);
            $this->load->view('v_home', $data);
            $this->load->view('footer');
            // fails
        } else {
            //insert the user registration details into database
            $data = array(
                'fullname' => $this->input->post('fullname'),
//                'lname' => $this->input->post('lname'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'hash' => md5($this->input->post('email'))
            );

            // insert form data into database
            if ($this->m_login->create_user($data)) {
                
//                print_r($this->m_login->create_user($data));exit();
                // send email
                if ($this->m_login->sendEmail($this->input->post('email'))) {
                    // successfully sent mail
                    $this->session->set_flashdata('msg', '<div class="alert alert-success text-center">You are Successfully Registered! Please confirm the mail sent to your Email-ID!!!</div>');
                    redirect('user/register');
                } else {
                    // error
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                    redirect('user/register');
                }
            } else {
                // error
                $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Oops! Error.  Please try again later!!!</div>');
                redirect('user/register');
            }
        }
    }

    function verify() {
        $email = $this->input->get('email');
        $hash = $this->input->get('hash');

        $check = $this->m_login->verifyEmailID($email, $hash);
        if ($check) {
            $this->session->set_flashdata('verify_msg', '<div class="alert alert-success text-center">Your Email Address is successfully verified! Please login to access your account!</div>');
            redirect('user/register');
        } else {
            $this->session->set_flashdata('verify_msg', '<div class="alert alert-danger text-center">Sorry! There is error verifying your Email Address!</div>');
            redirect('user/register');
        }
    }

}
