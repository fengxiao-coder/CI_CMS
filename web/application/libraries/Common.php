<?php

/**
 * 通用类库
 * @author 咸洪伟
 * @version 0.0
 * @package njsystem
 * @subpackage application/libraries
 */
class Common
{

	private $_CI;
	function __construct() {
		$this->_CI = & get_instance();             
	}

	/**
	 * 回收站工具条
	 * @param string $model 模型名称
	 * @param unknown_type $pid
	 */
	public function get_recycled( $model, $recycled, $action = "index" ) {
		$data = array(
			'model' => $model,
			'recycled' => $recycled,
			'action' => $action,
		);
		$str = $this->_CI->load->view_part( $this->_site_path.'/main/recycled', $data );
	}

	/**
	 * 回收站 时的列表操作按钮
	 * @param string $model 模型名称
	 * @param unknown_type $pid
	 */
	public function get_recycled_button( $model, $recycled, $id ) {
		$data = array(
			'model' => $model,
			'recycled' => $recycled,
			'id' => $id,
		);
		$str = $this->_CI->load->view_part( $this->_site_path.'/main/recycled_button', $data );
	}

	/*
	 * 获取用户当前菜单栏名字
	 */
	public function get_menu_name($model){
	    $this->_CI->load->model("operations_type_model");
	    $search['attributes']['url_like'] = $model;
	    $data = $this->_CI->operations_type_model->get_values("type_name",'url',$search);
	    foreach($data as  $key =>$val){
	        $check_model_arr = explode('/', $val);
	        array_shift($check_model_arr);
	        if($check_model_arr[0] == $model){
	            $ret['type_name'] = $key;
	            $ret['url'] = $val;
	            return $ret;
	        }
	    }
	    return FALSE;
	}
     
    public function get_client_ip() {
    	
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown")){
            $ip = getenv("HTTP_CLIENT_IP");
        } else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown")){
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        } else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown")){
            $ip = getenv("REMOTE_ADDR");
        } else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown")){ 
            $ip = $_SERVER['REMOTE_ADDR'];
        } else {
            $ip = "unknown";
        }
        if(!preg_match('/[\d\.]{7,15}/', $ip)){
        	return 'unknown';
        }
        return($ip);
    }
    
    /*
     * @ 判断是不是手机端
     * @ param  array()
     * return array（0=>1表示成功 0 失败  ，1=>异常错误信息）
     */
    function is_mobile(){
        $regex_match="/(nokia|iphone|android|motorola|^mot\-|softbank|foma|docomo|kddi|up\.browser|up\.link|";
        $regex_match.="htc|dopod|blazer|netfront|helio|hosin|huawei|novarra|CoolPad|webos|techfaith|palmsource|";
        $regex_match.="blackberry|alcatel|amoi|ktouch|nexian|samsung|^sam\-|s[cg]h|^lge|ericsson|philips|sagem|wellcom|bunjalloo|maui|";  
        $regex_match.="symbian|smartphone|midp|wap|phone|windows ce|iemobile|^spice|^bird|^zte\-|longcos|pantech|gionee|^sie\-|portalmmm|";
        $regex_match.="jig\s browser|hiptop|^ucweb|^benq|haier|^lct|opera\s*mobi|opera\*mini|320x320|240x320|176x220";
        $regex_match.=")/i";  

        return isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']) or preg_match($regex_match, strtolower($_SERVER['HTTP_USER_AGENT']));
    }
    
    /*
     * 生成二维码
     */
   public function  set_core($goods_id){
       include 'phpqrcode/phpqrcode.php'; 
	   $value = base_url("sz_front/index/detail/".$goods_id); //二维码内容
       //$value = base_url("sz_front/search/details/".$goods_id); //二维码内容
       //$value = "http://200.200.200.30/demo_cms/sz_front/search/details/".$goods_id; //二维码内容
      
       $errorCorrectionLevel = 'L';//容错级别  
       $matrixPointSize = 2;//生成图片大小  
       $img = $goods_id.'.png';
       QRcode::png($value,$img , $errorCorrectionLevel, $matrixPointSize, 2); 
       rename($img, "uploads/goods_core/".$img);
       return $img;
   }    
   
   /*
     * 店铺二维码
   */
   public function  set_storecore($store_id){
       include 'phpqrcode/phpqrcode.php'; 
	   $value = base_url("sz_admin/store/view/".$store_id); //二维码内容
       $errorCorrectionLevel = 'L';//容错级别  
       $matrixPointSize = 2;//生成图片大小  
       $img = $store_id.'.png';
       QRcode::png($value,$img , $errorCorrectionLevel, $matrixPointSize, 2); 
       rename($img, "uploads/store_core/".$img);
       return $img;
   }    
   
		/*
        * 当前标签位置
        */
       public function show_title_breadcrumb($control,$button=array()){
           $data = array();
           $data['control'] = $control;
           $data['button'] = $button;

           $this->_CI->load->view_part("sz_admin/main/breadcrumb",$data);
       }
}
