<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     评估双方
*/

class Parts extends CI_Controller
{
    private $data;

    private $objPartsModel;

    private $objProjectModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '评估双方';
        $this->data['tag']['content'] = '项目启动时必须填写评估方和被评估方的信息，评估双方的信息是风险评估报告中不可缺少的部分';

        $this->load->model('parts_model');
        $this->objPartsModel = new Parts_model;

        $this->load->model('project_model');
        $this->objProjectModel = new Project_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }


        $pid = $_SESSION['project']['pid'];
        $project = $this->objProjectModel->get_project($pid);

        //获取评估方数据
        $Aid = $project['partA'];
        if ($Aid != 0) {
            $this->data['partA'] = $this->objPartsModel->get_part($Aid);
        }
        //获取被评估方数据
        $Bid = $project['partB'];
        if ($Bid != 0) {
            $this->data['partB'] = $this->objPartsModel->get_part($Bid);
        }

        $this->load->view('pre/parts', $this->data);
    }

    private function form()
    {
        //获取partA（评估方）信息
        $aName    = isset($_POST['aName'])    ? $_POST['aName']    : '';
        $aAddress = isset($_POST['aAddress']) ? $_POST['aAddress'] : '';
        $aLeader  = isset($_POST['aLeader'])  ? $_POST['aLeader']  : '';
        $aPhone   = isset($_POST['aPhone'])   ? $_POST['aPhone']   : '';
        $aMobile  = isset($_POST['aMobile'])  ? $_POST['aMobile']  : '';
        $aEmail   = isset($_POST['aEmail'])   ? $_POST['aEmail']   : '';
        $aRemarks = isset($_POST['aRemarks']) ? $_POST['aRemarks'] : '';
        //获取partB（被评估方）信息
        $bName    = isset($_POST['bName'])    ? $_POST['bName']    : '';
        $bAddress = isset($_POST['bAddress']) ? $_POST['bAddress'] : '';
        $bLeader  = isset($_POST['bLeader'])  ? $_POST['bLeader']  : '';
        $bPhone   = isset($_POST['bPhone'])   ? $_POST['bPhone']   : '';
        $bMobile  = isset($_POST['bMobile'])  ? $_POST['bMobile']  : '';
        $bEmail   = isset($_POST['bEmail'])   ? $_POST['bEmail']   : '';
        $bRemarks = isset($_POST['bRemarks']) ? $_POST['bRemarks'] : '';

        //判断是添加评估双方信息或更新评估双方信息
        $pid = $_SESSION['project']['pid'];
        $project = $this->objProjectModel->get_project($pid);

        //处理partA（评估方）信息
        if ($project['partA'] == 0) {
            $partAid = $this->objPartsModel->add_part($pid, $aName, $aAddress, $aLeader, $aPhone, $aMobile, $aRemarks);
            $this->objProjectModel->update_project($pid, array('partA' => $partAid));
        }
        else {
            $this = $this->objPartsModel->update_part($project['partA'], $aName, $aAddress, $aLeader, $aPhone, $aMobile, $aRemarks);
        }

        //处理partB（被评估方）信息
        if ($project['partB'] == 0) {
            $partBid = $this->objPartsModel->add_part($pid, $bName, $bAddress, $bLeader, $bPhone, $bMobile, $bRemarks);
            $this->objProjectModel->update_project($pid, array('partB' => $partBid));
        }
        else {
            $this = $this->objPartsModel->update_part($project['partB'], $bName, $bAddress, $bLeader, $bPhone, $bMobile, $bRemarks);
        }
    }
}