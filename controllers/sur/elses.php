<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     其他资产
*/

class Elses extends CI_Controller
{
    private $data;

    private $objElsesModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '其他资产';
        $this->data['tag']['content'] = '企业形象、客户关系等';

        $this->load->model('elses_model');
        $this->objElsesModel = new Elses_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        //分页
        $pid = $_SESSION['project']['pid'];
        $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
        $limit = 10;
        $offset = ($pageNo - 1) * $limit;
        $this->data['elses'] = $this->objElsesModel->get_elses($pid, $limit, $offset);

        $this->data['count'] = $this->objElsesModel->get_elses_count($pid);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('sur/elses', $this->data);
    }

    public function get()
    {
        //获取单个资产详细信息
        $id = isset($_GET['elseid']) ? $_GET['elseid'] : 0;
        $res = $this->objElsesModel->get_else($id);
        echo json_encode($res);
    }

    public function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['elseid'])   ? $_POST['elseid']   : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $theDesc  = isset($_POST['theDesc'])  ? $_POST['theDesc']  : '';
        $lib      = isset($_POST['lib'])      ? $_POST['lib']      : '';
        $import   = isset($_POST['import'])   ? $_POST['import']   : 1;

        $errorNo = 0;
        switch ($editType) {
            //添加新资产
            case 'add': {
                $res = $this->objElsesModel->add_else($pid, $assetid, $name, $theDesc, $lib, $import);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            //删除资产
            case 'del': {
                $res = $this->objElsesModel->del_else($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            //编辑资产
            case 'edit': {
                $res = $this->objElsesModel->update_else($id, $pid, $assetid, $name, $theDesc, $lib, $import);
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