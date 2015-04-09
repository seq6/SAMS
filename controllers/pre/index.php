<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Index extends CI_Controller
{
    private $objProjectModel;

    function __construct()
    {
        parent::__construct();

        $this->load->model('project_model');
        $this->objProjectModel = new Project_model;
    }

    public function index()
    {
        echo "string";
        $pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        if ($pid == 0) {
            $this->load->view('project');
        }
        else {
            $project = $this->objProjectModel->get_projetc($pid);
            if ($project == false) {
                $this->load->view('project');
            }
            else {
                $_SESSION['project'] = array();
                $_SESSION['project']['pid'] = $project['id'];
                header('location:pre/information');
            }
        }
    }
}