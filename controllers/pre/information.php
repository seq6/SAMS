<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目基本信息
*/

class Information extends CI_Controller
{
    private $data;

    private $objProjectModel;

    private $objPjtypeModel;

    private $objPjrangeModel;

    private $objStaffModel;

    function __construct()
    {
        parent::__construct();

        $this->load->model('project_model');
        $this->objProjectModel = new Project_model;

        $this->load->model('pjtype_model');
        $this->objPjtypeModel = new PjType_model;

        $this->load->model('pjrange_model');
        $this->objPjrangeModel = new PjRange_model;

        $this->load->model('staff_model');
        $this->objStaffModel = new Staff_model;

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

        //设置会话信息
        if (!isset($_SESSION['project'])) {
            $this->init_project();
        }

        $pid = $_SESSION['project']['pid'];
        $this->data['project'] = $this->objProjectModel->get_project($pid);
        $this->data['project']['range'] = json_decode($this->data['project']['theRange']);
        $this->data['pjType'] = $this->objPjtypeModel->get_type();
        $this->data['pjRange'] = $this->objPjrangeModel->get_range();

        $this->load->view('pre/information', $this->data);

    }

    private function form()
    {
        $pid  = $_SESSION['project']['pid'];
        $name = isset($_POST['pjName']) ? $_POST['pjName'] : '';
        $type = isset($_POST['pjType']) ? $_POST['pjType'] : '';
        $range= isset($_POST['pjRange'])? $_POST['pjRange']: '';
        $goal = isset($_POST['pjGoal']) ? $_POST['pjGoal'] : '';
        $desc = isset($_POST['pjDesc']) ? $_POST['pjDesc'] : '';

        //判断必选
        if (!is_array($range) || !in_array('1', $range) || !in_array('2', $range) || !in_array('3', $range)) {
            $this->data['error'] = 2;
            return;
        }

        //更新数据
        $newData = array(   'name'    => $name,
                            'theType' => $type,
                            'theRange'=> json_encode($range),
                            'goal'    => $goal,
                            'theDesc' => $desc);
        $res = $this->objProjectModel->update_project($pid, $newData);

        //返回提示信息
        if ($res == false) {
            $this->data['error'] = 2;
        }
        else {
            $this->data['error'] = 1;
            if ($name != $_SESSION['project']['name']) {
                $_SESSION['project']['name'] = $name;
            }
        }
    }

    private function init_project()
    {
        $pid = isset($_GET['pid']) ? $_GET['pid'] : 0;
        $project = $this->objProjectModel->get_project($pid);
            
        $_SESSION['project'] = array();
        $_SESSION['project']['pid'] = $project['id'];
        $_SESSION['project']['name'] = $project['name'];
        

        if ($project['goal'] == null || $project['theDesc'] == null) {
            $_SESSION['project']['info'] = 0;
        }
        else {
            $_SESSION['project']['info'] = 1;
        }

        $_SESSION['project']['memberNum'] = $this->objStaffModel->get_staffs_count($pid);

        if ($project['partA'] == null || $project['partB'] == null) {
            $_SESSION['project']['part'] = 0;
        }
        else {
            $_SESSION['project']['part'] = 1;
        }

        $_SESSION['project']['status'] = $project['status'];
    }
}