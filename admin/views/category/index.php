 <script type="text/javascript">
  jQuery(document).on('click','#delete',function(){
     var select=$(this);
     var href_delete=jQuery(this).attr('href');
     var id=jQuery('#object').val();
     var check = confirm('Bạn có chắc chắn muốn xóa không');
     if(check==true)
     {
         $.ajax({
            type:'POST',
            async:false,
            cache:false,
            dataType:'json',
            url:href_delete,
            success:function(status)
            {
                if(status.status=='success')
                {
                    alert('Delete Thanh Cong');
                    select.parent().parent().remove();
                }
                else
                {
                    console.log('Errors SERVER ');
                }
            }
        
         });
    
    }
    return false;
    
  });
 
 
 </script>

 <div class="content">
        
        <!-- settings changer -->
        <div class="skins-nav">
            <a href="#" class="skin first_nav selected">
                <span class="icon"></span><span class="text">Default</span>
            </a>
            <a href="#" class="skin second_nav" data-file="css/skins/dark.css">
                <span class="icon"></span><span class="text">Dark skin</span>
            </a>
        </div>
        
        <div class="container-fluid">
            <div id="pad-wrapper" class="users-list">
                <div class="row-fluid header">
                    <h3>Category</h3>
                    <div class="span10 pull-right">
                        <input type="text" class="span5 search" placeholder="Type a user's name..." />
                        
                        <!-- custom popup filter -->
                        <!-- styles are located in css/elements.css -->
                        <!-- script that enables this dropdown is located in js/theme.js -->
                        <div class="ui-dropdown">
                            <div class="head" data-toggle="tooltip" title="Click me!">
                                Filter Category
                                <i class="arrow-down"></i>
                            </div>  
                            <div class="dialog">
                                <div class="pointer">
                                    <div class="arrow"></div>
                                    <div class="arrow_border"></div>
                                </div>
                              
                            </div>
                        </div>

                        <a href="<?php echo \Uri::base() ?>admin/category/add" class="btn-flat success pull-right">
                            <span>&#43;</span>
                            NEW Category
                        </a>
                    </div>
                </div>

                <!-- Users table -->
                <div id="pjax_load">
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
                        <?php foreach($category as $row): ?>
                        <tr class="first" id="<?php echo (string)$row['_id']['$oid']; ?>">
                            <td>
                                <?php if(array_key_exists('name_category',$row)): echo $row['name_category'];endif; ?>
                            </td>
                            <td>
                                <?php if(array_key_exists('note',$row)): echo $row['note'];endif; ?>
                            </td>
                            <td>
                               <?php if(isset($row['active'])):  ?>
                                    <?php if($row['active']==0): ?>
                                    <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/category/active/<?php echo (string)$row['_id']['$oid']; ?>"> Active</a>
                               
                                    <?php else: ?>
                                       <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/category/unactive/<?php echo (string)$row['_id']['$oid']; ?>">Unactive</a>
                                
                                    <?php endif; ?>
                               <?php else: ?>
                               
                                  <a id="link_active"  href="<?php echo \Uri::base(); ?>admin/category/active/<?php echo (string)$row['_id']['$oid']; ?>"> Active</a>
                                  
                               
                               <?php endif; ?>
                            </td>
                            <td>
                            <a href="<?php echo \Uri::base() ?>admin/category/edit/<?php echo (string)$row['_id']['$oid']; ?>">Edit</a>
                            <a id="delete" href="<?php echo \Uri::base() ?>admin/category/delete/<?php  echo (string)$row['_id']['$oid']; ?>">Delete</a>
                            </td>
                        </tr>
                      
                       <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                 <?php echo \Pagination::instance('mypagination')->render(); ?>
                </div>
             
                <!-- end users table -->
            </div>
        </div>
    </div>
    <!-- end main container -->