<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<!--  详情-->
<div class="box box-headtitle box-radius">
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="details_tab">

        <tr>
            <td width="12%" class="details_title"><strong>名称</strong></td>
            <td width="88%"><?php echo $goods_type_data['type_name']; ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>属性</strong></td>
            <td colspan="7"  style="text-align:left;">
                <ul class="tab_items_ul">
                    <?php foreach ($goods_attribute_data as $k => $value) { ?>
                        <li>
                            <span><?php echo $value['attr_name'] ?></span>:&nbsp;&nbsp;
                            <span><?php echo $value['attr_value'] ?></span>
                        </li>       
                    <?php } ?>

                </ul>
            </td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>排序</strong></td>
            <td width="88%"><?php echo $goods_type_data['sort']; ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title"><strong>创建时间</strong></td>
            <td width="88%" ><?php echo init_date($goods_type_data['created']); ?></td>
        </tr>

        <tr>
            <td width="12%" class="details_title"><strong>修改时间</strong></td>
            <td width="88%"><?php echo init_date($goods_type_data['modified']); ?></td>
        </tr>
        <tr>
            <td width="12%" class="details_title">备注</td>
            <td width="88%"colspan="3"  class="Description"> 
                <p style="height:auto; min-height:150px; _height:150px;">&nbsp;<?php echo $goods_type_data['remark']; ?></p>
            </td>
        </tr>
    </table>
</div>
</div>