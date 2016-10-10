<?php
class Check_Ip {

    public $Block_ip = array();

    function __construct() {
        $this->_CI = & get_instance();
        $this->_CI->load->model('check_ip_model');
        $this->Block_ip = $this->_CI->check_ip_model->get_values("id", "check_ip", array("status" => 1));
    }

    private function makePregIP($str) {
        $preg_limit = $preg = "";
        if (strstr($str, "-")) {
            $aIP = explode(".", $str);
            foreach ($aIP as $k => $v) {
                if (!strstr($v, "-")) {
                    $preg_limit .= $this->makePregIP($v);
                } else {
                    $aipNum = explode("-", $v);
                    for ($i = $aipNum[0]; $i <= $aipNum[1]; $i++) {
                        $preg .=$preg ? "|" . $i : "[" . $i;
                    }
                    $preg_limit .=strrpos($preg_limit, ".", 1) == (strlen($preg_limit) - 1) ? $preg . "]" : "." . $preg . "]";
                }
            }
        } else {
            $preg_limit .= $str . ".";
        }
        return $preg_limit;
    }

    private function getAllBlockIP() {
        if ($this->Block_ip) {
            foreach ($this->Block_ip as $k => $v) {
                $ipaddres = $this->makePregIP($v);
                if (substr($ipaddres, -1) == ".") {
                    $ipaddres = substr($ipaddres, 0, -1);
                }
                $ip = str_ireplace(".", "\.", $ipaddres);
                $ip = str_replace("*", "[0-9]{1,3}", $ip);
                $ipaddres = "/" . $ip . "/";
                $ip_list[] = $ipaddres;
            }
        }
        return $ip_list;
    }

    public function checkIP() {
        $iptable = $this->getAllBlockIP();
        $IsJoined = false;
		//取得用户ip
        $Ip = $this->common->get_client_ip();
        $Ip = trim($Ip);
		//剔除黑名单中的IP区段
        if ($iptable) {
            foreach ($iptable as $value) {
                if (preg_match("{$value}", $Ip)) {
                    $IsJoined = true;
                    break;
                }
            }
        }
		//如果在ip黑名单中就执行如下操作
        if ($IsJoined) {
            return 1;
        }
        return 0;
    }

/*     public function get_client_ip() {
    	
        if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            $ip = getenv("HTTP_CLIENT_IP");
        else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            $ip = getenv("HTTP_X_FORWARDED_FOR");
        else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            $ip = getenv("REMOTE_ADDR");
        else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
            $ip = $_SERVER['REMOTE_ADDR'];
        else
            $ip = "unknown";
        if(!preg_match('/[\d\.]{7,15}/', $ip)){
        	return 'unknown';
        }
        return($ip);
    } */
}