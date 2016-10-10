<?php
/**
 * user
 * @version 1.0
 * @package application
 * @subpackage application/controllers/user/
 */
class Print_code extends MY_Controller
{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 批量打印条码
	 *  @param type $num 打印数量
	*/
	public function print_all( $num = 0 ) {
		try {
			$code_array = $this->input->post( 'ids' );
			if (is_string($code_array)){
				$this->load->model('goods_model');
				$data['message'][0] = $this->goods_model->get_print_info( $code_array );
				$data['message'][0]['count']  = $num ;
			}else{
				if ( empty( $code_array ) ) throw new Exception( "请选择打印的产品", -2 );
				$count = count( $code_array );
				for ( $i = 0; $i < $count; $i++ ) {
					$this->load->model('goods_model');
					$data['message'][$i] = $this->goods_model->get_print_info( $code_array[$i] );
					$data['message'][$i]['count']  = $num ;
				}
			} 
			
			$this->load->view_part( 'sz_admin/print_code/print' ,$data);
		} catch ( Exception $e ) {
			init_messagebox( $e->getMessage(), 'error', $e->getCode() );
		}
	}
	/**
	 * 打印店铺条码 ...
	 * @param int $num
	 */
	public function print_store($num = 0){
		$this->load->model("store_model");
		try {
			$store_id=$this->auth->get_user('store_id');			
			$store_data = $this->store_model->get_by_pk( $store_id );
			//$print['code_content'] = base_url("sz_front/user/register/{$store_id}");
			$data['codeContent'] = base_url("sz_front/user/register")."?store_id=".$store_id;
			$data['count']=$num;
			//p($data);	
			$this->load->view_part( 'sz_admin/print_code/print_store' ,$data);
		} catch ( Exception $e ) {
			init_messagebox( $e->getMessage(), 'error', $e->getCode() );
		}
	}
	
}
