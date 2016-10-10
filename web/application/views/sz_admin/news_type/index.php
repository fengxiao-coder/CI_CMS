<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>

<?php $this->load->view_part($this->_site_path . "/news_type/search") ?>

<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path . "/news_type/delete_all"); ?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>名称</th>
                    <th>类型</th>
                    <th>备注</th>
                    <th>排序</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($news_type_data as $single) { ?>
                    <!--  鼠标悬停，整行变色，-->
                    <tr  >
                        <td>
                            <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                        </td>
                        <td style="text-align: left;"><a href="<?php echo base_url("sz_admin/news_type/view/{$single['id']}"); ?>"><?php echo $single['lev']?str_repeat('&nbsp;&nbsp;&nbsp;&nbsp;', $single['lev']).$single['type_name']:$single['type_name']; ?></a></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news_type/view/{$single['id']}"); ?>';"><?php echo $single['pid'] == 0 ? '顶级分类' : $this->news_type_model->get_value_by_pk($single['pid'],'type_name'); ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news_type/view/{$single['id']}"); ?>';"><?php echo $single['remark']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news_type/view/{$single['id']}"); ?>';"><?php echo $single['depth']; ?></td>
                        <td>
                            <a href="<?php echo base_url($this->_site_path . "/news_type/edit/{$single['id']}"); ?>">修改</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <!-- 表格底部帮助栏-->
    <div class="tips">
        <!--/*这个help有的页面没有，我只是做个范例，具体看实际情况*/-->
        <div class="float_left"><button type="submit" class="btn btn_style1" onclick="return confirmDelete()"><span>删 除</span></button></div><!--/*这个按钮有的页面没有，我只是做个范例，具体看实际情况*/-->
        <!-- 分页开始-->
        <?php echo $pagination; ?>
        <!-- 分页结束-->
    </div>
</form>
<!--tips 结束-->
</div>
</div>
</div>