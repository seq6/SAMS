<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     人员资源
*/

class Person extends CI_Controller
{
    private $data;

    private $objPersonModel;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '人员资源';
        $this->data['tag']['content'] = '掌握重要信息和核心业务的人员，如主机维护主管、网络维护主管及应用项目经理等';

        $this->load->model('person_model');
        $this->objPersonModel = new Person_model;
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
        $this->data['person'] = $this->objPersonModel->get_persons($pid, $limit, $offset);

        foreach ($this->data['person'] as $key => $value) {
            if ($value['sex'] == '1') {
                $this->data['person'][$key]['sex'] = '男';
            }
            else {
                $this->data['person'][$key]['sex'] = '女';
            }
        }

        $this->data['count'] = $this->objPersonModel->get_persons_count($pid);
        $this->data['pageNo'] = $pageNo;

        $this->load->view('sur/person', $this->data);
    }

    public function get()
    {
        $id = isset($_GET['personid']) ? $_GET['personid'] : 0;
        $res = $this->objPersonModel->get_person($id);
        echo json_encode($res);
    }

    public function form()
    {
        $pid = $_SESSION['project']['pid'];
        $editType = isset($_POST['editType']) ? $_POST['editType'] : '';
        $id       = isset($_POST['personid']) ? $_POST['personid'] : 0;
        $assetid  = isset($_POST['assetid'])  ? $_POST['assetid']  : '';
        $name     = isset($_POST['name'])     ? $_POST['name']     : '';
        $sex      = isset($_POST['sex'])      ? $_POST['sex']      : 1;
        $post     = isset($_POST['post'])     ? $_POST['post']     : '';
        $depart   = isset($_POST['depart'])   ? $_POST['depart']   : '';
        $phone    = isset($_POST['phone'])    ? $_POST['phone']    : '';
        $mobile   = isset($_POST['mobile'])   ? $_POST['mobile']   : '';
        $email    = isset($_POST['email'])    ? $_POST['email']    : '';
        $import   = isset($_POST['import'])   ? $_POST['import']   : 1;

        $errorNo = 0;
        switch ($editType) {
            case 'add': {
                $res = $this->objPersonModel->add_person($pid, $assetid,$name, $sex, $post, $depart, $phone, $mobile, $email, $import);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'del': {
                $res = $this->objPersonModel->del_person($id);
                if ($res != false) {
                    $errorNo = 1;
                }
                break;
            }
            case 'edit': {
                $res = $this->objPersonModel->update_person($id, $pid, $assetid, $name, $sex, $post, $depart, $phone, $mobile, $email, $import);
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