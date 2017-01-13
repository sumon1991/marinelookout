     <?php


                                $succmsg  = $this->nsession->userdata('ERROR');


                                 if(isset($succmsg) && $succmsg != ""){ ?>
                                      <div align="center">
                                    <div class="alert alert-success">
                                      <p><?php echo stripslashes($succmsg);
                                        ;?>
                                      </p>
                                    </div>
                                      </div>
                                      <?php $this->nsession->unset_userdata('succmsg');} ?>    

    <form action="<?php echo BACKEND_URL.'login/do_login/' ?>" class="form form-validate-signin" method="post">
        
         <input type="hidden" name="action" value="login">
        <div class="header-content">
		<div style="text-align: center; border-bottom: 1px solid #ccc; padding-bottom: 10px;"><img src="<?php echo FRONTEND_URL.'images/logo.jpg'?>" alt="ePariksha" height="100" width="300"/></div>
		<!--<h1>Log In</h1>-->
	</div>
        <div class="body-content">
	          
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-user"></i>
			<input type="email" placeholder="Email" name="admin_email" class="form-control required email" value="">
            <div class="error"><?php echo form_error('admin_email'); ?></div>
		</div>
            </div>
            <div class="form-group">
                <div class="input-icon right"><i class="fa fa-key"></i><input type="password" placeholder="Password" name="password" class="form-control required password" value=""></div>
            </div>
            <div class="form-group pull-left">
               <!-- <div class="checkbox-list"><label><input type="checkbox">&nbsp;
                    Keep me signed in</label></div>-->
            </div>
            <div class="form-group pull-right">
                <button type="submit" class="btn btn-success">Log In
                    &nbsp;<i class="fa fa-chevron-circle-right"></i></button>
            </div>
            <div class="clearfix"></div>
	    <hr>
            <div class="forget-password"><h4>Forgotten your Password?</h4>

                <p>no worries, click <a href="<?php echo BACKEND_URL.'login/forgotpassword' ?>" class='btn-forgot-pwd'>here</a> to retrieve your password.</p>
	    </div>            
	</div>
    </form>