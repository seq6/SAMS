<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     服务资产
*/

class Sever extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '服务资产';
        $this->data['tag']['content'] = '信息服务：对外依赖该系统开展的各类服务<br/>网络服务：各种网络设备、设施提供的网络连接服务<br/>办公服务：为提高效率而开发的管理信息系统，包括各种内部配置管理、文件流转管理等服务';
    }

    public function index()
    {
        if (!empty($_POST)) {
            $this->form();
        }

        $this->load->view('sur/sever', $this->data);
    }

    public function form()
    {
        # code...
    }
}