<?php

class m_login extends CI_Model {
    
     function create_user($data)
    {
        $this->db->insert('userinfo', $data);
//        print_r($this->db->insert_id());
        return $this->db->insert_id();
    }
  

    function login($email, $password) {
        $match = array( 'email' => $email, 'password' => md5($password));
        $this->db->select()->from('userinfo')->where($match);
        $query = $this->db->get();
        return $query->first_row('array');
    }
    
    function fblogin($fbid) {

        $q_str = "SELECT * FROM userinfo WHERE  fbid = '" . $fbid . "'" ;
        $query = $this->db->query($q_str );
          if($query->first_row('array')==NULL)
          {  
              return 0;
          }
          return $query->first_row('array');
    }
    function sendEmail($to_email) {
        $from_email = 'harriken.chuchu@gmail.com';
        $subject = 'Verify Your Email Address';
        $hash = md5($to_email);
        $url = base_url() . "index.php/user/verify?email=$to_email&hash=$hash";
        echo $message = 'Dear User,<br /><br />Please click on the below activation link to verify your email address.<br /><br /> http://www.gmail.com/user/verify/' . md5($to_email) . '<br /><br /><br />Thanks<br />Mydomain Team
			 <p> Please click this link to activate your account:</p>
                         <p><a target="_blank" href="' . $url . '"> Confirmation Link</a>  </p>';

        //configure email settings
        $config['protocol'] = 'smtp';
        $config['smtp_host'] = 'ssl://smtp.googlemail.com'; //smtp host name
        $config['smtp_port'] = '465'; //smtp port number
        $config['smtp_user'] = $from_email;
        $config['smtp_pass'] = 'harriken4321'; //$from_email password
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['newline'] = "\r\n"; //use double quotes
        $this->email->initialize($config);

        //send mail
        $this->email->from($from_email, 'gmail');
        $this->email->to($to_email);
        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    //activate user account
    function verifyEmailID($email, $key) {
        $data = array('active' => 1);
        $this->db->where('email', $email);
        $this->db->where('hash', $key);
        $this->db->update('userinfo', $data);
        $num_row = $this->db->affected_rows();
        if ($num_row > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}