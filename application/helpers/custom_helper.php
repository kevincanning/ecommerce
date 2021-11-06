<?php

function setflashdata($class, $message, $url){
    $ci = get_instance();
    $ci->load->library('session');

    $ci->session->set_flashdata('class', $class);
    $ci->session->set_flashdata('message', $message);
    redirect($url);
}

function check_admin_logged_in(){
    $ci = get_instance();
    $ci->load->library('session');

    if($ci->session->userdata('id')){
        return true;
    } else {
        return false;
    }
}

function get_admin_id(){
    $ci = get_instance();
    $ci->load->library('session');

    if($ci->session->userdata('id')){
        return $ci->session->userdata('id');
    } else {
        return false;
    }
}
?>