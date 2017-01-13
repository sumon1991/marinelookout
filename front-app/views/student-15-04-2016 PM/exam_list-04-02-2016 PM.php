<div class="examList">
    <div class="wrap clear">
        <div class="examTop">
            <ul class="clear">
                <li class="active"><a href="<?php echo FRONTEND_URL.'my_account/result/';?>">Exam Result</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/profile/';?>">My Account</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/test/';?>">Test</a></li>
                <li><a href="<?php echo FRONTEND_URL.'my_account/notification/';?>">Notification</a></li>
            </ul>
        </div>
        <div class="examBot">
            <?php   if(is_array($question_list) && COUNT($question_list)>0){?>
            <h2>Exam Result</h2>
            <table>
                <tr>
                    <th>Paper</th>
                    <th>Paper Type</th>
                    <th>Exam Date</th>
                    <th>Exam Status</th>
                </tr>
                <?php
                    foreach($question_list as $v)
                    {
                ?>
                <tr>
                    <td><?php echo stripslashes($v['id'].' - '.$v['title'].' Examination');?></td>
                    <td><?php echo stripslashes($v['title']);?></td>
                    <td><?php echo date('d M Y',strtotime($v['added_on']));?></td>
                    <td><?php if($v['is_passed'] == 'No')echo 'Failed';else echo 'Passed';?></td>
                </tr>
                <?php
                    }
                ?>
            </table>
            <?php }else{?>
                <h2>No Exam Found</h2>
            <?php }?>
        </div>
    </div>
</div>