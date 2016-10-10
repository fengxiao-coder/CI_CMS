<?php $this->load->view_part($this->_site_path . "/main/breadcrumb"); ?>
<?php $this->load->view_part($this->_site_path . "/supplier/search"); ?>
<div class="list_box">
    <div id="tab_box">
        <div class=" display_block">
            <!--列表版块-->
            <form method="post" action="<?php echo base_url($this->_site_path . "/supplier/deleted"); ?>">
                <div class="list_box">
                    <table id="tb" class="table table-striped table-condensed table-bordered">
                        <thead>
                            <tr class="table-thbg">
                                <th class="selection_box">
                                    <input name="checkAll" type="checkbox" onclick="checkAllfuck()" />
                                </th>
                                <th>名称</th>
                                <th>电话</th>                      
                                <th>地址</th>
                                <th>联系人</th>
                                <th>负责人联系方式</th>                      
                                <th>邮箱</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php foreach ($supplier_data as $single) { ?>
                                <!--  鼠标悬停，整行变色，-->
                                <tr>
                                    <td>
                                        <input name="ids[]" value="<?php echo $single['id']; ?>" type="checkbox" />
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';"><?php echo $single['name']; ?></td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';">
                                        <?php echo $single['phone']; ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';">
                                        <?php echo $single['address']; ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';">
                                        <?php echo $single['person']; ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';">
                                        <?php echo $single['person_tp']; ?>
                                    </td>
                                    <td style="cursor:pointer;cursor:hand" onclick="javascript:window.location.href = '<?php echo base_url($this->_site_path . "/supplier/view/{$single['id']}"); ?>';">
                                        <?php echo $single['email']; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url($this->_site_path . "/supplier/edit/{$single['id']}"); ?>">修改</a>
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

