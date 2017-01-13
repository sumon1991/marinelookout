 <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo (ucfirst($adminList[0]['role']));?>Profile</div>
    </div>
       
    <div class="clearfix"></div>
</div>


<?php //pr($adminList);?>

<!--BEGIN CONTENT-->
            <div class="page-content">
                <div id="page-user-profile" class="row">
                    <div class="col-md-12">
                        <?php if(validation_errors() != FALSE){?>
			<div align="center">
			    <div class="nNote nFailure" style="width: 600px;color:red;">
				<?php echo validation_errors('<p>', '</p>'); ?>
			    
			    </div>
			</div>
			<?php } ?>                                                   <?php //pr($adminList);?>
                        
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-center mbl">
                                                               
                            <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($user_image) && $user_image!='' && file_exists($file_exists_link) ? $user_image : $default_user_image);?>" height="140" width="140">
                                   </div>
                                </div>
                                
                                <table class="table table-striped table-hover">
                                    <tbody>
                                    <tr>
                                        <td>User Name</td>
                                        <td><?php echo stripslashes($adminList[0]['first_name']).' '.stripslashes($adminList[0]['last_name']);?></td>
					
					          
                                    </tr>
                                    <tr>
                                        <td width="50%">Email</td>
                                        <td>
					               <?php echo stripslashes($adminList[0]['admin_email']);?>
					
					               </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="50%">Status</td>
                                        <td>
                                            <?php
                                                if($adminList[0]['is_active']=='active')
                                                {
                                                ?>
                                                    <span class="label label-success">Active</span>
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <span class="label label-danger">Inactive</span>
                                                <?php
                                                }
                                                ?>
                                            
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td width="50%">Join Since</td>
                                        <?php
                                        
                                        $join_date=$adminList[0]['added_on'];
                                        $join_date1=explode(' ',$join_date);
                                        $join_date2=$join_date1[0];
                                        $join_date3=$join_date1[1];
                                        
                                        ?>
                                        <td><?php 
                                      
                                        $month=date("M",strtotime($join_date2));
                                        $day=date("d",strtotime($join_date2));
                                        $year=date("Y",strtotime($join_date2));
                                        echo $month.'  '.$day.' , '.$year;
                                        ?></td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-8">
                                <ul class="nav nav-tabs ul-edit responsive">
                                    
                                    <li class="active"><a href="#tab-edit" data-toggle="tab"><i class="fa fa-edit"></i>&nbsp;
                                        Edit Profile</a></li>
                                    
                                </ul>
                				<?php
                					    $profile_type = $this->uri->segment(3);
                				?>
                                <div id="generalTabContent" class="tab-content">

                                  <div id="tab-edit" class="tab-pane fade in active">
                                        <div class="row">
                                            <div class="col-md-9">
                                                <div class="tab-content">
                                                    <div id="tab-profile-setting" class="tab-pane fade <?php if(!isset($profile_type) || $profile_type == '' ) echo 'active in'; ?>">
                                                        <form action="<?php echo BACKEND_URL;?>adminuser/profile/" class="form-validate form-horizontal" method="post" enctype="multipart/form-data">
							                                 <input type="hidden" name="action" value="adminProfile"/>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">First Name</label>
                                                                    
                                                                <div class="col-sm-9 controls">
                                                                    <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control required first_name" value="<?php echo stripslashes($adminList[0]['first_name']);?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label">Last Name</label>

                                                                <div class="col-sm-9 controls">
                                                                    <input type="text" name="last_name" placeholder="Last Name" class="form-control required last_name"id="last_name" value="<?php echo stripslashes($adminList[0]['last_name']);?>"/>
                                                                </div>
                                                            </div>

                                                                                                   
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Password</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="password" id="password" name="password" placeholder="" class="form-control required password" value="<?php echo stripslashes($adminList[0]['password']);?>"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="col-sm-3 control-label">Confirm Password</label>

                                                                    <div class="col-sm-9 controls">
                                                                        <div class="row">
                                                                            <div class="col-xs-6">
                                                                                <input type="password" name="conf_password" id="conf_password" placeholder="" class="form-control required conf_password" value="<?php echo stripslashes($adminList[0]['password']);?>"/></div>
                                                                        </div>
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
                                                                <div class="form-group mbn">
                                                                    <label class="col-sm-3 control-label"></label>

                                                                    <div class="col-sm-9 controls">
                                                                        <button type="submit" id="account" class="btn btn-success"><i class="fa fa-save"></i>&nbsp;
                                                                            Save
                                                                        </button>
                                                                        &nbsp; &nbsp;<a href="<?php echo BACKEND_URL."dashboard/"?>" class="btn btn-default">Cancel</a></div>
                                                                </div>
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
                </div>
            </div>
<!--END CONTENT-->

<script>
  
    var  succ_msg = '<?php echo $succmsg; ?>';
    var  err_msg = '<?php echo $errmsg; ?>';
    
    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
</script>