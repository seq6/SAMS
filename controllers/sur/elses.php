<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     其他资产
*/

class Elses extends CI_Controller
{
    private $data;

    function __construct()
    {
        parent::__construct();

        $this->data = array();
        $this->data['tag'] = array();
        $this->data['tag']['title'] = '其他资产';
        $this->data['tag']['content'] = '企业形象、客户关系等';
    }

    public function index()
    {
        $this->load->view('sur/elses', $this->data);
    }

}