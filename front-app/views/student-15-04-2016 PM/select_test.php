<div class="examList">
    <div class="wrap clear">
        <?php 
        if(isset($errmsg) && trim($errmsg)!= '')
            {
            ?>
            <div align="center">
                <div class="note note-success" style="width:600px;color:red;font-size:17px;font-weight:normal;border:1px solid red;margin-top:15px;padding:5px;background:#ddf6e9;border-radius:3px; margin-bottom: 15px;">
                    <?php echo $errmsg; ?>
                </div>
            </div>
            <?php
            }
        ?>
        <div class="outerDiv">
            <div class="welcomeHeading"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4>
             <span class="waletDiv"><?php echo $this->session->userdata('wallet_balance');?></span></div>
            <div class="innerDiv"><div class="innerInnerDiv">
        <div class="examTop">
            <ul class="clear">
                
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/test/';?>">Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>
        <div class="examBot">
            <div class="answerUl">
                <ul>
        <?php
            if(isset($test_list) && is_array($test_list) && COUNT($test_list)>0)
            {
                foreach($test_list as $v)
                {
        ?>            
                <li><input type="radio" value="<?php echo stripslashes($v['subject_slug']);?>" name="test_name" class="answer_radio"> <span><?php echo stripslashes($v['title']);?></span></li>                 
        <?php }}?>
                </ul>   
            </div>
        <?php if(isset($test_list) && is_array($test_list) && COUNT($test_list)>0){ ?>
            <input type='button' name="start_test" id="start_test" value="Start Test"/>
        <?php }?>
        </div>
        </div></div>
        </div>
    </div>
</div>     
     

<script>
$('#start_test').click(function(){
    var checked_option = $("input[type='radio'][name='test_name']:checked").val();
    //alert(checked_option);
    if (checked_option == '' || typeof checked_option === "undefined")
        alert('Please select a subject to continue');
    else
        window.location.href = '<?php echo FRONTEND_URL.'examination/index/'?>'+checked_option+'/';
});
</script>
        
