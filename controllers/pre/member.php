<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Member extends CI_Controller
{
    private $data;

    private $objStaffModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '项目人员';
        $this->data['tag']['content'] = '参与项目的人员情况，便于项目中进行联络和沟通';

        $this->load->model('staff_model');
        $this->objStaffModel = new Staff_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }
        else {
            $pid = $_SESSION['project']['pid'];
            $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
            $limit = 10;
            $offset = $limit * $pageNo;
            $this->data['members'] = $this->objStaffModel->get_staffs($pid, $limit, $offset);
            $this->data['count'] = $this->objStaffModel->get_staffs_count($pid);
            $this->data['pageNo'] = $pageNo;

            $this->load->view('pre/member', $this->data);
        }
    }

    private function form()
    {
        # code...
    }
}