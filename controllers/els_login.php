<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆页面
*/

class Els_login extends CI_Controller {

    public function index() {
        $this->load->view('els_login');
    }

}
