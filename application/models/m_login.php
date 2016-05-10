<?php

class m_login extends CI_Model {
    
     function create_user($data)
    {
        $this->db->insert('userinfo', $data);
        print_r($this->db->insert_id());
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
    

    

}