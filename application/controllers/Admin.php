<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function index()
	{
        if($this->session->userdata('id')){
            $this->load->view('admin/header/header');
            $this->load->view('admin/css/style');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navside');
            $this->load->view('admin/home/index');
            $this->load->view('admin/js/js');
            $this->load->view('admin/footer/index');
        }
        else {
            setflashdata('alert alert-danger', 'Please login again to access the admin panel!', 'admin/login');
        }
	}

    public function login()
	{
        $this->load->view('admin/login');
	}

    public function check_admin()
	{
        $data['email'] = $this->input->post('email', true);
        $data['password'] = $this->input->post('password', true);

        if(!empty($data['email']) && !empty($data['password'])){
            $admin = $this->Model_Admin->check_admin($data);

            if(count($admin) == 1){
                $session = array(
                    'id' => $admin[0]['id'],
                    'name' => $admin[0]['name'],
                    'email' => $admin[0]['email'],
                );

                $this->session->set_userdata($session);

                if($this->session->get_userdata($session)){
                    echo 'session created';
                    redirect('admin');
                } else {
                    echo 'session not created';
                }
            }
            else{
                setflashdata('alert alert-warning', 'Email or password do not match, please try again!', 'admin/login');
            }
        } else{
            setflashdata('alert alert-warning', 'Please check the required fields!', 'admin/login');
        }
	}

    public function logout()
	{
        if($this->session->userdata('id')){
            $this->session->userdata('id', '');
            setflashdata('alert alert-danger', 'You have successfully logged out!', 'admin/login');    
        } else {
            setflashdata('alert alert-warning', 'Please login again!', 'admin/login');    
        }
    }

    public function new_category()
    {
        if(check_admin_logged_in()){
            $this->load->view('admin/header/header');
            $this->load->view('admin/css/style');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navside');
            $this->load->view('admin/category/add_category');
            $this->load->view('admin/js/js');
            $this->load->view('admin/footer/index');
        } else {
            setflashdata('alert alert-warning', 'Please login again to add your categories!', 'admin/login');    
        }
    }

    public function add_category()
    {
        if(check_admin_logged_in()){
            $data['name'] = $this->input->post('name', true);
            
            if(!empty($data['name']))
            {
                $path = realpath(APPPATH . '../assets/images/categories');
                $config['upload_path'] = $path;
                $config['allowed_types'] = 'gif|png|jpg|jpeg';
                $this->load->library('upload', $config);

                if(!$this->upload->do_upload('image'))
                {
                    $danger = $this->upload->display_dangers();
                    setflashdata('alert alert-warning', $danger, 'admin/new_category');
                } else 
                {
                    $filename = $this->upload->data();
                    $data['image'] = $filename['file_name'];
                    $data['date'] = date('Y-m-d h:i');
                    $data['admin_id'] = get_admin_id();
                    $data['status'] = 1;
                }

                $checkData = $this->Model_Admin->check_category($data);

                if($checkData->num_rows() > 0)
                {
                    setflashdata('alert alert-danger', 'The category already exist!', 'admin/new_category');
                } else 
                {
                    $addData = $this->Model_Admin->add_category($data);
                    if($addData)
                    {
                        setflashdata('alert alert-success', 'You have successfully add a category!', 'admin/new_category');
                    } else 
                    {
                        setflashdata('alert alert-danger', 'You cannot add a category right now!', 'admin/new_category');
                    }    
            } 
        } else 
            {
                setflashdata('alert alert-warning', 'Category name is required!', 'admin/new_category');
            }
            $data['image'] = $this->input->post('image', true);
        } else 
        {
            setflashdata('alert alert-danger', 'Please login again to add your categories!', 'admin/login');    
        }
    }

    public function all_categories(){
        if(check_admin_logged_in()){
            $config['base_url'] = site_url('admin/all_categories');
            $total_rows = $this->Model_Admin->get_all_categories();

            $config['total_rows'] = $total_rows;
            $config['per_page'] = 10;
            $config['uri_segment'] = 3;
            $this->load->library('pagination');
            $this->pagination->initialize($config);

            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

            $data['all_categories'] = $this->Model_Admin->all_categories_num_rows($config['per_page'], $page);
            $data['links'] = $this->pagination->create_links();

            $this->load->view('admin/header/header');
            $this->load->view('admin/css/style');
            $this->load->view('admin/header/navtop');
            $this->load->view('admin/header/navside');
            $this->load->view('admin/category/all_categories', $data);
            $this->load->view('admin/js/js');
            $this->load->view('admin/footer/index');
        }
        else {
            setflashdata('alert alert-danger', 'Please login again to view your categories!', 'admin/login');    
        }
    }

    public function edit_category($id){
        if(check_admin_logged_in()){
            if(!empty($id) && isset($id)){
                $data['category'] = $this->Model_Admin->check_category_by_id($id);

                if(count($data['category']) == 1){
                    $this->load->view('admin/header/header');
                    $this->load->view('admin/css/style');
                    $this->load->view('admin/header/navtop');
                    $this->load->view('admin/header/navside');
                    $this->load->view('admin/category/edit_category', $data);
                    $this->load->view('admin/js/js');
                    $this->load->view('admin/footer/index');
                }
                else {
                    setflashdata('alert alert-danger', 'Category not found!', 'admin');    
                }
            }
            else {
                
            }
        }
        else {
            setflashdata('alert alert-danger', 'Please login again to edit your categories!', 'admin/login');    
        }
    }

    public function update_category(){
        if(check_admin_logged_in()){
            $data['name'] = $this->input->post('name', true);
            $old_image = $this->input->post('old_image', true);
            $category_id = $this->input->post('category_id', true);

            if(!empty($old_image) && isset($old_image)){   
                if(isset($_FILES['image']) && is_uploaded_file($_FILES['image']['tmp_name'])){
                    $path = realpath(APPPATH . '../assets/images/categories');
                    $config['upload_path'] = $path;
                    $config['allowed_types'] = 'gif|png|jpg|jpeg';
                    $this->load->library('upload', $config);
    
                    if(!$this->upload->do_upload('image'))
                    {
                        $danger = $this->upload->display_dangers();
                        setflashdata('alert alert-warning', $danger, 'admin/all_category');
                    } else 
                    {
                        $filename = $this->upload->data();
                        $data['image'] = $filename['file_name'];
                        $data['date'] = date('Y-m-d h:i');
                        $data['admin_id'] = get_admin_id();
                        $data['status'] = 1;
                    }
                }            
                $update_category = $this->Model_Admin->update_category($data, $category_id);
                if($update_category){
                    if(!empty($data['image'] && isset($data['image']))){
                        if(file_exists($path.'/'.$old_image)){
                            unlink($path.'/'.$old_image);
                        }
                    }
                    setflashdata('alert alert-success', 'You have successfully updated the category.', 'admin/all_categories');  
                } else {
                    setflashdata('alert alert-danger', 'You\'t cant update your category right now!', 'admin/all_categories');    
                }
                }
                else {
                    setflashdata('alert alert-danger', 'Category name is required!', 'admin');    
                }
            
        }
        else {
            setflashdata('alert alert-danger', 'Please login again to edit your categories!', 'admin/all_categories');    
        }
    }
}