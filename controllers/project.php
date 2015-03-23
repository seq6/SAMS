<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目列表页面
*/

class Project extends CI_Controller {

    private $data;

    function __construct() {
        parent::__construct();
        $data = array();
    }

    public function index() {
        $this->load->model('project_model');
        $objProject = new project_model;

        $this->load->view('project');
    }

}