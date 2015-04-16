<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目人员
*/

class Member extends CI_Controller
{
    private $data;

    private $objStaffModel;

    private $objPositionModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '项目人员';
        $this->data['tag']['content'] = '评估双方参与项目的人员情况，便于项目中进行联络和沟通';

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
        $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
        $limit = 10;
        $offset = ($pageNo - 1) * $limit;
        $this->data['members'] = $this->objStaffModel->get_staffs($pid, $limit, $offset);
        $this->data['position'] = $this->objPositionModel->get_position();

        //将职位id转换为职位名称
        $position = array();
        foreach ($this->data['position'] as $p) {
            $position[$p['id']] = $p['name'];
        }
        foreach ($this->data['members'] as $key => $m) {
            $posid = $m['posid'];
            $this->data['members'][$key]['position'] = isset($position[$posid]) ? $position[$posid] : 'null';
        }

        $this->data['count'] = $this->objStaffModel->get_staffs_count($pid);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('pre/member', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['memberid']) ? $_GET['memberid'] : 0;
        $res = $this->objStaffModel->get_staff($id);
        echo json_encode($res);
    }

    private function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['memberid']) ? $_POST['memberid'] : 0;
        $partid   = isset($_POST['partid'])   ? $_POST['partid']   : '';
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $sex      = isset($_POST['sex'])      ? $_POST['sex']      : '';
        $phone    = isset($_POST['phone'])    ? $_POST['phone']    : '';
        $mobile   = isset($_POST['mobile'])   ? $_POST['mobile']   : '';
        $email    = isset($_POST['email'])    ? $_POST['email']    : '';
        $posid    = isset($_POST['posid'])    ? $_POST['posid']    : 0;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objStaffModel->add_staff($pid, $partid, $name, $sex, $phone, $mobile, $email, $posid);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objStaffModel->del_staff($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objStaffModel->update_staff($id, $pid, $partid, $name, $sex, $phone, $mobile, $email, $posid);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            default: 
                break;
        }

        $this->data['error'] = $errorNo;
    }
}