<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Fblogin extends CI_Controller {

    public $user = null;

    public function __construct() {

        parent::__construct();

        parse_str($_SERVER['QUERY_STRING'], $_REQUEST);
        $this->load->library('facebook', array("appId" => '1070860369600395', "secret" => 'e2c9d6121c42347b69a5788bf2ddd4f8'));
        $this->user = $this->facebook->getUser();

        $this->load->model('m_login');
    }

    public function index() {

        if ($this->user) {
            try {
                $user_profile = $this->facebook->api('/me?fields=id,name,birthday,email,gender,picture');

// check if user is in db using fbid : m_user model(SELECT)
// if not, then new user entry (INSERT ACTIVE), and then get userid, username, userimage (entry type: blog)
// else, get userid, username, useremail(SELECT)
// create session
// redirect to blog page
//
                $temp['fbid'] = $user_profile['id'];
//
//                    if ($this->session->userdata("userid")) {//If already logged in
//                        redirect(base_url()); //redirect to the blog page
//                    }

                $user = $this->m_login->fblogin($temp['fbid']);

                if ($user == 0) { // new fb user, so insert info in the table
                    $fbdata['fbid'] = $user_profile['id'];
                    $fbdata['email'] = $user_profile['email'];
                    $fbdata['fullname'] = $user_profile['name'];
                    $fbdata['status'] = 1;
                    $fbdata['gender'] = $user_profile['gender'];
                    $fbdata['dateofbirth'] = $user_profile['birthday'];

                    $user_id = $this->m_login->create_user($fbdata);

                    $this->session->set_userdata('userid', $user_id);
                    $this->session->set_userdata('fullname', $fbdata['fullname']);
                } else {
                    $this->session->set_userdata('userid', $user['userid']);
                    $this->session->set_userdata('email', $user['email']);
                    $this->session->set_userdata('fbid', $user['fbid']);
                }
            } catch (FacebookApiException $e) {
                print_r($e);
                $user = null;
            }
        }

        //redirect(base_url() . 'index.php/blog/');

        if ($this->user) {
            //print_r($this->session->all_userdata());
            //$this->session->sess_destroy();
            //$logout = $this->facebook->getLogoutUrl(array("next" => base_url() . 'index.php/fblogin/fblogout/'));
            //echo "<a href=" . $logout . ">" . "Logout" . "</a>";
            redirect(base_url() . 'blog/');

            //TODO : JS : Show 'you're logged in as JAMES'
        } else {
            $login = $this->facebook->getLoginUrl();
            redirect($login);
        }
//
//        $this->load->view('post.html');
//        $this->load->view('header');
//        $this->load->view('index.html', $data);
//        $this->load->view('footer');
    }

    function fblogout() {

        session_destroy();
        redirect(base_url() . 'fblogin');
    }

}
?>

