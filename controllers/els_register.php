<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     注册页面
*/

class Els_register extends CI_Controller {

    public function index() {
        $this->session->unset_userdata('uid');
        $this->session->unset_userdata('pid');
        $this->session->unset_userdata('email');

        $this->load->view('els_login');
    }
}