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
       $this->load->view('v_home', $data);
   //        $this->load->view('v_signup.php'); 
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
        
        $this->load->view('v_home', $data);
    }
            
    function post($post_id)//single post page
    {
         $this->load->library('ckeditor');
        $this->load->library('ckfinder');

        //configure base path of ckeditor folder
        $this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        //configure ckfinder with ckeditor config
        $this->ckfinder->SetupCKEditor($this->ckeditor, '../../assets/ckfinder/');

        /** this is for ckeditor and ckfinder * */
       
        $this->load->model('m_comment');
        $data['comments'] = $this->m_comment->get_comment($post_id);  
        $data['post'] = $this->m_post->get_post($post_id);
        $this->load->view('header', $data);
        $this->load->view('v_single_post',$data);
        $this->load->view('footer');
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
