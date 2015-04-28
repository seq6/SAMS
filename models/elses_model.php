<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     elses表
*/

class Elses_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'elses';
    }
}