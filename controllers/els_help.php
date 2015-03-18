<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     帮助页面
*/

class Els_help extends CI_Controller {

    public function index() {
        $data = array();
        $data['tag'] = array();
        $data['tag']['title'] = '安全风险评估管理系统';
        $data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';
        $this->load->view('els_help' ,$data);
    }

}
