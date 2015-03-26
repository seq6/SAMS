<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     user表
*/

class User_model extends Base_model
{
    function __construct()
    {
        $this->table = 'user';
    }

    public function check($email = '', $pwd = '', $isAdmin = FALSE)
    {
        if ($pwd === '') {
            return FALSE;
        }
        else {
            if ($isAdmin) {
                $theAdmin = $this->get_item(array('`isadmin`' => 1), 0, 0, TRUE);
                $md5Pwd = md5($pwd);
                foreach ($theAdmin as $key => $value) {
                    if ($md5Pwd === $value['pwd']) {
                        return $value;
                    }
                }
            }
            else {
                $theUser = $this->get_item(array('`email`' => $email), 0, 0, TRUE);
                $md5Pwd = md5($pwd);
                foreach ($theUser as $key => $value) {
                    if ($md5Pwd === $value['pwd']) {
                        return $value;
                    }
                }
            }
            return FALSE;
        }
    }

    public function add($name = '', $email = '', $pwd = '', $pid = '')
    {
        if ($name == '' || $email == '' || $pwd == '') {
            return FALSE;
        }
        else {
            $user = array('`name`' => $name, '`email`' => $email, '`pwd`' => $pwd, '`auth`' => '{"'.$pid.'"}');
            return $this->add_item($user);
        }
    }

    public function add_user_pid($uid = 0, $pid = 0)
    {
        if (($uid <= 0 || is_int($uid)) || ($pid <= 0 || is_int($pid))) {
            return FALSE;
        }
        else {
            $userData = $this->get_item(array('`id`' => $uid));
            $arrTmp = json_decode($userData['auth']);
            array_push($arrTmp, $pid);
            $userData['auth'] = $arrTmp;
            return $this->update_item(array('`id`' => $uid), $userData);
        }
    }

    public function get_all_admin()
    {
        return $this->get_item(array('`isadmin`' => 1), 0, 0, TRUE);
    }

    public function get_all_user()
    {
        return $this->get_item(array('`isadmin`' => 0), 0, 0, FALSE);
    }
}

?>