<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     ###########
*/

class Welcome extends CI_Controller {

    public function index()
    {
        $uid = $this->session->userdata('uid');
        if ($uid === FALSE) {
            $this->load->view('els_login');
        }
        else {
            $this->load->view('els_help');
        }
    }
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
