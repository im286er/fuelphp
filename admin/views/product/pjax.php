<div class="row-fluid table">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="span4 sortable">
                                    Tên Category
                                </th>
                                <th class="span3 sortable">
                                    <span class="line"></span>Note
                                </th>
                                <th class="span2 sortable">
                                    <span class="line"></span>Active
                                </th>
                                <th class="span2 sortable">
                                  <span class="line"></span>Action
                                
                                </th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <!-- row -->
                        <?php foreach($product as $row): ?>
                        <tr class="first" id="<?php echo $row['_id'] ?>">
                            <td>
                                <?php echo $row['nameproduct']; ?>
                            </td>
                            <td>
                                <?php echo $row['note']; ?>
                            </td>
                            <td>
                               <?php if(isset($row['active'])):  ?>
                                    <?php if($row['active']==0): ?>
                                    <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/product/active/<?php echo $row['_id']; ?>"> Active</a>
                               
                                    <?php else: ?>
                                       <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/product/unactive/<?php echo $row['_id']; ?>">Unactive</a>
                                
                                    <?php endif; ?>
                               <?php else: ?>
                               
                                  <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/product/active/<?php echo $row['_id']; ?>"> Active</a>
                                  
                               
                               <?php endif; ?>
                            </td>
                            <td>
                            <a href="<?php echo \Uri::base() ?>admin/product/edit/<?php echo $row['_id']; ?>">Edit</a>
                            <a id="delete" href="<?php echo \Uri::base() ?>admin/product/delete/<?php echo $row['_id']; ?>">Delete</a>
                            </td>
                        </tr>
                      
                       <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php echo \Pagination::instance('mypagination')->render(); ?>