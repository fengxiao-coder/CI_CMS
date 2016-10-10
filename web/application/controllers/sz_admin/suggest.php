<?php

/**
 * suggest
 * @version 1.0
 * @package application
 * @subpackage application/controllers/suggest/
 */
class Suggest extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function delete($id) {
        $this->load->model("suggest_model");
        $this->suggest_model->delete_by_pk($id);
        redirect(base_url('sz_admin/suggest/index'));
    }

    /**
     * delete_all 批量删除
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function delete_all() {
        $this->load->model("suggest_model");
        $ids = $this->input->post('ids');
        foreach ($ids as $id) {
            $this->suggest_model->delete_by_pk($id);
        }
        redirect(base_url('sz_admin/suggest/index'));
    }

}
