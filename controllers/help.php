<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     帮助页面
*/

class Help extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '安全风险评估管理系统';
        $this->data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';
    }

    public function index()
    {
        $this->load->view('help' ,$this->data);
    }

}
