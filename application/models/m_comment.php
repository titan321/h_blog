<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_comment extends CI_Model
{
    function add_comment($data)
    {
        $this->db->insert('blog_comment',$data);
        return $this->db->insert_id();
    }
    
    function get_comment($post_id)
    {
        $this->db->select('blog_comment.*,userinfo.fullname,userinfo.profileimage');
        $this->db->from('blog_comment');
        $this->db->join('userinfo','userinfo.userid = blog_comment.user_id', 'left');
        $this->db->where('post_id',$post_id);
        $this->db->order_by('created_at','asc');
        $query = $this->db->get();
//        print_r($query->result_array());exit();
        return $query->result_array();
    }
}

