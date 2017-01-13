<!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
<!--END BACK TO TOP-->
<div id="header-topbar-option-demo" class="page-header-topbar">
    <nav id="topbar" role="navigation" style="margin-bottom: 0; z-index: 2;" class="navbar navbar-default navbar-static-top">
        <div class="navbar-header">
            <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a id="logo" href="<?php echo BACKEND_URL.'dashboard/'; ?>" class="navbar-brand">
                <span class="logo-text">
                <img src="" alt="ePariksha" style="width:50%;"/>
                </span>
                <span style="display: none" class="logo-text-icon">
                <img src="<?php echo BACKEND_IMAGE_PATH; ?>favicon.ico"/></span>
            </a>
        </div>

        <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
            <ul class="nav navbar navbar-top-links navbar-right mbn">
                <li class="dropdown topbar-user">
                    <a data-hover="dropdown" href="#" class="dropdown-toggle">
                    <img class="img-responsive img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($user_image) && $user_image!='' && file_exists($file_exists_link) ? $user_image : $default_user_image);?>" height="140" width="140">
                    <span class="hidden-xs">
                        <?php echo stripslashes($_SESSION['FIRST_NAME']).' '.stripslashes($_SESSION['LAST_NAME']);?>
                    </span>&nbsp;<span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-user pull-right">
                        <li><a href="<?php echo BACKEND_URL.'adminuser/profile/';?>"><i class="fa fa-user"></i>My Profile</a></li>
                        <li class="logoutAjax"><a href="#"><i class="fa fa-key"></i>Log Out</a></li>
                    </ul>
                </li>
                
                <li class="dropdown hidden-xs">
                  <a class="btn-fullscreen" title="FullScreen" href="javascript:void(0)"><i class="fa fa-arrows"></i><span class="submenu-title"></span></a>
                </li>
            </ul>

        </div>
    </nav>
</div>
<script>
    $('.logoutAjax').click(function(){
        $.ajax({
            type: "GET",
            url: "<?php echo FRONTEND_URL.'blog/wp-admin/admin-ajax.php?action=blogLogout';?>",
            data: {         
            },
           success: function(msg){
                //if (msg == true) {
                    window.location.href = "<?php echo BACKEND_URL.'dashboard/logout/'; ?>";
                //}                 
            }
        });
    });
</script>