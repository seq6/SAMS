<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
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
        else {

            $this->load->view('pre/start', $this->data);
        }
    }

    public function form()
    {
        # code...
    }
}