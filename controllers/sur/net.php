<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     网络环境
*/

class Net extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '网络系统';
        $this->data['tag']['content'] = '信息系统运行所依赖的网络系统';
    }

    public function index()
    {
        $this->load->view('sur/net', $this->data);
    }

}