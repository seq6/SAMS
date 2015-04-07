<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Information extends CI_Controller
{
    private $data;

    private $objPjtypeModel;

    private $objPjrangeModel;

    function __construct()
    {
        parent::__construct();

        $this->load->model('pjtype_model');
        $this->objPjtypeModel = new PjType_model;

        $this->load->model('pjrange_model');
        $this->objPjrangeModel = new PjRange_model;

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '评估类型';
        $this->data['tag']['content'] = '项目启动时必须定义项目的类型，评估工作将依据项目类型进行，不同类型的项目工作内容也不相同';

    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }
        else {
            $this->load->view('pre/information', $this->data);
        }
    }

    private function form()
    {

    }

}