<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
* @author   zhangji
* @desc     document表
*/

class Document_model extends Base_model
{
    function __construct()
    {
        parent::__construct();

        $this->table = 'document';
    }
}