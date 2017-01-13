 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Team Members</div>
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
    
                                    
                                
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Member Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL."teammember/all/0/0";?>">
                                            <input type="hidden" id="is_show_all" name="is_show_all" value="0"/>
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
                                                    </button>
                                                    
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."teammember/add/";?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Member</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            <?php
                                         //  pr($editor_all);

                                            $show_to_record   = $startRecord + $per_page;
                                            $to_record    = $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                           // error_reporting(0);
                                            ?>
                                           
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."editor/all/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                  <th style="width: 10%;" data-toggle="true">Member Image</th>
                                                  <th style="width: 10%;" data-toggle="true">Name</th>
                                                  <th style="width: 10%;" data-toggle="true">Designation</th>
                                                  <th style="width: 20%;" data-toggle="true">Description</th>
                                                  
                                                  <th style="width: 10%;" data-toggle="true">Added On</th>
                                                  <th style="width: 5%;" data-toggle="true">Status</th>
                                                  <th style="width: 15%;" data-sort-ignore="true">Actions</th> 
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
        <?php
        //pr($enquiryList);
                            if(isset($member_all) && is_array($member_all) && count($member_all)>0){
                            foreach($member_all as $key=>$member) {
                            ?>
      
                        <tr class="<?=($key%2==0?'even':'odd');?>">
                           <td><img src="<?php echo(isset($member['member_image']) && $member['member_image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."admin/".$member['member_image']) ? BACKEND_IMAGE_PATH."admin/".$member['member_image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" alt="No Image" height="70" width="90"/></td>
                          <td><?php echo stripslashes($member['member_name']);?></td>
                          
                          <td><?php echo stripslashes($member['designation']);?></td>
                          <td><?php echo stripslashes($member['short_description']);?></td>
                         
                          <td><?php echo stripslashes($member['added_on']);?></td>
                          <td><?php if($member['is_active']=='active'){  echo '<label class="label label-green">'. 'Active';  } else {  echo '<label class="label label-red">'. 'Inactve'; } ?>
                                    </td>
                              <td>    <a class="various3 previewLinkBtn changeStatus" href="<?php echo $member['edit_link'];?>">
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                Edit 
                                </button>
                              </a>
                               <a class="various3 previewLinkBtn changeStatus" href="<?php echo $member['delete_link'];?>">
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-danger btn-xs" onclick="return confirm('Do you to delete!')"><i class="fa fa-trash-o"></i>&nbsp;
                                Delete 
                                </button>
                              </a>
            
                            </td> 
                        </tr>
                        <?php  } } else {  ?>
                            <tr><td colspan="10">..::..No records found..::..</td></tr>
                            <tr><td colspan="10">&nbsp;</td></tr>                
                        <?php } ?>
                      </tbody>
                      
                                                </table>
                                
                                            <div class="row mbl">
                                                
                                             
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
       alert("Search Field Must Contain Name");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }


  
   $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#perPageFrm').attr('action','<?php echo BACKEND_URL."teammember/all/0/0";?>');    
  }); 
</script>