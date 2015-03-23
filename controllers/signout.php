<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     注销
*/

class Signout extends CI_Controller {

    public function index() {
        /* unset session */
        $this->unset_session('said');
        $this->unset_session('email');
        $this->unset_session('pid');
        $this->unset_session('pre');
        $this->unset_session('sur');

        $this->load->view('login');
    }

    private function unset_session($name = NULL) {
        if ($name !== NULL && isset($_SESSION[$name])) {
            unset($_SESSION[$name]);
        }
    }
}
