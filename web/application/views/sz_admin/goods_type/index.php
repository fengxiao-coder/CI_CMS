<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>

<?php $this->load->view_part($this->_site_path . "/goods_type/search") ?>
<style type="text/css">
    .panel{	
        display:none;
    }
    .tab_items_ul li span{
        margin-right: 50px;min-width: 200px;
    }
</style>

<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/goods_type/delete_all"); ?>">
                <div class="list_box">
                    <table id="tb" class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>名称</th>
                                <th>备注</th>
                                <th>排序</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($goods_type_data as $single) {
                                $where['attributes'] = array('type_id' => $single['type_name']
                                );
                                ?>
                            <thead class="div">
                                <tr>
                                    <td>
                                        <input name="ids[]" value="<?php echo $single['type_id']; ?>" type="checkbox" />
                                    </td>
                                    <td style="cursor:pointer;cursor:hand"><?php echo $this->goods_category_model->get_value_by_pk($single['type_name'], 'cat_name'); ?></td>
                                    <td style="cursor:pointer;cursor:hand"><?php echo $single['remark']; ?></td>
                                    <td style="cursor:pointer;cursor:hand"><?php echo $single['sort']; ?></td>
                                    <td>
                                        <a href="<?php echo base_url($this->_site_path . "/goods_attribute/add/{$single['type_id']}"); ?>">添加属性</a>
                                        <a href="<?php echo base_url($this->_site_path . "/goods_type/edit/{$single['type_id']}"); ?>">修改</a>
                                    </td>
                                </tr>
                                <tr class="panel">
                                    <td colspan="7"  style="text-align:left;">
                                        <ul class="tab_items_ul">
                                            <?php
                                            if ($this->goods_attribute_model->all($where)) {
                                                ?>
                                                <?php foreach ($this->goods_attribute_model->all($where) as $k => $value) { ?>
                                                    <li>
                                                        <span><?php echo $value['attr_name'] ?></span>
                                                        <span>

                                                            <?php
                                                            if ($value['attr_input_type'] == 1) {
                                                                echo"";
                                                            } else {
                                                                echo $value['attr_value'];
                                                            }
                                                            ?></span>
                                                        <span>
                                                            <a href="<?php echo base_url($this->_site_path . "/goods_attribute/edit/{$value['attr_id']}"); ?>">修改</a>
                                                            <a href="<?php echo base_url($this->_site_path . "/goods_attribute/delete/{$value['attr_id']}"); ?>" onclick="return confirmDelete()">删除</a>
                                                        </span>
                                                    </li>       
                                                <?php } ?>
                                            <?php } else { ?>
                                                <li>
                                                    <span>还未添加属性</span>
                                                </li> 
                                            <?php } ?>
                                        </ul>
                                    </td>
                                </tr>
                            </thead>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="tips">
                    <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
                    <!-- 分页开始-->
                    <?php echo $pagination; ?>
                    <!-- 分页结束-->
                </div>
            </form>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $(".div").mouseover(function () {
                    $(this).find(".panel").show();
                }).mouseout(function () {
                    $(this).find(".panel").hide();
                });
            });
        </script>