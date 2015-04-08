<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Person extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '人员资源';
        $this->data['tag']['content'] = '掌握重要信息和核心业务的人员，如主机维护主管、网络维护主管及应用项目经理等';
    }

    public function index()
    {
        $this->load->view('sur/person', $this->data);
    }

}