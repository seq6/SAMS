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
        $this->data['count'] = $this->objSoftwareModel->get_softwares_count($pid, $softtype);
        $this->data['pageNo'] = $pageNo;


        $this->load->view('sur/software', $this->data);
    }

    public function get()
    {

    }

    private function form()
    {
        
    }
}