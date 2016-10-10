<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>

<?php $this->load->view_part($this->_site_path . "/news/search") ?>


<!--列表版块-->
<form method="post" action="<?php echo base_url($this->_site_path . "/news/delete_all"); ?>">
    <div class="list_box">
        <table id="tb" class="table table-striped table-condensed table-bordered">
            <thead>
                <tr class="table-thbg">
                    <th class="selection_box">
                        <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                    </th>
                    <th>标题</th>
                    <th>类型</th>
                    <th>作者</th>
                    <th>关键字</th>
                    <th>备注</th>
                    <th>操作</th>
                </tr>

            </thead>
            <tbody>

                <?php foreach ($news_data as $single) { ?>
                    <!--  鼠标悬停，整行变色，-->
                    <tr  >
                        <td>
                            <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                        </td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news/view/{$single['id']}"); ?>';"><?php echo $single['title']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news/view/{$single['id']}"); ?>';"><?php echo $this->news_type_model->get_value_by_pk($single['pid'],'type_name'); ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news/view/{$single['id']}"); ?>';"><?php echo $single['author']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news/view/{$single['id']}"); ?>';"><?php echo $single['keywords']; ?></td>
                        <td onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/news/view/{$single['id']}"); ?>';"><?php echo $single['description']; ?></td>
                        <td>
                            <a href="<?php echo base_url($this->_site_path . "/news/edit/{$single['id']}"); ?>">修改</a>
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
