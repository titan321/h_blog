<?php

class Blog extends CI_Controller
{   
    function __construct() 
    {
        parent::__construct();
        $this->load->model('m_post');
        $this->load->model('m_login');
    }
    
    
    
    
    
    function index($start = 0)//index page
    {
        
        $data['posts'] = $this->m_post->get_posts(5, $start);
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/index.php/blog/page/';//url to set pagination
        $config['total_rows'] = $this->m_post->get_post_count();
        $config['per_page'] = 5; 
        $config['use_page_numbers'] = TRUE;

        $this->pagination->initialize($config); 
        $data['pages'] = $this->pagination->create_links(); //Links of pages
        $data['userinfo'] = $this->session->all_userdata();
        $this->load->view('header', $data);
        $this->load->view('index.html', $data);
        $this->load->view('footer');
    }
    
    function page($start = 0) {
        
        $data['posts'] = $this->m_post->get_posts(5, $start);
        
        $this->load->library('pagination');
        $config['base_url'] = base_url().'/index.php/blog/page/';//url to set pagination
        $config['total_rows'] = $this->m_post->get_post_count();
        $config['per_page'] = 5; 
        $config['use_page_numbers'] = TRUE;
        $this->pagination->initialize($config); 
        $data['pages'] = $this->pagination->create_links(); //Links of pages
        
        $this->load->view('index.html', $data);
    }
            
    function post($post_id)//single post page
    {    
        $data['post'] = $this->m_post->get_post($post_id);
        $this->load->view('post.html',$data);
    }
     

}

////Customizing the Total Pagination
//        $config['full_tag_open'] = '<div class="container"><ul class="pagination">';
//        $config['full_tag_close'] = '</ul></div>';
//
////Customizing the First Link
//        $config['first_link'] = '<<';
//        $config['first_tag_open'] = '<li>';
//        $config['first_tag_close'] = '</li>';
//
////Customizing the Last Link
//        $config['last_link'] = '>>';
//        $config['last_tag_open'] = '<li>';
//        $config['last_tag_close'] = '</a></li>';
//
//// Customizing the "Next" Link
//        $config['next_link'] = '>';
//        $config['next_tag_open'] = '<li>';
//        $config['next_tag_close'] = '</li>';
//
////Customizing the "Previous" Link
//        $config['prev_link'] = '<';
//        $config['prev_tag_open'] = '<li>';
//        $config['prev_tag_close'] = '</li>';
//
//// Customizing the "Current Page" Link
//        $config['cur_tag_open'] = '<li class="active">';
//        $config['cur_tag_close'] = ' <span class="sr-only">(current)</span></li>';
//
//// Customizing the "Digit" Link
//        $config['num_tag_open'] = '<li>';
//        $config['num_tag_close'] = '</li>';
