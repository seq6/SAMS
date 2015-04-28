<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目其他信息
*/

class Other extends CI_Controller
{
    private $data;

    private $objPjfileModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '委托书';
        $this->data['tag']['content'] = '被评估单位需向评估单位出具《委托书》，《委托书》证明评估单位人员在被评估单位的现场进行工作的合法性';

        $this->load->model('pjfile_model');
        $this->objPjfileModel = new pjFile_model;
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

        $this->data['pjfiles'] = $this->objPjfileModel->get_pjfiles($pid, $limit, $offset);
        foreach ($this->data['pjfiles'] as $key => $val) {
            $this->data['pjfiles'][$key]['path'] = '/data/'.$pid.'/'.$val['id'].'_'.$val['name'].'.'.$val['fileType'];
            $this->data['pjfiles'][$key]['rename'] = $val['name'].'.'.$val['fileType'];
        }

        $this->data['pid'] = $pid;
        $this->data['count'] = $this->objPjfileModel->get_pjfile_count($pid);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('pre/other', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['fid']) ? $_GET['fid'] : 0;
        $res = $this->objPjfileModel->get_pjfile($id);
        echo json_encode($res);
    }

    private function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType'])   ? $_POST['editType']  : '';
        $id       = isset($_POST['fid'])        ? $_POST['fid']       : 0;
        $name     = isset($_POST['fname'])      ? $_POST['fname']     : '';
        $members  = isset($_POST['fmember'])    ? $_POST['fmember']   : '';
        $place    = isset($_POST['fplace'])     ? $_POST['fplace']    : '';
        $starttime= isset($_POST['fstarttime']) ? $_POST['fstarttime']: '';
        $endtime  = isset($_POST['fendtime'])   ? $_POST['fendtime']  : '';
        $file     = isset($_FILES['upload-file']) ? $_FILES['upload-file'] : '';

        //var_dump($_POST);

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objPjfileModel->add_pjfile($pid, $name, $members, $place, $starttime, $endtime, $file);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objPjfileModel->del_pjfile($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objPjfileModel->update_pjfile($id, $name, $members, $place, $starttime, $endtime, $file);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            default: {
                break;
            }
        }

        $this->data['error'] = $errorNo;
    }
}