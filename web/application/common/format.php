<?php
    /**格式化数组输出**/
    function p($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        echo "<hr/>";
    }
    
	/**格式化数组输出**/
    function pexit($arr)
    {
        echo "<pre>";
        print_r($arr);
        echo "</pre>";
        
		exit;
	}
    