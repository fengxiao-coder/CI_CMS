<?php
function show_error($url, $status_code = 500, $title = '')
	{
		$_error =& load_class('Exceptions', 'core');
		echo $_error->show_error_1($title, $url, 'error_general', $status_code);
		exit;
	}