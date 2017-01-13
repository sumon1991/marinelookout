BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Exam Listing</div>
    </div>
 <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
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
    
                                    
                                
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Exam Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>enquiry/index/">
					    <input type="hidden" name="order_by" id="order_by" value="<?php if($this->input->get_post('order_by')!= '')echo$this->input->get_post('order_by');else echo "DESC";?>"/>
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                    
                                                    <input type="text" id="search_keyword" name="search_keyword" placeholder="Enter here..." class="form-control" value="<?php echo $search_keyword; ?>" />
                                                    <span class="input-group-btn">
                                                        <button type="submit" class="btn btn-success" onclick=" return searchValidation();">Search</button>
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    
                                                   
                                                    <button class="btn btn-sm btn-primary" name="btn_show_all" id="btn_show_all"><i class="fa "></i>&nbsp;
                                                            Show All
                                                    </button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    View
                                                        &nbsp;<select name="per_page" id="per_page" class="form-control input-xsmall input-sm input-inline">
                                                            
                                                            <option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
                                                            <option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
                                                            <option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
                                                            <option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
                                                            <option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
                                                            <option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
                                                            <option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
                                                            <option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option>
                                                            
                                                            
                                                            
                                                        </select>&nbsp;
                                                        records 
                                                
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            <?php
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                           // error_reporting(0);
                                            ?>
                                           
                                            <div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."enquiry/batch_action/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 3%;"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th>
                                                    <th style="width: 5%;">Enquired by</th>
                                                    <th style="width: 5%;">Email</th>
                                                    <!--<th style="width: 20%;">Message</th>-->
                                                    <!--<th>Phone</th>
                                                    <th>Guest</th>-->
						    <th style="width: 5%;">Country</th>
                                                    <th style="width: 5%;">Property Name</th>
						    <th style="width: 5%;">Beds</th>
						    <th style="width: 5%;">Price</th>
						    <th style="width: 5%;">Location</th>
                                                    <th style="width: 5%;">Region</th>
                                                    <th style="width: 5%;">Device</th>
                                                    <th style="width: 5%;cursor: pointer;" class="add_on">Added on
						    <?php
						    if($this->input->get_post('order_by') == 'ASC')
							echo '<i class="fa fa-arrow-down"></i>';
						    else
							echo '<i class="fa fa-arrow-up"></i>';
						    ?>
						    </th>
                                                    <th style="width: 5%;">Actions</th>
                                                    
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                <input type="hidden" id="latest_enquiry" name="latest_enquiry" value="<?php echo $latestEnquiry[0]['enquiry_id'];?>">
                                                <?php
						//pr($enquiryList);
                                                if(is_array($enquiryList))
                                                {
                                                for($i=0; $i<count($enquiryList); $i++){
                                                    
                                                    if($enquiryList[$i]['email_address']=='') {
                                                      $email ='';
                                                    } else {
                                                      $email = stripslashes($enquiryList[$i]['email_address']);
                                                    }
                                                    
                                                    $viewLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$view_link);
                                                    $leadLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$lead_link);
                                                    $deleteLink = str_replace("{{ID}}",$enquiryList[$i]['enquiry_id'],$delete_link);
                                                    
                                                    //$class = 'class="even"';
                                                    //if($i%2==0)
                                                    //        $class = 'class="even"';
                                                    //else
                                                    //        $class = 'class="odd"';
                                                            
                                                    if(stripslashes(trim($enquiryList[$i]['notes'])) != '') {
                                                      $notes = sub_word($enquiryList[$i]['notes'], 50);
                                                    } else {
                                                      $notes = 'N.A.';
                                                    }
                                                    
                                                    $pos = stripos($notes, "wdc");
						    if ($pos === false) {
                                                        ?>  
                            <tr <?php if($enquiryList[$i]['enquiry_read']=='Unread'){?> style=" background-color: #fce9e9;"<?php }else{?>style=" background-color: #f4fcec;" <?php }?>>
                                <td><input type="checkbox" name="page[]" class="checkItem" value="<?php echo $enquiryList[$i]['enquiry_id'];?>" /></td>
                                
                                <td><?php echo stripslashes($enquiryList[$i]['contact_name']);?></td>
                                <td><?php echo $email;?></td>
                                <!--<td><?php //echo $notes;?></td>-->
                                <td><?php echo $enquiryList[$i]['country'];?></td>

                                <!-- Development ID-->
                                <td>
                                    <a href="<?php echo trim($enquiryList[$i]['is_development']) == 'No' ? FRONTEND_URL.'property-sales/'.$enquiryList[$i]['url'] : FRONTEND_URL.$enquiryList[$i]['url'];?>" target="_blank">
                                    <?php echo trim($enquiryList[$i]['is_development']) == 'Yes' ? stripslashes($enquiryList[$i]['development_id']) : stripslashes($enquiryList[$i]['unit_id']);?>
                                    </a>
                                </td>



                                <td><?php if($enquiryList[$i]['bedrooms'] == '0'){echo 'Studio';}else{echo $enquiryList[$i]['bedrooms'];}?></td>
				<td><?php echo $enquiryList[$i]['currency_symbol'].number_format($enquiryList[$i]['total_price']);?></td>
                                <!--<td><?php //echo $enquiryList[$i]['sales_rentals'];?></td>-->
				<td><?php echo $enquiryList[$i]['location_name'];?></td>
				<td><?php echo $enquiryList[$i]['region_name'];?></td>
                                <td><?php if($enquiryList[$i]['is_mobile']=="Yes"){ echo "Mobile";} else if($enquiryList[$i]['is_mobile']=="No"){ echo "Desktop";} ?></td>
                                <td>
                                <?php echo @date("d/m/Y H:i:s", strtotime($enquiryList[$i]['added_on']) + 13 * 3600);?>
                                </td>
                                <td>
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $viewLink;?>" title="Details">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-file-text-o"></i>&nbsp;
                                                            Details 
                                    </button>
                                    </a>
                                    &nbsp;<br>
                                    <?php
                                     if($this->nsession->userdata('role') == 'agent')
                                    {
                                        if($enquiryList[$i]['assigned_user'] == 1)
                                        {
                                    ?>		      
                                          
                                   <?php
                                        }
                                   
                                   }
                                   else if($this->nsession->userdata('role') == 'admin')
                                   {
                                    
                                ?>			     
                                  
                                  
                                    <a class="tablectrl_small bDefault tipS" href="<?php echo $deleteLink;?>" title="Delete" onclick="return confirm('Are you sure?');">
                                      <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                                            Delete
                                      </button>
                                    </a>
                                <?php
                                }
                                else
                                {
                                ?>
                                &nbsp;
                                <?php
                                }
                                ?>
                            
                            </td> 
                        </tr>
                        <?php } } } else {  ?>
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
                                                        <option value="Delete">Delete</option>
                                                    </select>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            </form>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                     
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $pagination;?>
                                                        
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
    
    
//    $(function(){
//    function refreshDiv(){
//      
//        var latest_enquiry = $('#latest_enquiry').val();
//	var backend_url	= '<?php echo BACKEND_URL;?>';
//	//alert(latest_enquiry);
//	$.ajax({
//		type: "POST",
//		dataType: "HTML",
//		url: backend_url+"enquiry/get_new_enquiry",
//		data: { latest_enquiry: latest_enquiry},
//		success:function(data) { 
//			$("#latest_enquiry").remove();
//			
//		  	$("#listing").prepend(data);
//		}		
//	});
//    window.setTimeout(refreshDiv, 5000);
//    }
//    window.setTimeout(refreshDiv, 5000);
//});
//    
    $('.add_on').click(function(){
	if ($('#order_by').val() == 'DESC')
	    $('#order_by').val('ASC');
	else
	    $('#order_by').val('DESC');
	    
	$('#perPageFrm').submit();		          
    });
</script>
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR