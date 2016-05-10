<?php

class User extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('m_login');
    }

    function login() {
        
        //If already logged in
        if ($this->session->userdata("userid")) {
            redirect(base_url() . 'index.php/blog/');
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
            
             redirect(base_url() . 'index.php/blog/');
       }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect(base_url() . 'index.php/blog/');
    }
}
