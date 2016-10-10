<?php

/**
 * storage
 * @version 1.0
 * @package application
 * @subpackage application/controllers/storage/
 */
class Storage extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index($flag = 'purchase') {
        $this->load->model("purchase_model");
        $this->load->model("goods_model");
        $this->load->model("goods_category_model");
        $this->load->model("shipment_model");
        $this->load->model("order_goods_model");
        $this->load->model("order_info_model");
        $attributes = $this->input->get();
        //p($attributes);
        $data['current_type'] = $flag;
        if ($flag == "purchase") {
            if ($attributes['cat_id'] && !$attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and cat_id={$attributes['cat_id']} group by goods_id";
            } elseif (!$attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and goods_name like '%{$attributes['name_like']}%' group by goods_id";
            } elseif ($attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and cat_id={$attributes['cat_id']} and goods_name like '%{$attributes['name_like']}%' group by goods_id";
            } else {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 group by goods_id";
            }
            $query = $this->db->query($sql);
            $num = $query->num_rows();
            $per_page = config_item('per_page');
            $this->load->library('pagination');
            $pagination_config = array(
                'base_url' => base_url('sz_admin/storage/index/' . $flag . '?&'),
                'total_rows' => $num,
                'per_page' => $per_page,
                'uri_segment' => 4,
                'page_query_string' => TRUE,
                'enable_query_strings' => TRUE,
            );
            $this->pagination->initialize($pagination_config);
            $data['pagination'] = $this->pagination->create_links();

            if ($attributes['cat_id'] && !$attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and cat_id={$attributes['cat_id']} group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } elseif (!$attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and goods_name like '%{$attributes['name_like']}%' group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } elseif ($attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 and cat_id={$attributes['cat_id']} and goods_name like '%{$attributes['name_like']}%' group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } else {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from purchase where status=1 group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            }
            $query = $this->db->query($sql);
            $data['storage_data'] = $query->result_array();
            //p($data["storage_data"]);
        } elseif ($flag == "shipment") {
            if ($attributes['cat_id'] && !$attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where cat_id={$attributes['cat_id']} group by goods_id";
            } elseif (!$attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where goods_name like '%{$attributes['name_like']}%' group by goods_id";
            } elseif ($attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where cat_id={$attributes['cat_id']} and goods_name like '%{$attributes['name_like']}%' group by goods_id";
            } else {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment group by goods_id";
            }
            $query = $this->db->query($sql);
            $num = $query->num_rows();
            $per_page = config_item('per_page');
            $this->load->library('pagination');
            $pagination_config = array(
                'base_url' => base_url('sz_admin/storage/index/' . $flag . '?&'),
                'total_rows' => $num,
                'per_page' => $per_page,
                'uri_segment' => 4,
                'page_query_string' => TRUE,
                'enable_query_strings' => TRUE,
            );
            $this->pagination->initialize($pagination_config);
            $data['pagination'] = $this->pagination->create_links();
            if ($attributes['cat_id'] && !$attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where cat_id={$attributes['cat_id']} group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } elseif (!$attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where goods_name like '%{$attributes['name_like']}%' group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } elseif ($attributes['cat_id'] && $attributes['name_like']) {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment where cat_id={$attributes['cat_id']} and goods_name like '%{$attributes['name_like']}%' group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            } else {
                $sql = "select cat_id,goods_name,goods_id,sum(amount) from shipment group by goods_id limit " . $this->pagination->get_cur_offset() . ',' . $per_page;
            }
            $query = $this->db->query($sql);

            $data['storage_data'] = $query->result_array();
        }
        $data['goods_category'] = $this->goods_category_model->get_goods_category_options();
        $this->load->view('sz_admin/storage/index', $data);
    }

    public function view($goods_id, $current_type) {
        $this->load->model("admin_model");
        $this->load->model("purchase_model");
        $this->load->model("shipment_model");
        $this->load->model("goods_category_model");
        $this->load->model("brand_model");
        $this->load->model("goods_model");
        $this->load->model("supplier_model");
        $this->load->model("store_model");

        if ($current_type == "purchase") {
            $data['storage_data'] = $this->purchase_model->all(array("attributes" => array("goods_id" => $goods_id, "status" => 1)));
        } elseif ($current_type == "shipment") {
            $data['storage_data'] = $this->shipment_model->all(array("attributes" => array("goods_id" => $goods_id)));
        }
        //p($data['storage_data']);
        $data['goods_id'] = $goods_id;
        $data['current_type'] = $current_type;
        $this->load->view('sz_admin/storage/view', $data);
    }

}
