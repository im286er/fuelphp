	<script type="text/javascript">
    jQuery(document).ready(function(){
      var $form_category=jQuery('#addcategory');
      $form_category.submit(function(){
      var data_category=jQuery(this).serialize();
      $.ajax({
         type:'POST',
         cache:false,
         async:false,
         dataType:'json',
         url:url_admin+'category/actionadd/',
         data:data_category,
         success:function(status)
         {
            if(status.status=='success')
            {
                alert('Thêm Thành Công');
                jQuery('input textarea').val('');
                
            }
            else
            {
                alert('Category Trùng Tên Kiểm Tra Lại');   
                
            }    
         }
      });  
        
        return false;
      }); 
   
    });
    </script>
    <!-- main container -->
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
            <div id="pad-wrapper" class="new-user">
                <div class="row-fluid header">
                    <h3>Tạo Category:</h3>
                </div>
                <div class="row-fluid form-wrapper">
                    <!-- left column -->
                    <div class="span9 with-sidebar">
                        <div class="container">
                        <?php echo \Form::open(array('class'=>'new_user_form inline-input','id'=>'addcategory')) ;?>
                                <div class="span12 field-box">
                                    <label>Tên Category:</label>
                                    <input class="span9" type="text" name='name_category' />
                                </div>
                                <div class="span12 field-box textarea">
                                    <label>Notes:</label>
                                    <textarea class="span9" name='note'></textarea>
                                    
                                </div>
                                <div class="span11 field-box actions">
                                    <input type="submit" class="btn-glow primary" value="Tạo Category" />
                                    <span>OR</span>
                                    <input type="reset" value="Cancel" class="btn-glow primary" />
                                </div>
                           <?php echo \Form::close(); ?>
                        </div>
                    </div>

                   
                   
                </div>
            </div>
        </div>
    </div>
    <!-- end main container -->
	<!-- scripts -->
    <script type="text/javascript">
        $(function () {

            // toggle form between inline and normal inputs
            var $buttons = $(".toggle-inputs button");
            var $form = $("form.new_user_form");

            $buttons.click(function () {
                var mode = $(this).data("input");
                $buttons.removeClass("active");
                $(this).addClass("active");

                if (mode === "inline") {
                    $form.addClass("inline-input");
                } else {
                    $form.removeClass("inline-input");
                }
            });
        });
    </script>
