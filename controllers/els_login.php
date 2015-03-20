<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     登陆页面
*/

class Els_login extends CI_Controller {

    public function index() {

        $ID = isset($_POST['ID']) ? $_POST['ID'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $pwd = isset($_POST['password']) ? $_POST['password'] : '';

        $this->load->model('user');
        $objUser = new user;

        if ($ID === 'admin') {
            $adminData = $objUser->check('', $pwd, TRUE);
            if ($adminData === FALSE) {
                $data = array('pwdError' => 1);
                $this->load->view('els_login', $data);
            }
            else {
                /* set session */

                $data = array();
                $data['tag'] = array();
                $data['tag']['title'] = '安全风险评估管理系统';
                $data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';
                $this->load->view('els_help', $data);
            }
        }
        elseif ($ID === 'user') {
            $userData = $objUser->check($email, $pwd, FALSE);
            if ($userData === FALSE) {
                $data = array('pwdError' => 1);
                $this->load->view('els_login', $data);
            }
            else {
                /* set session */

                $data = array();
                $data['tag'] = array();
                $data['tag']['title'] = '安全风险评估管理系统';
                $data['tag']['content'] = '可以大大提高工作效率，节省工作成本，对风险评估工作具有重要的支撑意义';
                $this->load->view('els_help', $data);
            }
        }
    }
}
