<?php
class MY_Loader extends CI_Loader {
	public function view($view, $vars = array(), $return = FALSE) {
		$data ['content'] = $this->view_part ( $view, $vars, TRUE ); 
		$this->view_part ( $this->layout, $data, $return );
	}
	public function view_part($view, $vars = array(), $return = FALSE) {
		return $this->_ci_load ( array (
				'_ci_view' => $view,
				'_ci_vars' => $this->_ci_object_to_array ( $vars ),
				'_ci_return' => $return 
		) );
	}
}

?>
