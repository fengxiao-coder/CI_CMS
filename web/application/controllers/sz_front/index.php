<?php
header("content-type:text/html;charset=utf-8");

/**
 * index
 * @author xiaofeng 
 * @version 1.0
 * @package application
 */
class Index extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('user_model');
        $this->load->model('config_model');
        $this->_site_path = "sz_front";
    }

    /**
     * 首页
     */
    public function index() {
        $data = array();
        $data['slides'] = $this->_get_slides();
        $data['hot_goods'] = $this->hot_goods();
        $data['special_goods'] = $this->special_goods();
        //$data['defaultPic']=$this->_get_imagemark();
        //公告信息
        $this->load->view($this->_site_path . "/index/index", $data);
    }

    /*
     * 意见反馈
     */

    public function suggest() {
        $this->load->model('suggest_model');
        if ($this->input->post('phone_type')) {
            $suggest_data = $this->input->post();
            array_pop($suggest_data);
            $suggest_data['created'] = time();
            $suggest_data['modified'] = time();
            //插入
            $suggest_id = $this->suggest_model->insert($suggest_data);
            echo $suggest_id;
        }
        $this->load->view('sz_front/index/suggest', $data);
    }

    /**
     * goods 显示详细页
     * @param $id 主键值
     * @author 咸洪伟
     */
    public function detail($id) {
        $this->load->model('goods_evaluation_model');
        $this->load->model('goods_service_model');
        $this->load->model('user_model');
        $this->load->model('goods_photo_model');
        $this->load->model('goods_attribute_model');
        $this->load->model('goods_attr_model');
        $user_id = $this->session->userdata('userid');
        $data['goods_data'] = $this->goods_model->get_by_pk($id);
        if ($data['goods_data']) {
            if ($user_id) {
                $data['count'] = $this->num_cart();
            } else {
                $data['count'] = 0;
            }
            foreach (explode(",", $data['goods_data']['service']) as $key => $value) {
                $data['service'][$key] = $this->goods_service_model->get_by_pk($value);
            }
            $data['goods_photo'] = $this->goods_photo_model->get_appoint_values(array('photo'), null, array('attributes' => array('goods_id' => $id)));
            $goods_attr = $this->goods_attr_model->get_appoint_values(array('attr_id', 'goods_attr_id', 'attr_price', 'attr_value'), null, array('attributes' => array('goods_id' => $id, 'attr_input_type' => 3)));
            $data['goods_par'] = $this->goods_attr_model->get_appoint_values(array('attr_id', 'goods_attr_id', 'attr_price', 'attr_value'), null, array('attributes' => array('goods_id' => $id, 'attr_input_type' => 1)));
            foreach ($goods_attr as $value) {
                $att = $value['attr_id'];
                $data['goods_attr'][$att][] = $value;
            }
            $data['goods_evaluation'] = $this->goods_evaluation_model->get_appoint_values(array('id', 'user_id', 'content', 'evaluation', 'created_time'), null, array('attributes' => array('goods_id' => $id, 'status' => 0), 'orders' => array('id' => 'desc', 'created_time' => 'asc')));
            $data['good_evaluation'] = $data['medium_evaluation'] = $data['bad_evaluation'] = 0;
            foreach ($data['goods_evaluation'] as $key => $value) {
                if ($value['evaluation'] == 0) {
                    $data['good_evaluation'] = $data['good_evaluation'] + 1;
                } elseif ($value['evaluation'] == 1) {
                    $data['medium_evaluation'] = $data['medium_evaluation'] + 1;
                } else {
                    $data['bad_evaluation'] = $data['bad_evaluation'] + 1;
                }
            }
            $this->load->view('sz_front/index/detail', $data);
        } else {
            ?>
            <script type="text/javascript">
                alert("该商品不存在，快去购物吧");
                window.location = "<?php echo base_url('sz_front/index/index'); ?>";
            </script>
            <?php
        }
    }

    public function evaluation() {
        $data = array();
        $this->load->model('goods_evaluation_model');
        $this->load->model('reply_evaluation_model');
        $search['attributes'] = $this->input->get();
        // 总数与分页
        $data['per'] = 6;
        $data['total'] = $this->goods_evaluation_model->total(null, $search);
        //实例化分页类对象
        $page_obj = new Page($data['total'], $data['per']);
        $sql = "SELECT `id` , `goods_id` ,`user_id`, `evaluation` , `content` , `created_time` FROM `goods_evaluation` where goods_id = {$search['attributes']['goods_id']} and evaluation = {$search['attributes']['evaluation']} " . $page_obj->limit;
        $query = $this->db->query($sql);
        $data['goods_evaluationr'] = $query->result_array();
        foreach ($data['goods_evaluationr'] as $key => $value) {
            $data['goods_evaluationr'][$key]['reply'] = $this->reply_evaluation_model->all(array('attributes' => array('ge_id' => $value['id'])));
        }
        //获得页码列表
        $data['pagelist'] = $page_obj->fpage(array(3, 4, 5, 6, 7, 8));
        $p = isset($_GET['page']) ? $_GET['page'] : 1;
        $data['num'] = ($p - 1) * $data['per'];
        $this->load->view('sz_front/index/evaluation', $data);
    }

    public function attr($id) {
        $this->load->model('goods_attribute_model');
        $this->load->model('goods_attr_model');
        $data['goods_data'] = $this->goods_model->get_by_pk($id);
        $data['goods_attribute'] = $this->goods_attribute_model->get_appoint_values(array('attr_name', 'attr_type', 'attr_input_type', 'attr_value'), null, array('attributes' => array('type_id' => $data['goods_data']['pid'])));
        $goods_attr = $this->goods_attr_model->get_appoint_values(array('attr_id', 'goods_attr_id', 'attr_price', 'attr_value'), null, array('attributes' => array('goods_id' => $id)));
        $new_result = array();
        foreach ($goods_attr as $value) {
            $att = $value['attr_id'];
            $new_result[$att][] = $value;
        }
        $data['goods_attr'] = $new_result;
        $this->load->view('sz_front/index/attr', $data);
    }

    /*
      详情页商品数量+1
     */

    public function inc_num($id, $num = 1) {
        $goods_data = $this->goods_model->get_by_pk($id);
        if (isset($id)) {
            $goods_data['num'] += $num;
        }
        $this->goods_model->update_by_pk($goods_data, $id);
        redirect(base_url('sz_front/index/detail/'));
    }

    /*
      详情页商品数量-1
     */

    public function dec_num($id, $num = 1) {
        $goods_data = $this->goods_model->get_by_pk($id);
        if (isset($id)) {
            $goods_data['num'] -= $num;
        }
        if ($goods_data['num'] = 1) {
            $goods_data['num'] = $num;
        }
        $this->goods_model->update_by_pk($goods_data, $id);
    }

    /**
     * 获取首页轮播
     * @return type
     */
    //广告
    public function _get_slides() {
        $this->load->model('adv_model');
        $search = array(
            'attributes' => array('status' => 0),
            'limit' => array('persize' => 3, 'offset' => 0),
            'orders' => array('sort' => 'asc'),
        );
        return $this->adv_model->get_appoint_values(array('adv_id', 'adv_title', 'adv_url', 'photo', 'adv_content', 'status', 'sort'), null, $search);
    }

    /**
     * 获取默认图片路径和文章ID
     * @return type
     */
    public function _get_imagemark() {
        $condition = array(
            'attributes' => array('is_hot' => 19, 'status' => 0),
            'limit' => array('persize' => 20, 'offset' => 0),
            'orders' => array('id' => 'asc', 'created' => 'desc'),
        );
        return $this->goods_model->get_appoint_values(array('id', 'photo', 'name', 'price'), null, $condition);
    }

    /**
     * 获取特价商品
     * @return type
     */
    public function special_goods() {
        $sql = "SELECT * FROM `goods`WHERE `is_special` =1 AND `status` =0 AND `num` !=0 ORDER BY `modified` DESC LIMIT 0, 6 ";
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        return $arr;
    }

    /**
     * 获取热卖
     * @return type
     */
    public function hot_goods() {
        $search = array(
            'attributes' => array('status' => 0, 'num_notequal' => 0),
            'limit' => array('persize' => 6, 'offset' => 0),
            'orders' => array('sales' => 'desc'),
        );
        return $this->goods_model->all($search);
    }

    /**
     * 详情页购物车的数量
     * @return type
     */
    public function num_cart() {
        $user_id = $this->session->userdata('userid');
        $sql = "SELECT * FROM `cart` WHERE user_id ={$user_id} AND wait_pay =0";
        $query = $this->db->query($sql);
        $arr = $query->result_array();
        foreach ($arr as $value) {
            $count = $count + $value['goods_number'];
        }
        return $count;
    }

    /**
     * 判断是否登录
     * 
     */
    public function is_login() {
        $user_name = $this->session->userdata('user_name');
        $user_id = $this->session->userdata('userid');
        if (empty($user_id)) {
            redirect(base_url('sz_front/user/login'));
        }
    }

}
