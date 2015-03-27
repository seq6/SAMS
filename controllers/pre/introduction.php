<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Introduction extends CI_Controller
{
    private $data;

    private $objProjectModel;

    function __construct()
    {
        parent::__construct();

        $data = array();

        $this->load->model('project_model');
        $this->objProjectModel = new project_model;
    }

    public function index()
    {
        $pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        $project = $this->objProjectModel->get(array('id' => $pid));
        if ($pid != 0 && $project != null) {
            $_SESSION['pid'] = $pid;
            $_SESSION['pName'] = $project[0]['name'];
        }
        $this->load->view('pre/introduction');
    }
}