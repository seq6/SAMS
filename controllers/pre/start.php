<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目启动
*/

class Start extends CI_Controller
{
    private $data;

    private $objProjectModel;

    private $objPjtypeModel;

    private $objPjrangeModel;

    private $objPartsModel;

    private $objStaffModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '项目启动';
        $this->data['tag']['content'] = '请确认项目信息后启动项，只有项目启动后才能进入下一阶段的工作';

        $this->load->model('project_model');
        $this->objProjectModel = new Project_model;

        $this->load->model('pjtype_model');
        $this->objPjtypeModel = new PjType_model;

        $this->load->model('pjrange_model');
        $this->objPjrangeModel = new PjRange_model;

        $this->load->model('parts_model');
        $this->objPartsModel = new Parts_model;

        $this->load->model('staff_model');
        $this->objStaffModel = new Staff_model;

        $this->load->model('position_model');
        $this->objPositionModel = new Position_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $pid = $_SESSION['project']['pid'];
        $this->data['project'] = array();

        $project = $this->objProjectModel->get_project($pid);
        $this->data['project'] = $project;

        $typeid = $project['theType'];
        $pjtype = $this->objPjtypeModel->get_type_byid($typeid);
        $this->data['project']['type'] = $pjtype['name'];

        $pjrange = $this->objPjrangeModel->get_range();
        $rangeData = array();
        foreach ($pjrange as $r) {
            $rangeData[$r['id']] = $r['name'];
        }
        $rangids = json_decode($project['theRange']);
        $this->data['project']['range'] = array();
        foreach ($rangids as $rid) {
            if (isset($rangeData[$rid])) {
                array_push($this->data['project']['range'], $rangeData[$rid]);
            }
        }

        $pAid = $project['partA'];
        $this->data['project']['partA'] = array();
        $partA = $this->objPartsModel->get_part($pAid);
        $this->data['project']['partA']['name']   = $partA['name'];
        $this->data['project']['partA']['leader'] = $partA['leader'];
        $this->data['project']['partA']['mobile'] = $partA['mobile'];
        $this->data['project']['partA']['email']  = $partA['email'];
        $this->data['project']['partA']['desc']   = $partA['remarks'];

        $pBid = $project['partB'];
        $this->data['project']['partB'] = array();
        $partB = $this->objPartsModel->get_part($pBid);
        $this->data['project']['partB']['name']   = $partB['name'];
        $this->data['project']['partB']['leader'] = $partB['leader'];
        $this->data['project']['partB']['mobile'] = $partB['mobile'];
        $this->data['project']['partB']['email']  = $partB['email'];
        $this->data['project']['partB']['desc']   = $partB['remarks'];

        $staffs = $this->objStaffModel->get_all_staffs($pid);
        $positins = $this->objPositionModel->get_position();
        $positinsData = array();
        foreach ($positins as $p) {
            $positinsData[$p['id']] = $p['name'];
        }
        foreach ($staffs as $key => $s) {
            $staffs[$key]['position'] = $positinsData[$s['posid']];
        }
        $this->data['project']['members'] = $staffs;

        $this->data['project']['goal'] = $project['goal'];
        $this->data['project']['desc'] = $project['theDesc'];

        $this->load->view('pre/start', $this->data);
    }

    public function form()
    {
        $pid = $_SESSION['project']['pid'];
        $res = $this->objProjectModel->start_project($pid);
        if ($res != false) {
            $this->data['error'] = 1;
        }
        else {
            $this->data['error'] = 0;
        }
    }
}