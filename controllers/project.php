<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表页面
*/

class Project extends CI_Controller {

    public function index() {
    	$this->load->model('project');
    	$objProject = new project;
    	

        $this->load->view('els_project');
    }

}