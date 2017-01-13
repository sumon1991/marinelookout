 <?php
 //pr($questionList);
 //echo pr($subjectSlug);die;
 ?>
 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title"><?php echo $subjectSlug[0]['title']; ?> &nbsp;Question Listing</div>
    </div>
 <!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  --> 
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
                                    <div class="col-lg-12"><h4 class="box-heading">Question Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="POST" action="<?php echo BACKEND_URL."subject_list/listing_sub/".$subjectSlug[0]['subject_slug'];?>">
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                    
                                                    <input type="text" id="search_keyword" name="search_keyword" placeholder="Enter here..." class="form-control" value="<?php echo $search_keyword; ?>" />
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-success" onclick="return searchValidation();">Search</button>
                                                    </span>
                                                    </div>
                                                </div>
						<div class="col-lg-6">
							<div class="tb-group-actions"><span>Select Group</span>
							<select class="form-control input-inline input-small input-sm mlm" name="select_group" id="select_group">
							    <option value="" <?php if($group == '')echo "selected";?>>All</option>
							    <option value="A" <?php if($group == 'A')echo "selected";?>>A</option>
							    <option value="B" <?php if($group == 'B')echo "selected";?>>B</option>
							</select>
							    
							</div>
						</div> 
                                                <div class="col-lg-6">
                                                    <button class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>
                                                    
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."questionans/add/".$subjectSlug[0]['subject_slug'];?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Question and Answer</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                            </div>

                                            </form>
                                            
                                            <?php
                                            $show_to_record     = $startRecord + $per_page;
                                            $to_record		    = $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record    = $totalRecord;
                                            }
                                           // error_reporting(0);
                                            ?>
                                           
                                            <!-- <div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        <span class="showRecCount">Showing <?php //echo $startRecord+1; ?> to <?php //echo $to_record; ?></span> | Found total <?php //echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php //echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
                                            </div> -->

                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."subject_list/batch_action/";?>" method="post">                                            
                                            <input type="hidden" name="redirect_url" id="redirect_url" value="<?php echo BACKEND_URL."subject_list/listing_sub/".$subjectSlug[0]['subject_slug'];?>" />  
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
       <?php //pr($questionList);?>                                         <tr>
                                                     <!--Check All:--> <th style="width: 3%;"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                    <th style="width: 30%;">Image </th>                                                  
                                                    <th style="width: 30%;">Question Title</th>
                                                    <th style="width: 3%;">Group</th>
                                                    <th style="width: 5%;">Status</th>
                                                    <th style="width: 7%;">Added On</th>
                                                    <th style="width: 15%;">Actions</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                <input type="hidden" id="questionList" name="questionList" value="<?php echo(isset($questionList[0]['id']) && is_array($questionList[0]['id']) ? $questionList[0]['id'] : '');?>">
                                                <?php

                                                //pr($questionList);
                                                if(isset($questionList) && is_array($questionList) && count($questionList)>0)
                                              {
                                                for($i=0; $i<count($questionList); $i++){
                                                    //pr($questionList);
                                                ?>  
                            <tr class="<?=($i%2==0?'even':'odd');?> getcatgory<?php echo $questionList[$i]['group']; ?>">
                                 <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $questionList[$i]['id'];?>" /></td> 
                                
            <td>
                <img src="<?php echo(isset($questionList[$i]['image']) && $questionList[$i]['image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."question/".$questionList[$i]['image']) ? BACKEND_IMAGE_PATH."question/".$questionList[$i]['image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" alt="No Image" height="70" width="90"/></td>
                    
		    
             <td><?php echo stripslashes($questionList[$i]['title']);?></td>
                              
                                <td><?php echo stripslashes($questionList[$i]['group']);?></td>
                                <td align="center"><?php if($questionList[$i]['is_active']=='yes'){  echo '<label class="label label-green">'. 'Active';  }else{  echo '<label class="label label-red">'. 'Inactive'; } ?></label></td>                          
                                <td>
                                <?php echo @date("d/m/Y H:i:s", strtotime($questionList[$i]['added_on']));?>
                                </td>
                                <td>
                                    <a href="<?php echo $questionList[$i]['edit_link'];?>" class="tablectrl_small bDefault tipS" title="Edit">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                        Edit 
                                    </button>
                                    </a>
                                     &nbsp;
                                    <a href="<?php echo $questionList[$i]['delete_link'];?>" class="tablectrl_small bDefault tipS" title="Delete" onclick="return confirm('Do you want to delete?');">
                                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                        Delete
                                    </button>
                                    </a>
                                                                                            
                                </td> 
                        </tr>
                        <?php } } else {  ?>
                            <tr><td colspan="8">..::..No records found..::..</td></tr>
                            <tr><td colspan="8">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                                
                                            <div class="row mbl">
                                                
						<div class="col-lg-6">
						   <div class="tb-group-actions"><span>Apply Action:</span>
						   <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
						       <option value="">Select...</option>
						       <option value="active">Active</option>
						       <option value="inactive">Inactive</option>
						       <option value="Delete">Delete</option>
						   </select>
						       
						   </div>
					       </div> 
                                            </div>
                                            </form>
                                            <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                       <!-- Page
                                                        &nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-left"></i></a>&nbsp;<input type="text" maxlenght="5" value="<?php //echo $startRecord+1; ?>" class="pagination-panel-input form-control input-mini input-inline input-sm text-center"/>&nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-right"></i></a>&nbsp;
                                                        of <?php //echo $to_record; ?> | -->
                                                        
                                                        <!--<span class="showRecCount">Showing <?php //echo $startRecord+1; ?> to <?php //echo $to_record; ?></span> | Found total <?php //echo $totalRecord; ?> records-->
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    
                                                    <div class="pagination-panel">
                                                        
                                                             <?php if(isset($pagination) && count($pagination)>0) echo $pagination;?>
                                                        
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
<script>
  
    function searchValidation()
    {
        if ( $("#search_keyword").val() == '')
        {
            alert("Search Field Must Contain Name Or Value");
            $("#search_keyword").css('border-color','red');
            $("#search_keyword").focus();
            return false;
        }
        return true;    
    }

    var succ_msg = '<?php echo $succmsg;?>';
    var err_msg = '<?php echo $errmsg;?>';

    $(function(){
        if (succ_msg) {
              $.scojs_message(succ_msg, $.scojs_message.TYPE_OK);
        }
        if (err_msg) {
           $.scojs_message(err_msg, $.scojs_message.TYPE_ERROR);
        }
    });
    
    
  $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#select_group').val(0);
    $('#perPageFrm').submit();
    //$('#perPageFrm').attr('action','<?php echo BACKEND_URL."subject_list/listing_sub/".$this->uri->segment(3).'/';?>');    
  });     
 
    
    $('#select_group').change(function(){
	$('#perPageFrm').submit();	
    });  
    
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR-->