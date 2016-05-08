<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class m_post extends CI_Model{
    
      function get_posts($number = 10, $start = 0)
    {
//        $this->db->select();
//        $this->db->from('blog_post');
//        $this->db->where('status',1);
//        $this->db->order_by('created_at','desc');
//        $this->db->limit($number, $start);
//        $query = $this->db->get();
        $query = $this->db->query('SELECT p.id, p.title, p.description, p.created_at, author.fullname FROM blog_post as p, blog_author as author WHERE p.status = 1 ORDER BY p.id DESC LIMIT 5 OFFSET '.$start);
        return $query->result_array();
    }
    
    // for single post page view
    function get_post($post_id)
    {
//        $this->db->select();
//        $this->db->from('blog_post');
//        $this->db->where(array('status'=>1,'id'=>$post_id));
//        $this->db->order_by('created_at','desc');
//        $query = $this->db->get();
        $query = $this->db->query('SELECT p.id, p.title, p.description, p.created_at, author.fullname FROM blog_post as p, blog_author as author WHERE p.status = 1 AND p.id = '.$post_id);
        return $query->first_row('array');
    }
    function get_post_count()
    {
        $this->db->select()->from('blog_post')->where('status',1);
        $query = $this->db->get();
        return $query->num_rows;
    }
    
    function get_author_name($id) {
        $this->db->select('fullname')->from('blog_author')->where('id',$id);
        $query = $this->db->get();
        return $query->num_rows;
    }
}

