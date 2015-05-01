<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     软件资源
*/

class Software extends CI_Controller
{
    private $data;

    private $objSofttypeModel;

    private $objSoftwareModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '软件资源';
        $this->data['tag']['content'] = '信息系统运行所依赖的基本软件，如：个人操作系统、服务办公软件、业务软件等';

        $this->load->model('software_model');
        $this->objSoftwareModel = new Software_model;

        $this->load->model('softtype_model');
        $this->objSofttypeModel = new Softtype_model;
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $pid = $_SESSION['project']['pid'];
        $softtype = isset($_GET['st']) ? $_GET['st'] : 0;
        $pageNo = isset($_GET['pageNo']) ? $_GET['pageNo'] : 1;
        $limit = 10;
        $offset = ($pageNo - 1) * $limit;
        $this->data['software'] = $this->objSoftwareModel->get_softwares($pid, $limit, $offset, $softtype);

        $this->data['softtype'] = $this->objSofttypeModel->get_softtype();
        $this->data['st'] = $softtype;
        $this->data['count'] = $this->objSoftwareModel->get_softwares_count($pid, $softtype);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('sur/software', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['personid']) ? $_GET['personid'] : 0;
        $res = $this->objPersonModel->get_person($id);
        echo json_encode($res);
    }

    private function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['softid'])   ? $_POST['softid']   : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $kid      = isset($_POST['softtype']) ? $_POST['softtype'] : 1;
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $version  = isset($_POST['version'])  ? $_POST['version']  : '';
        $developer= isset($_POST['developer'])? $_POST['developer']: '';
        $hard     = isset($_POST['hard'])     ? $_POST['hard']     : '';
        $soft     = isset($_POST['soft'])     ? $_POST['soft']     : '';
        $app      = isset($_POST['app'])      ? $_POST['app']      : '';
        $model    = isset($_POST['model'])    ? $_POST['model']    : 1;
        $datas    = isset($_POST['datas'])    ? $_POST['datas']    : '';
        $userNum  = isset($_POST['userNum'])  ? $_POST['userNum']  : '';
        $userRole = isset($_POST['userRole']) ? $_POST['userRole'] : '';
        $Cgrade   = isset($_POST['Cgrade'])   ? $_POST['Cgrade']   : 1;
        $Igrade   = isset($_POST['Igrade'])   ? $_POST['Igrade']   : 1;
        $Agrade   = isset($_POST['Agrade'])   ? $_POST['Agrade']   : 1;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objSoftwareModel->add_software($pid, $assetid, $kid, $name, $version, $developer, $hard, $soft, $app, $model, $datas, $userNum, $userRole, $Cgrade, $Igrade, $Agrade)
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objSoftwareModel->del_software($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objSoftwareModel->update_software($id, $pid, $assetid, $kid, $name, $version, $developer, $hard, $soft, $app, $model, $datas, $userNum, $userRole, $Cgrade, $Igrade, $Agrade);
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