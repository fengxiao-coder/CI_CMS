<?php

/**
 * 应用函数库
 * @author 梁子恩
 * @version 0.0
 * @package application
 * @subpackage application/helpers
 */

/**
 * 初始化消息框
 * @param string $content 消息内容
 * @param string $type 类型（参照bootstrap定义alert类型）
 * @param int $code 消息代码
 * @param string $redirect_url 重定向URL
 * @param string $title 标题（默认系统提示）
 * @param string $extra 额外数据
 */
function init_messagebox($content, $type = 'success', $code = 1, $redirect_url = '', $title = '系统提示', $extra = '') {
    $CI = & get_instance();
    $config = array(
        'title' => $title,
        'content' => $content,
        'type' => $type,
        'code' => $code,
        'redirect_url' => $redirect_url,
        'extra' => $extra,
    );
    $CI->hooks->_register('messagebox', array(
        'class' => 'Site',
        'function' => 'message_box',
        'filename' => 'site.php',
        'filepath' => 'controllers/sz_admin',
        'params' => $config,
    ));
}

/**
 * 获取消息框
 */
function get_messagebox() {
    // call
    $CI = & get_instance();
    $CI->hooks->_call_hook('messagebox');
}

/**
 * 引用JS
 * @param string $js JS文件
 * @return string
 */
function js($js) {
    $is_relative = ( strpos($js, 'http') === FALSE );
    if ($is_relative)
        $js = base_url($js);
    return "<script type=\"text/javascript\" src=\"{$js}\"></script>";
}

/**
 * 引用CSS
 * @param string $css CSS文件
 * @param string $theme 主题
 * @return string
 */
function css($css, $theme = '') {
    $is_relative = ( strpos($css, 'http') === FALSE );
    // CSS
    // 当前主题
    if ($is_relative) {
        $current_theme = ( $theme ) ? $theme : config_item('theme');
        $css = base_url("theme/{$current_theme}/{$css}");
    }
    return "<link rel=\"stylesheet\" type=\"text/css\" href=\"{$css}\" media=\"all\" />";
}

/**
 * 弹出提示信息
 * @param string $msg 信息
 * @param string $url 跳转地址
 */
function alert($msg = '', $url = '') {
    if ($url != '') {
        if ($msg != '') {
            echo "<script type=\"text/javascript\">alert('$msg');window.location.href='$url';</script>";
        } else {
            echo "<script type=\"text/javascript\">window.location.href='$url';</script>";
        }
    } else {
        echo "<script>alert('$msg');</script>";
    }
}

/**
 * 将unix时间戳形式转化成时间日期格式
 * @param int $timestamp unix格式时间戳需要转换的时间
 * @param string $format 需要转换成的格式 如：‘Y-m-d’;默认为'Y-m-d H:i:s';
 * @param string $str_time
 * @return
 */
function init_date($timestamp, $format = 'Y-m-d H:i:s', $str_time = null) {
    $time = $str_time ? strtotime($str_time) : time();
    $time = $timestamp ? $timestamp : $time;
    return date($format, $time);
}

/**
 * 取数组中某键的值,如果数组中没有键返回false.
 * @param array $arr 数组
 * @param string $key 键
 * @return
 */
function get_array_key($arr, $key) {
    if (array_key_exists($key, $arr)) {
        return $arr[$key];
    }
    return FALSE;
}

/**
 * Extract the file extension
 *
 * @param	string
 * @return	string
 */
function get_extension($filename) {
    $x = explode('.', $filename);
    return '.' . end($x);
}

/**
 * 	使用特定function对数组中所有元素做处理
 * 	@param	string	&$array		要处理的字符串
 * 	@param	string	$function	要执行的函数
 * 	@return boolean	$apply_to_keys_also		是否也应用到key上
 * 	@access public
 *
 */
function arrayRecursive(&$array, $function, $apply_to_keys_also = false) {
    foreach ($array as $key => $value) {
        if (is_array($value)) {
            arrayRecursive($array[$key], $function, $apply_to_keys_also);
        } else {
            $array[$key] = $function($value);
        }

        if ($apply_to_keys_also && is_string($key)) {
            $new_key = $function($key);
            if ($new_key != $key) {
                $array[$new_key] = $array[$key];
                unset($array[$key]);
            }
        }
    }
}

/**
 *
 * 	将数组转换为JSON字符串（兼容中文）
 * 	@param	array	$array		要转换的数组
 * 	@return string		转换得到的json字符串
 * 	@access public
 *
 */
function JSON($array) {
    arrayRecursive($array, 'urlencode', true);
    $json = json_encode($array);
    return urldecode($json);
}

/**
 * 获取参数字符串,形如：?doc_type=1
 * @return string
 * @author 咸洪伟
 */
function get_query($url_path = array()) {
    $CI = & get_instance();
    $attributs = $CI->input->get();
    $attributs = array_merge($attributs, $url_path);
    return ( $attributs ) ? '?' . http_build_query($attributs) : '';
}

/**
 * 获取带参数的url
 * @param string
 * @return string
 */
function query_url($url) {
    $p_url = parse_url($url);
    $arr = $p_url['query'];
    parse_str($arr, $url_path);
    $url = $p_url['path'];
    return base_url($url) . get_query($url_path);
}

/** 以下firePHP调试用，
 * 打印一个变量到控制台
 */
function fb($var) {
    $CI = & get_instance();
    $CI->firephp->fb($var);
}

/** 以下firePHP调试用，
 * 打印最后执行的sql语句到控制台
 */
function fbq() {
    $CI = & get_instance();
    $var = $CI->db->last_query();
    $CI->firephp->fb($var);
}

//调试函数，格式化输出
if (!function_exists('p')) {

    function p($param) {
        $debug = get_last_debug();
        echo '<pre>';
        echo 'file:' . $debug['file'] . '<br>line: ' . $debug['line'] . '<br>';
        echo '================================BEGIN================================';
        echo '<br/>';
        var_dump($param);
        echo '================================END================================';
        echo '</pre>';
    }

}
//调试函数，格式化输出并退出
if (!function_exists('pe')) {

    function pe() {
        $debug = get_last_debug();
        $param = func_get_args();
        echo '<pre>';
        echo 'file:' . $debug['file'] . '<br>line: ' . $debug['line'] . '<br>';
        echo '================================BEGIN================================';
        echo '<br/>';
        var_dump($param);
        echo '================================END，EXIT================================';
        echo '</pre>';
        exit;
    }

}

if (!function_exists('get_last_debug')) {

    function get_last_debug($num = '1') {
        $debug = debug_backtrace();
        if (count($debug) >= $num) {
            $debug = $debug[$num];
        } else {
            $debug = array_pop($debug);
        }
        $data = array('file' => $debug['file'], 'line' => $debug['line']);
        return $data;
    }

}
    