<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Member extends CI_Controller {

    public function index() {
        $this->load->view('pre/member');
    }

}