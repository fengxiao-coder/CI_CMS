<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//应用名称
$config['app_name'] = 'xx系统';
//每页显示条数
$config['per_page'] = '20';
//当前主题
$config['theme'] = 'default';

//网站后台目录


// if(!$config['site_path']){
// 	$ci=& get_instance();


// 	$data=$ci->config_model->get_by_attributes(array('key'=>'site_path'));
// 	if($data){
// 		$config['site_path']=$data[0];
// 	} else {
// 		$config['site_path']="sz.admin";
// 	}
// }

// if(!$config['site_path']){
// 	$config['site_path']="sz.admin";
// }