<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     数据文档
*/

class Document extends CI_Controller
{
    private $data;

    private $objDomModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '数据文档';
        $this->data['tag']['content'] = '保存在信息媒介上的各种数据资料，包括源代码、数据库数据、系统文档、运行管理规程、计划、报告、用户手册、各类纸质的文档等';

        $this->load->model('document_model');
        $this->objDomModel = new Document_model;
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
        $this->data['document'] = $this->objDomModel->get_doms($pid, $limit, $offset);

        $this->data['count'] = $this->objDomModel->get_doms_count($pid);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('sur/document', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['domid']) ? $_GET['domid'] : 0;
        $res = $this->objDomModel->get_dom($id);
        echo json_encode($res);
    }

    public function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['domid'])    ? $_POST['domid']    : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $dType    = isset($_POST['dType'])    ? $_POST['dType']    : '';
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $theDesc  = isset($_POST['theDesc'])  ? $_POST['theDesc']  : '';
        $import   = isset($_POST['import'])   ? $_POST['import']   : 1;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objDomModel->add_dom($pid, $assetid, $dType, $name, $theDesc, $import);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objDomModel->del_dom($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objDomModel->update_dom($id, $pid, $assetid, $dType, $name, $theDesc, $import);
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