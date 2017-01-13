<style>
                /*----------- 9.02.2016 ---------------*/
.form-control{border: none; margin: 5px 0;}
.answer_div ul, .options{ margin: 0; padding: 0; list-style: none;}
.question_section.clear{clear: both;padding: 20;padding-top: 20px;}
.question_section h4{ color: #00aeff; margin: 0; padding: 0 0 5px; font-weight: 400; font-size: 18px;}
.answer_div li{ padding: 0 1% 5px; width: 48%; float: left;}
.exam_details_block { overflow-y: auto; height: 100%;}
.question_section{ padding-bottom: 20px;}
.answer_div ul .correct { color:green;}
.answer_div ul .user_given{color:red;}
.answer_div ul .correct.user_given{ color:#AA3ed2;}
.exam_details_block .form-control{ margin-bottom: 10px;}
.rightAns em{ background: green; width: 10px; height: 10px; display: inline-block; margin: 0 5px 0 0;}
.wrongAns em{ background: red; width: 10px; height: 10px; display: inline-block; margin: 0 5px 0 0;}
.userAns em{ background: #AA3ed2; width: 10px; height: 10px; display: inline-block; margin: 0 5px 0 0;}
.options li{ display: inline-block;font-size: 14px; padding: 0 1% 5px;}
.various3 {display: block; margin: 0 0 3px; width: 100%;}
.btn-info, .label-warning, .btn-danger{width: 100%; display: block; padding: 5px 0;}
</style>
 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
            
        
    </div>
    <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content">
                <div id="table-action" class="row">
                    <div class="col-lg-12">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                              
                                    <!-- Start : main content loads from here -->   
    <div class="col-lg-12">
                                                    
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."examination/index/0/0/".$studentId;?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Back To List</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                    
                                
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Exam Details</h4>

                                        <div class="table-container">
                                            
                                            
                                           <div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                           
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%;" data-toggle="true">Subject Name:</th>
                                                    <th style="width: 10%;" data-toggle="true">Given On:</th>
                                                    <th style="width: 10%;" data-toggle="true">Score:</th>
                                                    <!--<th style="width: 10%;" data-toggle="true">Passed:</th>-->
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                          <?php
      
                            if(isset($exam_details) && is_array($exam_details) && count($exam_details)>0){
                            //pr($exam_details);
                           ?>
          
                         <tr>
                          <td><?php echo stripslashes($exam_details[0]['title']);?></td>
                          <td><?php echo date('d/m/Y H:i:s',strtotime($exam_details[0]['added_on']));?></td>
            <td><?php echo $exam_details[0]['total_score'].' Out Of '.$exam_details[0]['totalQuestion'];?></td>
                          <!--<td><?php //echo $exam_details[0]['is_passed'];?></td>-->
                        </tr>
                        <?php   } else {  ?>
                            <tr><td colspan="10">..::..No records found..::..</td></tr>
                            <tr><td colspan="10">&nbsp;</td></tr>                
                        <?php } ?>
                      </tbody>
                      
                                                </table>
    <div class="form-control">
	<ul class="options">
	    <li class="rightAns"><em></em>Right answer</li>
	    <li class="wrongAns"><em></em>User given wrong answer</li>
	    <li class="userAns"><em></em>User given right answer</li>
	</ul>
    </div>
    <div class="form-control">
    <?php
    if(is_array($exam_details[0]['question_answer_details']) && COUNT($exam_details[0]['question_answer_details'])>0)
    {
	//pr($exam_details);
	foreach($exam_details[0]['question_answer_details'] as $v)
	{
    ?>
	<div class="question_section clear">
	    <?php
	    if($v['question_type'] == 'Image'){
	    ?>
		<img src="<?php echo FILE_UPLOAD_URL.'question/'.$v['image'];?>" class="question_image"/>	    
	    <?php }?>
	    <h4><?php echo stripslashes($v['title']);?></h4>
	    <div class="answer_div">
		<ul>
		    <?php foreach($v['answer_list'] as $x){?>		    
			<li class="<?php if($x['is_correct'] == 'Yes')echo "correct";?> <?php if($x['id'] == $v['user_given_answer'])echo "user_given";?>"><?php echo stripslashes($x['title']);?></li>
		    <?php }?>
		</ul>
	    </div>
	</div>    
    <?php
	}
    }
    ?>
    </div>
                                            <div class="row mbl">
                                                
                                             
                                            </div>
                                         
                                                
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
                
            </div>
            
            
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
    
    function searchValidation()
    {
        if ( $("#search_keyword").val() == '')
        {
           alert("Search field cant not be empty!");
           $("#search_keyword").css('border-color','red');
           $("#search_keyword").focus();
           return false;
        }
        return true;    
    }
    $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#perPageFrm').attr('action','<?php echo BACKEND_URL."examination/index/0/0/".$student_id;?>');    
  });

</script>






