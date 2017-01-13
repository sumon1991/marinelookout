<?php
    $currentController  = $this->router->class;
    $currentMethod  = $this->router->method;
    $page = $this->uri->segment(1);
?>


	    <div class="site-header">
			<!--banner-->
			<div class="banner">
				<div class="wrap clear">
					<div class="banner_lft">
					<h2>We provide a platform for </h2>
					<h3>Budding and </br> Established Mariners
					</h3>
					<a href="<?php if($this->session->userdata('student_id')!= '')echo FRONTEND_URL."my_account/result/";else echo FRONTEND_URL."home/sign_up/";?>"> Give your Exam Now </a>
					</div>
					<div class="banner_rt">
			<div class="owl-carousel3 owl-theme" id="owl-demo">
			 <div class="item"><img src="<?php echo FRONTEND_IMAGES;?>banner_rt.png" alt=""/></div>
			 <div class="item"><img src="<?php echo FRONTEND_IMAGES;?>banner_rt.png" alt=""/></div>
			 <div class="item"><img src="<?php echo FRONTEND_IMAGES;?>banner_rt.png" alt=""/></div>
			 <div class="item"><img src="<?php echo FRONTEND_IMAGES;?>banner_rt.png" alt=""/></div>
			</div>
		</div>
				</div>
			<!--/banner-->
			
			</div>
			<div class="full-width header_btm">
				<div class="wrap clear">
					<a class="logo" href="<?php echo FRONTEND_URL;?>"> <img src="<?php echo FRONTEND_IMAGES;?>logo.jpg" alt=""/> </a>
					<div class="navbar" id="navbar">
			<nav role="navigation" class="navigation main-navigation" id="site-navigation">
				<button class="menu-toggle"></button>
				 
				<div class="nav-menu" id="primary-menu">
										
					<ul>	<li class="<?php echo($currentController=='home' && $currentMethod=='index' ?'active':'');?>"><a href="<?php echo FRONTEND_URL;?>">HOME</a></li>
						<li class="<?php echo($page=='about-us'?'active':'');?>"><a href="<?php echo FRONTEND_URL."about-us/";?>">ABOUT</a></li>
						<li><a href="<?php echo FRONTEND_URL."blog/";?>">BLOG</a></li>
						<li class="<?php echo($currentController=='my_account'?'active':'');?>"><a href="<?php if($this->session->userdata('student_id')!= '')echo FRONTEND_URL."my_account/result/";else echo FRONTEND_URL."home/sign_up/";?>">ePARIKSHA</a></li>
						<li class="<?php echo($page=='contact-us'?'active':'');?>"><a href="<?php echo FRONTEND_URL."contact-us/";?>">CONTACT US </a></li>
					</ul>  
										
				</div>
							
			</nav><!-- #site-navigation -->
															
														   
		</div>
					 <div class="right_link">
			<ul>
			<li>
			<?php if($this->session->userdata('student_id')== ''){ ?>
				<a href="<?php echo FRONTEND_URL;?>home/sign_up/student">Login</a>
			<?php }else{?>
				<a href="#<?php //echo FRONTEND_URL.'home/logout/'?>" class="logout">Logout</a>
			<?php }?>
			</li>								    
			<li>
			<?php if($this->session->userdata('student_id')== ''){ ?>
				<a href="<?php echo FRONTEND_URL.'home/sign_up/'?>">Create Account</a>
			<?php }else{?>
				<a href="<?php echo FRONTEND_URL.'my_account/profile/'?>" class="logout">Profile</a>
			<?php }?>
			</li>			    
			</ul>
		</div>
				</div>
				
				
			</div>
		</div>
<div class="parentSignIn" style="display: none;">	
<div class="sign_in" title="Student Login Form" >
	<span class="closePopup">Close</span>
	<!--<h2> Student Login Form </h2> -->	
	 			
</div>
</div>

<div class="parentForgot" style="display: none;">	
<div class="sign_in" title="Student forgot Form" >
	<span class="closePopup">Close</span>
	<!--<h2> Student Login Form </h2> -->	
				
</div>
</div>


<script>
    $('#email,#password').keypress(function(e) {
	if(e.which == 13) {
	    $("#submit_login").trigger( "click" );
	}
    });
    $('#submit_login').click(function(){
	var email 	= $('#email').val();
	var password 	= $('#password').val();
	var action 	= $('#action').val();
	$.ajax
	({
	    type: 'post',
	    data: {email:email,password:password,action:action},
	    url: '<?php echo FRONTEND_URL;?>home/login/',
	    success: function(data)
	    {
		if (data == 0)
		    $('.error_login').html('Wrong username or password');
		else if(data == 2)
		    $('.error_login').html("Your acount isn't activated");
		else
		    window.location.href = '<?php echo FRONTEND_URL;?>my_account/result/';
	    }       
	})
    });

    $('#getPassword').click(function(){
	var email 	= $('#forgot_email').val();
	var action 	= $('#forgot_action').val();
	$.ajax
	({
	    type: 'post',
	    data: {email:email,action:action},
	    url: '<?php echo FRONTEND_URL;?>home/do_forgotpassword',
	    success: function(data)
	    {
		if (data == 1)
		    $('.forgot_login_error').css('color','green').html('Password sent to your mail address. Please check.');
		else
		    $('.forgot_login_error').css('color','red').html(data);
	    }       
	})
    });

    $(function() {
    $('.parentSignIn').css('display','none');
  });
    
    $('.login').click(function(){
	$('.parentSignIn').css('display','block');
    });
    $('.closePopup,#cancel').click(function(){
	$('.parentSignIn').css('display','none');
    });
</script>
<script>
    $(function() {
    $('.parentForgot').css('display','none');
  });
    $(document).on('click','.forgot',function(){
    	$('.parentSignIn').css('display','none');
    	$('.parentForgot').css('display','block');
    });
 //    $('.forgot').click(function(){
 //    	$('.parentSignIn').css('display','none');
	// $('.parentForgot').css('display','block');
 //    });
    $('.closePopup').click(function(){
	$('.parentForgot').css('display','none');
    });
    
    $('.logout').click(function(){
        $.ajax({
            type: "GET",
            url: "<?php echo FRONTEND_URL.'blog/wp-admin/admin-ajax.php?action=blogLogout';?>",
            data: {         
            },
           success: function(msg){
                //if (msg == true) {
                    window.location.href = "<?php echo FRONTEND_URL.'home/logout/'?>";
                //}                 
            }
        });
    });
</script>