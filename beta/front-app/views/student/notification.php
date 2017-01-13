<div class="examList">
    <div class="wrap clear">
        <div class="outerDiv">
	    <div class="welcomeHeading clear"><h4 style="color: white;">Welcome <?php echo $this->session->userdata('student_name');?></h4>
	    <div class="points_section">
                <ul>
                    <li class="addPoints"><a href="<?php echo FRONTEND_URL.'payment'?>">Add Points</a></li>	
                    <li class="waletDiv"><?php echo $this->session->userdata('wallet_balance');?></li>
                </ul>
            </div>
            </div>
            <div class="innerDiv"><div class="innerInnerDiv">
        <div class="examTop">
            <ul class="clear">
                
                <li><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
		<li><a href="<?php echo FRONTEND_URL.'my_account/payment_history/';?>">My Payment History</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>" >Test</a></li>
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>

    <div class="full-width mid_con examBot">
        <div class="wrap clear">
            <h2 class="notification"> Notifications</h2>
            <div class="list_hd">
                <table>
                    <tr>
                        <th style="width: 5%;">SL#</th>
                        <th style="width: 10%;">Date</th>
                        <th style="width: 70%;">Notifications</th>
                        <th style="width: 15%;">Action</th>
                    </tr>
                    <?php
                    if(is_array($notification_list) && count($notification_list)>0)
                    {
                        foreach($notification_list as $index=>$value)
                        {
                        ?>          
                        <tr id="not_tr_<?php echo $value['id'];?>">
                            <td class="sl_no"><?php echo $index+1 ;?></td>
                            <td><?php echo date('d/m/Y',strtotime($value['added_on']));?></td>
                            <td><?php if(strlen($value['message'])>150)echo stripslashes(substr($value['message'],0,150)).'...';else echo stripslashes($value['message']);?></td>
                            <td>
                                <span class="delete" id="delete_<?php echo $value['id'];?>">Delete</span>
                                <span class="viewDetails" id="viewDetails_<?php echo $value['id'];?>">Details</span>
                            </td>
                        </tr>           
                        <?php
                        }
                    }
                    else {
                    ?>  
                    <tr>
                    <td style="text-align:center;color:red;" colspan="10"><?php echo '...No notification found!...' ;?></td>                    
                    </tr>
                    <?php 
                    } ?>        
                </table>
            </div>                    
        </div>
    </div>
    </div></div>
</div>
    </div></div>

<div style="display: none;" class="exam_details_popup">
    <div class="exam_details_nested_popup">
        <div class="exam_details_block"><span class="close_exam_details">Close</span>
</div>
    </div>
</div>
<script>
    $(document).on("click", '.delete', function(event) { 
        var notification_id = $(this).attr('id').replace('delete_','');
        $.ajax
	({
	    type: 'post',
	    data: {notification_id:notification_id},
	    url: '<?php echo FRONTEND_URL;?>examination/del_notification',
	    success: function(data)
	    {
                $('#not_tr_'+notification_id).remove();
                $( ".sl_no" ).each(function( index ) {
                    $( this ).html(parseInt(index)+1);
                  });
	    }       
	})     
    });
    $(document).on("click", '.viewDetails', function(event) { 
        var notification_id = $(this).attr('id').replace('viewDetails_','');
        $('.exam_details_block').html('<span class="close_exam_details">Close</span>');
        $.ajax
	({
	    type: 'post',
	    data: {notification_id:notification_id},
	    url: '<?php echo FRONTEND_URL;?>examination/view_notification',
	    success: function(data)
	    {
                newData  = jQuery.parseJSON(data);
                var html = '';
                html = html + '<div style="font-size: 22px;font-weight: bold;padding-left: 155px;">Message Details</div><div class="not_msg"><strong>Messege:</strong> '+newData['message']+'</div><div class="added_on" style="padding-top:5px;"><strong>Added On:</strong> '+newData['added_on']+'</div>';
                $('.close_exam_details').after(html);
                $('.exam_details_popup').css('display','block');
	    }       
	})     
    });
    $(document).on("click", '.close_exam_details', function(event) { 
        $('.exam_details_popup').css('display','none');
    });
</script>