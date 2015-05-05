<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     服务资产
*/

class Sever extends CI_Controller
{
    private $data;

    private $objSeverTypeModel;

    private $objSeverModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '服务资产';
        $this->data['tag']['content'] = '信息服务：对外依赖该系统开展的各类服务<br/>网络服务：各种网络设备、设施提供的网络连接服务<br/>办公服务：为提高效率而开发的管理信息系统，包括各种内部配置管理、文件流转管理等服务';

        $this->load->model('servetype_model');
        $this->objSeverTypeModel = new Servetype_model;

        $this->load->model('serve_model');
        $this->objSeverModel = new Serve_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $pid = $_SESSION['project']['pid'];
        $severtype = isset($_GET['st']) ? $_GET['st'] : 0;
        $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
        $limit = 10;
        $offset = ($pageNo - 1) * $limit;
        $this->data['sever'] = $this->objSeverModel->get_severs($pid, $limit, $offset, $severtype);

        $this->data['severtype'] = $this->objSeverTypeModel->get_servetype();
        $this->data['st'] = $severtype;
        $this->data['count'] = $this->objSeverModel->get_severs_count($pid, $severtype);
        $this->data['pageNo'] = $pageNo;

        $tmp = array();
        foreach ($this->data['severtype'] as $s) {
            $tmp[$s['id']] = $s['name'];
        }
        foreach ($this->data['sever'] as $key => $s) {
            $this->data['sever'][$key]['severtype'] = $tmp[$s['kid']];
            switch ($s['way']) {
                case '1':
                    $this->data['sever'][$key]['way'] = '现场';
                    break;
                case '2':
                    $this->data['sever'][$key]['way'] = '非现场';
                    break;
                default:
                    $this->data['sever'][$key]['way'] = 'error';
                    break;
            }
        }

        $this->load->view('sur/sever', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['severid']) ? $_GET['severid'] : 0;
        $res = $this->objSeverModel->get_sever($id);
        $stype = $this->objSeverTypeModel->get_servetype();
        foreach ($stype as $s) {
            if ($s['id'] == $res['kid']) {
                $res['severtype'] = $s['name'];
            }
        }
        $res['way'] = ($res['way'] == 1) ? '现场' : '非现场';
        echo json_encode($res);
    }

    private function form()
    {

        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['severid'])  ? $_POST['severid']  : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $severtype= isset($_POST['severtype'])? $_POST['severtype']: '';
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $unit     = isset($_POST['unit'])     ? $_POST['unit']     : '';
        $content  = isset($_POST['content'])  ? $_POST['content']  : '';
        $way      = isset($_POST['way'])      ? $_POST['way']      : 1;
        $device   = isset($_POST['device'])   ? $_POST['device']   : '';
        $remarks  = isset($_POST['remarks'])  ? $_POST['remarks']  : '';
        $import   = isset($_POST['import'])   ? $_POST['import']   : 1;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objSeverModel->add_sever($pid, $assetid, $severtype, $name, $unit, $content, $way, $device, $remarks, $import);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objSeverModel->del_sever($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objSeverModel->update_sever($id, $pid, $assetid, $severtype, $name, $unit, $content, $way, $device, $remarks, $import);
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