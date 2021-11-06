<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function index()
	{
		$this->load->view('header/header');
        $this->load->view('css/style');
        $this->load->view('header/navbar');
        $this->load->view('home/index');
        $this->load->view('js/js');
        $this->load->view('footer/footer');
	}

    public function aboutus()
	{
        $this->load->view('header/header');
        $this->load->view('css/style');
        $this->load->view('css/extracss');
        $this->load->view('header/navbar');
        $this->load->view('aboutus/index');
        $this->load->view('js/js');
        $this->load->view('js/extrajs');
        $this->load->view('footer/footer');
	}

    public function login()
	{
        $this->load->view('header/header');
        $this->load->view('css/style');
        $this->load->view('header/navbar');
        $this->load->view('login/index');
        $this->load->view('js/js');
        $this->load->view('footer/footer');
	}
}
