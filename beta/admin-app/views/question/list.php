
<?php
	$currentController	= $this->router->class;
	$currentMethod	= $this->router->method;
	$page = $this->uri->segment(5);
	//pr($_SESSION);
?>
<!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Subject Listing</div>
    </div>
<!--For breadcrump-->    

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
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="table-container">                                              
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
						<tr>
						    <th style="width: 10%;">Subject Name</th>                                                  
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                <?php
                                                if(isset($subject_list) && is_array($subject_list) && count($subject_list)>0)
						{
						   for($i=0; $i<count($subject_list); $i++){
                                                ?>  
						   <tr class="<?=($i%2==0?'even':'odd');?>">
						    <td class="subjectTd" id="<?php echo $subject_list[$i]['id'];?>"><?php echo stripslashes($subject_list[$i]['title']);?></td>
						   </tr>
					     <?php } } else {  ?>
						      <tr><td colspan="8">..::..No records found..::..</td></tr>
						      <tr><td colspan="8">&nbsp;</td></tr>                
						  <?php } ?>
                                                </tbody>
                                                </table>
				       </div>
                                    </div>
                                </div>
                            </div>
                       </div>
                    </div>
                </div>
            </div>

<input type="hidden" name="selected_sub" id="selected_sub"/>

<div style="display: none;" class="parentSignIn">
   <div class="overlay"></div>   
   <div class="sign_in">
      <!--<div class="heading">Please select the group</div>-->
	 <select class="subjectClass" name="subjectClass" id="subjectClass">
	    <option>Please select the group</option><option>A</option><option>B</option>
	 </select>
   </div>
</div>
<script>
$('.subjectTd').click(function(){
   $('#selected_sub').val($(this).attr('id'));
   $('.parentSignIn').css('display','block');   
});
$('.subjectClass').change(function(){
	<?php if($currentMethod == 'sample_listing'){ ?>
	redirect_url = '<?php echo BACKEND_URL;?>'+'questionans/sample_add/'+$('#selected_sub').val()+'/'+$('#subjectClass').val()+'/';
	<?php }else{ ?>
	redirect_url = '<?php echo BACKEND_URL;?>'+'questionans/add/'+$('#selected_sub').val()+'/'+$('#subjectClass').val()+'/';
	<?php } ?>
   
   window.location.href = redirect_url;
});

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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->