<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     项目其他信息
*/

class Other extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '委托书';
        $this->data['tag']['content'] = '被评估单位需向评估单位出具《委托书》，《委托书》证明评估单位人员在被评估单位的现场进行工作的合法性';
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $this->load->view('pre/other', $this->data);
    }

    private function form()
    {
        # code...
    }
}