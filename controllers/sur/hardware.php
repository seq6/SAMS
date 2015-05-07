<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     硬件资源
*/

class Hardware extends CI_Controller
{
    private $data;

    private $objHardtypeModel;

    private $objHardwareModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '硬件资源';
        $this->data['tag']['content'] = '信息系统运行所依赖的基本设备，如：个人电脑、服务器、交换机、路由器等';

        $this->load->model('hardtype_model');
        $this->objHardtypeModel = new Hardtype_model;

        $this->load->model('hardware_model');
        $this->objHardwareModel = new Hardware_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $pid = $_SESSION['project']['pid'];
        $hardtype = isset($_GET['ht']) ? $_GET['ht'] : 0;
        $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
        $limit = 10;
        $offset = ($pageNo - 1) * $limit;
        $this->data['hardware'] = $this->objHardwareModel->get_hardwares($pid, $limit, $offset, $hardtype);

        $this->data['hardtype'] = $this->objHardtypeModel->get_hardtype();
        $this->data['ht'] = $hardtype;
        $this->data['count'] = $this->objHardwareModel->get_hardwares_count($pid, $hardtype);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('sur/hardware', $this->data);
    }


    public function get()
    {
        $id = isset($_GET['personid']) ? $_GET['personid'] : 0;
        $res = $this->objHardwareModel->get_hardware($id);
        echo json_encode($res);
    }

    private function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['hardid'])   ? $_POST['hardid']   : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $kid      = isset($_POST['hardtype']) ? $_POST['hardtype'] : 1;
        $model    = isset($_POST['model'])    ? $_POST['model']    : '';
        $place    = isset($_POST['place'])    ? $_POST['place']    : '';
        $net      = isset($_POST['net'])      ? $_POST['net']      : '';
        $ip       = isset($_POST['ip'])       ? $_POST['ip']       : '';
        $mask     = isset($_POST['mask'])     ? $_POST['mask']     : '';
        $geteway  = isset($_POST['geteway'])  ? $_POST['geteway']  : '';
        $os       = isset($_POST['os'])       ? $_POST['os']       : 1;
        $osSoft   = isset($_POST['osSoft'])   ? $_POST['osSoft']   : '';
        $portType = isset($_POST['portType']) ? $_POST['portType'] : '';
        $portNum  = isset($_POST['portNum'])  ? $_POST['portNum']  : '';
        $main     = isset($_POST['main'])     ? $_POST['main']     : '';
        $datas    = isset($_POST['datas'])    ? $_POST['datas']    : '';
        $ha       = isset($_POST['ha'])       ? $_POST['ha']       : '';
        $Cgrade   = isset($_POST['Cgrade'])   ? $_POST['Cgrade']   : 1;
        $Igrade   = isset($_POST['Igrade'])   ? $_POST['Igrade']   : 1;
        $Agrade   = isset($_POST['Agrade'])   ? $_POST['Agrade']   : 1;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objHardwareModel->add_hardware($pid, $assetid, $kid, $name, $model, $place, $net, $ip, $mask, $geteway, $os, $osSoft, $portType, $portNum, $main, $datas, $ha, $Cgrade, $Igrade, $Agrade);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objHardwareModel->del_hardware($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objHardwareModel->update_hardware($id, $pid, $assetid, $kid, $name, $model, $place, $net, $ip, $mask, $geteway, $os, $osSoft, $portType, $portNum, $main, $datas, $ha, $Cgrade, $Igrade, $Agrade);
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