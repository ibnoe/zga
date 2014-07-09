<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/general/hooks.html
|
*/


$hook['post_controller'] = array(
							"class" => "",//"acl",
                            "function" => "check",
							"filename" => "aclfunc.php",//"acl.php",
                            "filepath" => "hooks",
                            "params" => array(),
                            );
/*
$hook['post_system'] = array(
							"class" => "",//"acl",
                            "function" => "checkpost",
							"filename" => "aclfunc.php",//"acl.php",
                            "filepath" => "hooks",
                            "params" => array(),
                            );
*/							
$hook['display_override'] = array(
							"class" => "",//"acl",
                            "function" => "disp",
							"filename" => "aclfunc.php",//"acl.php",
                            "filepath" => "hooks",
                            "params" => array(),
                            );							


/* End of file hooks.php */
/* Location: ./system/application/config/hooks.php */