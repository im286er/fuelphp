
<?php echo \Asset::css(array('admin/uniform.default.css','admin/select2.css')); ?>
<script type="text/javascript">
  jQuery(document).on('click','#addtt',function(){
      var numb_key =parseInt(jQuery('input[name=numbkey]').val())+1;
      var html ='<div style="width:113px;float:left;">';
          html +='<label>Key'+numb_key+':</label>';
          html +='<input id="key" style="width:100px" class="span8 required" type="text" name="key'+numb_key+'" />';
          html +='</div>';
          html +='<div style="width:361px;float:left;">';
          html +='<label>Value'+numb_key+':</label>';
          html +='<input id="value" class="span8 required" type="text" name="value'+numb_key+'" />';
          html +='</div>';
       jQuery('#load').append(html);
       jQuery('input[name=numbkey]').val(numb_key);
          
    return false;
    
  });
 var validator = $("#addproduct").validate({ 
        rules: { 
            product: "required", 
            key: { 
                required: true, 
                
            }, 
            value: { 
                required: true, 
                
            }
        }, 
        messages: { 
            product: "Không Được Để Trống", 
            key: { 
                required: "Không Được Để Trống", 
                
            }, 
            value: { 
                required: "Không Được Để Trống", 
                
            }
        }
    }); 
  
  jQuery(document).on('submit','#addproduct',function(){
      var data_form =jQuery(this).serialize();
      if($('#addproduct').valid()==true)
      {
      $.ajax({
         url:url_admin+'product/actionedit/<?php echo $product['_id'];?>',
        data:data_form,
         cache:false,
         async:false,
         dataType:'json',
         type:'POST',
         success:function(status)
         {
            if(status.status=='success')
            {
                alert("Thanh Cong");
            }
            else
            {
               
                console.log('Errors SERVER 500');
            }    
            
            
         }    
        
      });
    return false;
    }
    else
    {
        
        alert('Không Để Trống Tên Sản Phẩm và Key Value');
        return false;
        
        
        }
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
            <div id="pad-wrapper" class="form-page">
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <?php echo \Form::open(array('id'=>'addproduct')); ?>
                    <div class="span8 column">
                      
                            <div class="field-box">
                                <label>Tên Sản Phẩm:</label>
                                <input id="product" class="required" value="<?php echo $product['nameproduct']; ?>" class="span8" type="text" name='product' />
                            </div>
                            <div class="field-box">
                                <label>Đặc Tính Sản phẩm:</label>
                                <div id="load">
                                <?php $size=sizeof($product['keyvalue']); ?>
                                <?php for($i=0;$i<$size;$i++): ?>
                                   <?php foreach($product['keyvalue'][$i]as $key=>$value): ?>
                                    <div  style="width:113px;float:left;">
                                    <label>Key<?php echo $i+1; ?>:</label>
                                    <input id="key" class="required" value="<?php echo $key ?>" style='width:100px' class="span8" type="text" name='key<?php echo $i+1; ?>' />
                                    </div>
                                    <div style="width:361px;float:left;">
                                    <label>Value<?php echo $i+1; ?>:</label>
                                    <input id="value"  class="required" value="<?php echo $value; ?>" class="span8" type="text" name='value<?php echo $i+1; ?>' />
                                    </div>
                                  <?php endforeach; ?>
                                  <?php endfor; ?>  
                                </div>
                            </div>
                            <input type="hidden" value="<?php echo $size; ?>" name="numbkey" />
                            <button id='addtt' class="btn btn-primary">Thêm Đặc Tính</button>
                             <div class="field-box">
                                <label>Note</label>
                                <textarea style="width: 472px;" name="note">
                                <?php echo $product['note']; ?>
                                </textarea>
                            </div>
                          <input type="submit" value="Save" />
                    </div>

                    <!-- right column -->
                    <div class="span4 column pull-right">
                        
                            <div class="field-box">
                                <label>Chọn Category:</label>
                                <select style="width:250px" class="select2" name="category">
                                   <?php if($category): ?>
                                   <?php foreach($category as $row): ?>
                                   <?php if($product['id_category']==$row['_id']): ?>
                                  <option value="<?php echo $row['_id'] ?>" selected='selected'> 
                                  <?php echo $row['name_category']; ?>
                                  </option>
                                   <?php else: ?>
                                    <option value="<?php echo $row['_id'] ?>">
                                    <?php echo $row['name_category']; ?>
                                   </option>
                                   
                                   <?php endif; ?>
                                   
                                    
                                    <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>
                        
                       
                    </div>
                     <?php echo \Form::close(); ?>
                </div>
            </div>
        </div>
    </div>
   <?php echo \Asset::js(array('jquery.uniform.min.js','select2.min.js','theme.js')) ?>
     <script type="text/javascript">
        $(function () {

            // add uniform plugin styles to html elements
            $("input:checkbox, input:radio").uniform();

            // select2 plugin for select elements
            $(".select2").select2({
                placeholder: "Select a State"
            });

            // datepicker plugin
           

            // wysihtml5 plugin on textarea
           
        });
    </script>