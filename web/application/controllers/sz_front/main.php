<?php

/**
 * @author 刘军 
 * @version 1.0
 * @package application
 */
class main extends Front_Controller
{
	public function __construct() {
		parent::__construct();
                $this->_site_path ="sz_front";
	}

	//获取导航栏
	public function get_nav($pid) {

		if(isset($pid) && is_numeric($pid)){
			$data = array();
			$this->load->model('news_sort_model');
			$data['pid'] = intval($pid);
			$search = array(
				'attributes' => array('parentid' => $data['pid']),
				'orders' => array('depth' => 'asc', 'created'=>'desc'),
			);
			$data['nav_data'] = $this->news_sort_model->get_values('id', 'sortname', null, $search);

			$this->load->view_part($this->_site_path.'/common/nav', $data);
		}
	}
	
	//获取友情链接
	public function get_links(){
		
		$this->load->model('link_model');
		$fields = array('link_title', 'link_url', '	link_pic ');
		$search = array();
		$search['orders'] = array('link_sort' => 'asc');
		//显示5个
		$search['limit'] = array('persize' => 5, 'offset' => 0);
		$data['links'] = $this->link_model->get_appoint_values($fields, null, $search);
		$this->load->view_part($this->_site_path.'/common/links', $data);
 	}
 	
 	//文件下载
 	public function download(){
 		
 		//统一文件分界符
 		$url = strtr(rawurldecode($_GET['url']), '\\', '/');
 		$documentRoot = strtr($_SERVER['DOCUMENT_ROOT'], '\\', '/');
 		$space = substr($url, 0, 1)!='/' && substr($documentRoot, -1)!='/' ? '/' : '';
 		$file_name = strtr($_SERVER['DOCUMENT_ROOT'], '\\', '/') . $space . rawurldecode($_GET['url']);
 		//设置编码
 		header('content-type:text/html;charset=utf-8');
 		//禁用缓存
 		header("Expires:-1");
 		header("Cache-control:no_cache");
 		header("Pragma:no_cache");
 		//对于中文命名的文件，需要对其进行转成gb2312编码，由于这个函数比较古老，不认utf-8编码
 		$file_name=iconv('utf-8', 'gb2312', $file_name);
 		if(!is_file($file_name)){
 			echo file_exists($file_name) ? "该地址不是一个文件！" : "该文件不存在！";
 			exit;
 		}
 		//获取下载文件的大小
 		$file_size=filesize($file_name);
 		//打开文件
 		if(!$fp=fopen($file_name, 'r')) exit('文件打开失败！');
 		//告诉浏览器返回的是文件
 		header('Content-type:application/octet-stream');
 		//按照字节大小返回，单位字节
 		header('Accept-Ranges:bytes');
 		//返回文件大小，让浏览器知道读取的文件为多大
 		header('Accept-Length:' . $file_size);
 		//这里对应客户端弹出框的文件名
 		header('Content-Disposition:attachement;filename=' . $file_name);
 		//向客户端回送数据
 		//循环读取文件，减少服务器压力
 		//定义每次读取的文件大小，单位字节
 		$buffer = 1024;
 		//为了下载的安全，我们做一个文件字节读取字节数
 		$file_count = 0;
 		while(!feof($fp) && ($file_size-$file_count)>0){
 			$file_data = fread($fp, $buffer);
 			//统计读了多少个字节
 			$file_count += $buffer;
 			//把读取的部分数据回送给浏览器
 			echo $file_data;
 		}
 		//关闭文件
 		fclose($fp);
 	}
	
}
