<?php $plan_type = $this->uri->segment(5);?>
<nav id="sidebar" role="navigation" class="navbar-default navbar-static-side">
    <div class="sidebar-collapse menu-scroll">
        <ul id="side-menu" class="nav">
            <?php
                $currentController	= $this->router->class;
                $currentMethod	= $this->router->method;
                $page = $this->uri->segment(5);
                $role = $this->nsession->userdata('ROLE');
                //pr($_SESSION);
            ?>
            <li class="user-panel">
                <div class="thumb">
                    <img class="img-circle" style="border: 5px solid #fff; box-shadow: 0 2px 3px rgba(0,0,0,0.25);" src="<?php echo(isset($user_image) && $user_image!='' && file_exists($file_exists_link) ? $user_image : $default_user_image);?>">
                </div>
                <?php 
                     
                ?>
                <div class="info"><p><?PHP echo $_SESSION['FIRST_NAME'].'&nbsp;'.$_SESSION['LAST_NAME'];?></p>
                    <ul class="list-inline list-unstyled">
                        <li><a data-original-title="Profile" href="<?php echo BACKEND_URL.'adminuser/profile/';?>" data-hover="tooltip" title=""><i class="fa fa-user"></i></a></li>
                        <li><a data-original-title="Logout" href="<?php echo BACKEND_URL.'dashboard/logout/';?>" data-hover="tooltip" title=""><i class="fa fa-sign-out"></i></a></li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </li>

            <!-- Dashboard -->
            <?php if(($role=='admin') or (in_array(1,$permited_module))){?>
            <li class="<?php if($currentController=='dashboard' || $currentController=='profile' ) echo 'active'; ?>">
                <a href="<?php echo BACKEND_URL.'dashboard/';?>">
                    <i class="fa fa-dashboard">
                        <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Dashboard</span>
                   <!-- <span class="fa arrow"></span>-->
                    <span class="label label-yellow"></span>
                </a>
            </li>
            <?php }?>
            <?php if($role=='admin' or in_array(2,$permited_module)){?>
            <!-- Site Settings -->
            <li class="<?php if($currentController=='site_setting' ) echo 'active'; ?>">
                <a href="<?php echo BACKEND_URL.'site_setting/index/'; ?>">
                            <i class="fa fa-cogs">
                            <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Site Setting</span>
                </a>
            </li>
            <?php }?>
            <?php if($role=='admin' or in_array(9,$permited_module)){?>
            <!-- Site Settings -->
            <!--<li class="<?php //if($currentController=='permission' ) echo 'active'; ?>">
                <a href="<?php //echo BACKEND_URL.'permission/'; ?>">
                            <i class="fa fa-sitemap">
                            <div class="icon-bg bg-orange"></div>
                            </i>
                            <span class="menu-title">Permission</span>
                </a>
            </li>-->
            <?php }?>
            
            <?php if( $role=='admin' or  (in_array(3,$permited_module) || in_array(4,$permited_module) || in_array(5,$permited_module))){?>
            <!-- User Management -->
            <li class="<?php if(($currentController == 'adminuser') || $currentController == 'editor' || $currentController=='studentuser' || $currentController== 'examination' ) echo 'active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-user">
                        <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">User Management</span>
                    <span class="fa arrow"></span>
                    <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">
                    <?php if($role=='admin' or  in_array(3,$permited_module)){ ?>
                    <!-- <li class="<?php if(($currentController == 'adminuser')) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'adminuser/index/';?>">
                            <i class="fa fa-user"></i>
                            <span class="submenu-title">Admin User</span>
                        </a>
                    </li> -->
                    <?php }?>
                    <?php if($role=='admin' or  in_array(4,$permited_module)){ ?>
                    <li class="<?php if(($currentController == 'editor')) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'editor/all/';?>">
                            <i class="fa fa-user"></i>
                            <span class="submenu-title">Editor User</span>
                        </a>
                    </li>
                    <?php }?>
                    <?php if($role=='admin' or in_array(5,$permited_module)){ ?>
                    <li class="<?php if($currentController =='studentuser' || $currentController =='examination') echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'studentuser/index/';?>">
                            <i class="fa fa-user"></i>
                            <span class="submenu-title">Student User</span>
                        </a>
                   </li>
                   <?php }?>
                   <?php if($role=='admin' or  in_array(4,$permited_module)){ ?>
                    <li class="<?php if(($currentController == 'teammember')) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'teammember/all/';?>">
                            <i class="fa fa-user"></i>
                            <span class="submenu-title">Team Members</span>
                        </a>
                    </li>
                    <?php }?>
                </ul>
            </li>
            <?php }?>
            <?php if($role=='admin' or  (in_array(6,$permited_module) || in_array(7,$permited_module))){?>
            <!-- Question & Answer Management -->
            <li class="<?php if($currentController =='subject' || $currentController =='questionans'  || $currentController =='attempt_test' ) echo 'active'; ?>">
                <a href="javascript:void(0);">
                    <i class="fa fa-question">
                        <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Q & A Management</span>
                    <span class="fa arrow"></span>
                    <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level" style="">
                    <?php if($role=='admin' or  in_array(6,$permited_module)){ ?>
                    <li class="<?php if(($currentController =='subject') && ($currentMethod=='all' || $currentMethod=='add' ||  $currentMethod =='delete' || $currentMethod =='edit') ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'subject/all/';?>">
                            <i class="fa fa-circle-o"></i>
                            <span class="submenu-title">Subject</span>
                        </a>
                    </li>
                    <?php }?>
                    
                    <?php if($role=='admin' or in_array(6,$permited_module)){ ?>
                    <li class="<?php if( $currentController =='attempt_test' ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'attempt_test/';?>">
                            <i class="fa fa-check"></i>
                            <span class="submenu-title">Examination(Total attempts)</span>
                        </a>
                    </li>
                    <?php }?>
                       <?php if($role=='admin' or in_array(7,$permited_module)){ ?>
                    <li class="<?php if(($currentController =='questionans') && ($currentMethod=='listing' || $currentMethod=='add' || $currentMethod=='edit') ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'questionans/listing/';?>">
                            <i class="fa fa-question"></i>
                            <span class="submenu-title">Question & Answer</span>
                        </a>
                    </li>
                    <!-- <li class="<?php if(($currentController =='questionans') && ($currentMethod=='sample_listing' || $currentMethod=='sample_add' || $currentMethod=='sample_edit') ) echo 'active'; ?>">
                        <a href="<?php echo BACKEND_URL.'questionans/sample_listing/';?>">
                            <i class="fa fa-question"></i>
                            <span class="submenu-title">Sample Question & Answer</span>
                        </a>
                    </li> -->
                    <?php }?>
                 
                </ul>
            </li>
            
            <?php }?>

           
             <li class='<?php if($currentController=='payment') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'payment/index/'?>" >
                    <i class="fa fa-file">
                    <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Payment</span>
                    <span class="label label-yellow"></span>
                </a>                               
            </li>
            <?php if($role=='admin' or in_array(8,$permited_module)){?>
            <!-- CMS -->
            <li class='<?php if($currentController=='cms' || $currentController=='notice' || $currentController=='notification' || $currentController=='quick_links'  || $currentController=='testimonial') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'cms/index/'?>">
                    <i class="fa fa-file">
                    <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">CMS</span>
                    <span class="fa arrow"></span>
                    <span class="label label-yellow"></span>
                </a>
                <ul class="nav nav-second-level">                   
                    <li class="<?php if($currentController=='cms' && ($currentMethod=='index' || $currentMethod=='add_cms' || $currentMethod=='edit_cms'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cms/index/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">CMS Pages</span></a>
                    </li>
                    <li class="<?php if($currentController=='notice' && ($currentMethod=='index' || $currentMethod=='add_notice' || $currentMethod=='edit_notice'|| $currentMethod=='list_notice'))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'notice/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">Notice</span></a>
                    </li>
                    <li class="<?php if($currentController=='notification')echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'notification/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">Notification</span></a>
                    </li> 
                    <li class="<?php if($currentController=='quick_links')echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'quick_links/'?>"><i class="fa fa-external-link"></i>
                            <span class="submenu-title">Quick Links</span></a>
                    </li> 
                    <li class="<?php if($currentController=='testimonial')echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'testimonial/'?>"><i class="fa fa-quote-left"></i>
                            <span class="submenu-title">Testimonial</span></a>
                    </li>
                    <li class="<?php if($currentController=='cms' && ($currentMethod=='shortdescription' ))echo 'active'; ?>">
                            <a href="<?php echo BACKEND_URL.'cms/shortdescription/'?>"><i class="fa fa-file"></i>
                            <span class="submenu-title">Short Description</span></a>
                    </li>  
                </ul>
                
            </li>
            <?php }?>
            <li class='<?php if($currentController=='subscription') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'subscription/index/'?>">
                    <i class="fa fa-file">
                    <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Subscription</span>
                    <span class="label label-yellow"></span>
                </a>                               
            </li> 
            <?php if($role=='admin' or in_array(11,$permited_module)){?>
                <li class='<?php if($currentController=='advertisement') echo 'active'; ?>'>
                    <a href="<?php echo BACKEND_URL.'advertisement/index/'?>">
                        <i class="fa fa-file">
                        <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Advertisement Management</span>
                        <span class="label label-yellow"></span>
                    </a>                               
                </li>
            <?php } ?>
            
            <li class='<?php if($currentController=='passageplan') echo 'active'; ?>'>
                <a href="<?php echo BACKEND_URL.'passageplan/index/'?>">
                    <i class="fa fa-file">
                    <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Passage Planing</span>
                    <span class="label label-yellow"></span>
                </a>                               
            </li>

            <?php if($role=='admin' or in_array(15,$permited_module)){?>
                <li class='<?php if($currentController=='contentimages') echo 'active'; ?>'>
                    <a href="<?php echo BACKEND_URL.'contentimages/index/'?>">
                        <i class="fa fa-file">
                        <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Content Images</span>
                        <span class="label label-yellow"></span>
                    </a>                               
                </li>
            <?php } ?>
            <?php //pr($permited_module) ?>
            <?php if($role=='admin' or in_array(16,$permited_module) or in_array(14,$permited_module)){?>
                <li class='<?php if($currentController=='blog' || $currentController=='blogpost') echo 'active'; ?>'>
                    <a href="<?php //echo FRONTEND_URL.'blog/admin/'?>" >
                        <i class="fa fa-file">
                        <div class="icon-bg bg-pink"></div>
                        </i>
                        <span class="menu-title">Blog</span>
                         <span class="fa arrow"></span>
                        <span class="label label-yellow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <?php if($role=='admin' or in_array(14,$permited_module)){?>
                            <li class="<?php if($currentController=='blog' && ($currentMethod=='category_list' || $currentMethod=='category_add' || $currentMethod=='category_edit'))echo 'active'; ?>">
                                <a href="<?php echo BACKEND_URL.'blog/category_list/'?>">
                                    <i class="fa fa-list">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                                    <span class="menu-title">Category</span>
                                    <span class="label label-yellow"></span>
                                </a> 
                            </li>
                            <li class="<?php if($currentController=='blog' && ($currentMethod=='author_list' || $currentMethod=='author_edit' || $currentMethod=='author_add'))echo 'active'; ?>">
                                <a href="<?php echo BACKEND_URL.'blog/author_list/'?>">
                                    <i class="fa fa-user">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                                    <span class="menu-title">Author</span>
                                    <span class="label label-yellow"></span>
                                </a> 
                            </li>
                        <?php } ?>
                        <?php if($role=='admin' or in_array(16,$permited_module)){?>
                            <li class='<?php if($currentController=='blogpost') echo 'active'; ?>'> 
                                <a href="<?php echo BACKEND_URL.'blogpost/'?>">
                                    <i class="fa fa-file">
                                    <div class="icon-bg bg-pink"></div>
                                    </i>
                                    <span class="menu-title">Posts</span>
                                    <span class="label label-yellow"></span>
                                </a> 
                            </li>
                        <?php } ?>
                    </ul>
                </li>
            <?php } ?>
          <?php //if(in_array(12,$permited_module)){?>
            <!--<li class='<?php //if($currentController=='exam') echo 'active'; ?>'>
                <a href="<?php //echo BACKEND_URL.'exam/index/'?>">
                    <i class="fa fa-file">
                    <div class="icon-bg bg-pink"></div>
                    </i>
                    <span class="menu-title">Examination</span>
                    <span class="label label-yellow"></span>
                </a>                               
            </li>-->
            <?php //}?>
        </ul>
    </div>
</nav>
<script>
    /*/$('.blogLink').click(function(){
        $.ajax({
            type: "GET",
            url: "<?php echo FRONTEND_URL.'blog/wp-admin/admin-ajax.php?action=blogLogin&username='.$this->nsession->userdata('ADMIN_EMAIL').'&password='.$this->nsession->userdata('ADMIN_PASSWORD').'&email='.$this->nsession->userdata('ADMIN_EMAIL');?>",
            data: {         
            },
           success: function(msg){
                if (msg == 'true') {
                    //window.location.href = "<?php echo FRONTEND_URL;?>blog/wp-admin/";
                    window.open("<?php echo FRONTEND_URL;?>blog/wp-admin/", '_blank');
                }
                else
                    alert('You dont have permission to access the page.');                
            }
        });
    });*/
</script>