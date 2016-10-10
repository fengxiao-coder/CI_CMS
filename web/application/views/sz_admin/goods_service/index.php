<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/goods_service/search") ?>
<form method="post" action="<?php echo base_url($this->_site_path . "/goods_service/delete_all"); ?>">
    <div class="list_box">
        <table class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>商品名称</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($goods_service_data as $single) {
                    ?>
                    <tr>
                        <td>
                            <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" codeContent="<?php echo base_url($this->_site_path . "/goods_service/view/{$single['id']}"); ?>"/>
                        </td>
                        <td class="align_left" style="cursor:pointer;cursor:hand"  onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_service/view/{$single['id']}"); ?>';">
                            <?php echo $single['name']; ?>
                        </td>
                        <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/goods_service/view/{$single['id']}"); ?>';">
                            <?php echo $single['remark']; ?>
                        </td>
                        <td>
                            <a <?php if ($single['status'] == 1) echo 'style="display:none"' ?> href="<?php echo base_url($this->_site_path . "/goods_service/edit/{$single['id']}"); ?>">修改</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
        <?php echo $pagination; ?>
    </div>
</form>
