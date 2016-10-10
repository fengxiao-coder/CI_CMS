<?php
header("content-type:text/html;charset=utf-8");
class Cart extends Front_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('goods_model');
        $this->load->model('cart_model');
        $this->load->model('user_model');
        $this->_site_path = "sz_front";
    }

    /*
     * 我的购物车
     */

    public function index() {
        $user_id = $this->session->userdata('userid');
        $this->is_login();
        $search = array(
            'attributes' => array('user_id' => $user_id),
            'orders' => array('cart_id' => 'desc'),
        );
        $data['cart_order'] = $this->cart_model->all($search);
        foreach ($data['cart_order'] as $key => $value) {
            $goods[$key] = $this->goods_model->get_by_pk($value['goods_id']);
            if ($goods[$key]['is_special'] == 1) {
                $data['cart_order'][$key]['subtotal'] = $goods[$key]['activity_price'] * $value['goods_number'];
            } else {
                $data['cart_order'][$key]['subtotal'] = $goods[$key]['price'] * $value['goods_number'];
            }
        }
        $this->load->view($this->_site_path . "/cart/index", $data);
    }

    /**
     * 添加购物车
     */
    public function add_cart($id) {
        $user_id = $this->session->userdata('userid');
        $this->is_login();
        session_start();
        if ($this->input->post('is_submit')) {
            $arg = $this->input->post();
            $string = $arg['attr'];
            $num = $arg['num'];
            $shop = $this->goods_model->get_by_pk($id);
            $status = $this->cart_model->get_by_attributes(array('goods_id' => $id, 'user_id' => $user_id));
            $t = $num + $status['goods_number'];
            if ($t > $shop['num']) {
                ?>
                <script type="text/javascript">
                    window.location = "<?php echo base_url('sz_front/index/index'); ?>";
                </script>
                <?php
            } else {
                if ($_SESSION['shoplist'][$shop['id']]) {
                    $number = $num + $status['goods_number'];
                    $arr = array(
                        'cart_id' => $status['cart_id'],
                        'goods_number' => $number,
                        'goods_id' => $id,
                        'goods_attr' => $string,
                        'subtotal' => $number * $status['market_price'],
                    );
                    $this->cart_model->update_by_pk($arr, $status['cart_id']);
                } else {
                    $_SESSION['shoplist'][$shop['id']] = $shop;
                    $data['order_list']['goods_id'] = $shop['id'];
                    $data['order_list']['goods_name'] = $shop['name'];
                    $data['order_list']['goods_img'] = $shop['photo'];
                    $data['order_list']['goods_number'] = $num;
                    $data['order_list']['goods_attr'] = $string;
                    if ($shop['is_special'] == 1) {
                        $data['order_list']['market_price'] = $shop['activity_price'];
                        $data['order_list']['subtotal'] = $shop['activity_price'] * $num;
                    } else {
                        $data['order_list']['market_price'] = $shop['price'];
                        $data['order_list']['subtotal'] = $shop['price'] * $num;
                    }
                    $data['order_list']['user_id'] = $user_id;
                    $data['order_list']['shipping_fee'] = $shop['shipping_fee'];
                    $this->cart_model->insert($data['order_list']);
                }
            }
            redirect(base_url('sz_front/index/detail/' . $id));
        } else {
            ?>
            <script type="text/javascript">
                alert("该商品不存在，请选择其他的商品");
                window.location = "<?php echo base_url('sz_front/index/index'); ?>";
            </script>
            <?php
        }
    }

    /*
     * 删除购物车
     */

    public function delete($id) {
        session_start();
        $user_id = $this->session->userdata('userid');
        if (empty($user_id)) {
            redirect(base_url('sz_front/user/login'));
        } else {
            $arr = array(
                'goods_id' => $id,
                'user_id' => $user_id
            );
            $r = $this->cart_model->delete_by_attributes($arr);
            unset($_SESSION['shoplist'][$id]);
        }
        redirect(base_url('sz_front/cart/index'));
    }

    /*
      清空购物车
     */

    public function clear($id) {
        session_start();
        if ($id) {
            unset($_SESSION['shoplist'][$id]);
        } else {
            unset($_SESSION['shoplist']);
        }
        redirect(base_url('sz_front/cart/index'));
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

    public function cart_updata() {
        $cart = $this->input->post();
        $arr = array(
            'goods_number' => $cart['goods_number'],
            'subtotal' => $cart['goods_subtotal'],
        );
        $this->cart_model->update_by_pk($arr, $cart['cart_id']);
        redirect(base_url('sz_front/cart/index'));
    }

}
