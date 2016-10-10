<?php 
class Site extends MY_Controller {
	const TIMEOUT = 4;
	public $layout="layouts/main_base";

	public function __construct(){
		parent::__construct();
		$this->load->library('auth');
	}


	/**
	 * 初始化消息框
	 * @param array $content 配置数据
	 */
	public function message_box( $config ) {
		if ( $config['redirect_url'] ) $config['content'] .= ' <strong>' . self::TIMEOUT . '</strong>秒后将自动跳转';
		if ( substr( $config['content'], 0, 3 ) !== '<p>' ) $config['content'] = '<p>' . $config['content'] . '</p>';
		$this->load->view_part( 'sz_admin/site/messagebox', $config );
	}

	/**
	 * 错误页面
	 */
	public function error(){
		
                //$this->load->view("admin/site/error");
                $this->load->view('sz_admin/site/error');
	}
        
        /**
	 * 错误页面
	 */
	public function help(){
		
            $this->load->view("admin/site/help");
	}
        
}
