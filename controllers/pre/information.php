<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Information extends CI_Controller
{
    private $data;

    private $objProjectModel;

    private $objPjtypeModel;

    private $objPjrangeModel;

    function __construct()
    {
        parent::__construct();

        $this->load->model('project_model');
        $this->objProjectModel = new Project_model;

        $this->load->model('pjtype_model');
        $this->objPjtypeModel = new PjType_model;

        $this->load->model('pjrange_model');
        $this->objPjrangeModel = new PjRange_model;

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '评估类型';
        $this->data['tag']['content'] = '项目启动时必须定义项目的类型，评估工作将依据项目类型进行，不同类型的项目工作内容也不相同';

    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }
        else {
            if (!isset($_SESSION['project'])) {
                $this->init_project();
            }
            $this->data['type'] = $this->objPjtypeModel->get_type();
            $this->data['range'] = $this->objPjrangeModel->get_range();

            $this->load->view('pre/information', $this->data);
        }
    }

    private function form()
    {

    }

    private function init_project()
    {
        $pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        $project = $this->objProjectModel->get_projetc($pid);
            
        $_SESSION['project'] = array();
        $_SESSION['project']['pid'] = $project['id'];
        $_SESSION['project']['name'] = $project['name'];
        $_SESSION['project']['status'] = $project['status'];
        $_SESSION['project']['type'] = $project['theType'];
        $_SESSION['project']['range'] = json_decode($project['theRange']);
        $_SESSION['project']['partA'] = $project['partA'];
        $_SESSION['project']['partB'] = $project['partB'];
        $_SESSION['project']['updatetime'] = $project['updatetime'];
        $_SESSION['project']['goal'] = $project['goal'];
        $_SESSION['project']['desc'] = $project['theDesc'];
    }
}