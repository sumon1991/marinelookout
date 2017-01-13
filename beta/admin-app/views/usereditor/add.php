 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Add Editor</div>
    </div>
 <!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot    =   count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
    <?php if($tot != $k+1)
        echo "&nbsp;>&nbsp;";
    ?>
      </li>
    <?php }}?>
  </ol> -->  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->



<?php 
//pr($studentList);
//pr($_SESSION);
?>
<!--BEGIN CONTENT-->
        <div class="page-content">
        <div id="form-layouts" class="row">
        <div class="col-lg-12">
         <div style="background: transparent; border: 0; box-shadow: none !important;" class="pan mtl mbn responsive">
                            <div id="tab-form-seperated" class="tab-pane">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                       
                                        <!-- Display Success Message -->
                            <?php if(isset($succmsg) && $succmsg != ""){?>
                            <div align="center">
                                <div class="nNote nSuccess" style="width: 600px;color:green;">
                                    <p><?php echo stripslashes($succmsg);?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- Display Error Message -->
                            <?php if(isset($errmsg) && $errmsg != ""){ ?>
                            <div align="center">
                                <div class="nNote nFailure">
                                    <p style="font-weight:bold; color:red;"><?php echo stripslashes($errmsg);?></p>
                                </div>
                            </div>
                            <?php } ?>
                            <!-- Display Validation Message -->
                            <?php if(validation_errors() != FALSE){?>
                            <div align="center">
                                <div class="nNote nFailure" style="width: 600px;color:red;">
                                    <?php echo validation_errors('<p>', '</p>'); ?>
                                
                                </div>
                            </div>
                            <?php } ?>
                                        
                                        <div class="panel panel-yellow portlet box portlet-yellow">
                                            <!--<div class="panel-heading">Admin User Form</div>-->
                                            <div class="portlet-header">
                                                    <div class="caption">Add Editor</div>
                                                    <div class="tools">
                                                        <i class="fa fa-chevron-up"></i>
                                                    </div>
                                            </div>
                                            <div class="portlet-body panel-body pan">
                                                
                                                <form method="post" action="<?php echo BACKEND_URL;?>editor/add/" class="form-validate form-horizontal form-seperated " enctype="multipart/form-data" id="add_form">
                                                  <input type="hidden" name="action" value="add">
                                                    <div class="form-body">

                                                        <!-- Firstname -->
                                                        <div class="form-group"><label for="firstname" class="col-md-3 control-label">First Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input name="firstname" type="text" placeholder="First Name" class="form-control required firstname" id="firstname" value="<?php echo set_value('firstname'); ?>"/>
                                                            </div>
                                                        </div>

                                                        <!-- Last Name -->
                                                        <div class="form-group"><label for="lastname" class="col-md-3 control-label">Last Name <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                
                                                                    <input name="lastname" type="text" placeholder="Last Name" class="form-control required lastname" id="lastname" value="<?php echo set_value('lastname'); ?>"/>
                                    
                                                            </div>
                                                        </div>

                                                        <!-- Email -->
                                                        <div class="form-group"><label for="email" class="col-md-3 control-label">Email <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <div class="input-icon"><i class="fa fa-envelope"></i>
                                                                    <input type="text" id="email" name="email"  placeholder="Email Address" class="form-control required email" data-type="email" value="<?php echo set_value('email'); ?>"/>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Password -->
                                                        <div class="form-group"><label for="password" class="col-md-3 control-label">Password <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input type="password" name="password" id="password" class="form-control required password"  placeholder="Password" value="<?php echo set_value('password'); ?>">
                                                            </div>
                                                        </div>

                                                        <!-- Confirm Password -->
                                                        <div class="form-group"><label for="password_repeat" class="col-md-3 control-label">Repeat Password <span class='require'>*</span></label>

                                                            <div class="col-md-6">
                                                                <input type="password" name="conf_password" id="conf_password"  class="form-control required conf_password"  data-equalto="#password" placeholder="Repeat Password" value="<?php echo set_value('conf_password'); ?>">
                                                            </div>
                                                        </div>
                                                        
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Image Upload</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="file" name="userfile" id="userfile"  value=""/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <!-- Status -->                        
                                                        <div class="form-group">
                                                            <label for="status" class="col-md-3 control-label">Status <span class='require'>*</span></label>
                                                            <div class="col-md-4">
                                                                <select data-required="true" name="status" id="status" class="form-control required status">
                                                                    <option value="">--Select Status--</option>
                                                                    <option value="active">Active</option> 
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group"><label for="cms_title" class="col-md-3 control-label">Menu <span class='require'>*</span></label>
                                                            <div class="col-md-9">
                                                                 <?php foreach($menu_list as $x){?>
								    <div><input type="checkbox" name="menu[]" value="<?php echo $x['id'];?>"/>  &nbsp;&nbsp;&nbsp;&nbsp;<?php echo stripslashes($x['title']);?></div>
                                                                <?php }?>
                                                            </div>
                                                        </div>                                                        
                                                        
                                                    <div class="form-actions text-right pal">
                                                        <button type="button" class="btn btn-primary" id="add_editor">Add Editor</button>
                                                        &nbsp;
                                                        <button type="button" class="btn btn-green" onclick="location.href='<?php echo BACKEND_URL;?>editor/all/'">Return</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
         </div>
        </div>
        </div>
        </div>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->
<script>
function name()
{
    
}

$('#add_editor').click(function(){
    var username = $('#email').val();
    var password = $('#password').val();
    var email    = $('#email').val();
    if (username != '' && password!= '' && email!= '')
    {
        $.ajax({
            type: "GET",
            url: "<?php echo FRONTEND_URL;?>blog/wp-admin/admin-ajax.php",
            data: { action:'blogCreateUser',username:''+username+'',password:password,email:''+email+''},
           success: function(msg){
                if (msg!=0 && msg != false) {
                    $('#add_form').submit();
                    return true;
                    return false;
                }
                else
                {
                    alert('Unable to add editor....');
                    return false;
                }
            },
            error: function() {
                alert('Unable to add editor....');
                return false;
            }
        });
    }
    else
        return false;
});
</script>