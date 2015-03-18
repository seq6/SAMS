<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表页面
*/

class Els_project extends CI_Controller {

    public function index() {
        $this->load->view('project');
    }

}