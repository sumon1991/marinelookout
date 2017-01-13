 <!--BEGIN TITLE & BREADCRUMB PAGE-->
 <?php //pr($this->nsession->all_userdata());?>
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Subject Listing</div>
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
                                
                                                      
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Subject Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL."subject/all/0/0";?>">
                                            <input type="hidden" name="is_show_all" id="is_show_all" value="0"/>
                                            <div class="row mbl">
                                                <div class="col-lg-6">
                                                    <div class="input-group input-group-sm mbs">
                                                 
                                                    <input type="text" id="search_keyword" name="search_keyword" placeholder="Enter here..." class="form-control" value="<?php echo $search_keyword; ?>"/>
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
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."subject/add/";?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Sbuject</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            </form>
                                            
                                            
                                          
                                           
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."subject/update/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 20%;" data-toggle="true">Subject Name</th>
                                                    <th style="width: 5%;" data-toggle="true">Total Questions</th>
                                                    <th style="width: 5%;" data-toggle="true">No of questions in group A</th>
                                                    <th style="width: 5%;" data-toggle="true">No of questions in group B</th>
                                                    <th style="width: 5%;" data-toggle="true">Status</th>
                                                    <th style="width: 5%;" data-sort-ignore="true">Actions</th> 
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                          <?php
                             if(isset($subject_all) && is_array($subject_all) && count($subject_all )>0){
                              foreach($subject_all as $subject) {
                            ?>
      
                        <tr>
                           
                          <td><?php echo stripslashes($subject['title']);?></td>
                          <td><?php echo $subject['total_question'];?></td>
                          <td><?php echo $subject['no_of_a_qsn'];?></td>
                          <td><?php echo $subject['no_of_b_qsn'];?></td>
                          <td><?php if($subject['is_active']=='yes'){  echo '<label class="label label-green">'. 'Active</label>';  } else {  echo '<label class="label label-red">'. 'Inactve</label>'; } ?>
                            <?php if($subject['total_question'] > ($subject['no_of_a_qsn']+$subject['no_of_b_qsn'])){  echo '<span class="label label-sm label-danger">Not Completed</span>';  }?>
                            </td>
                          
                              <td>    <a class="various3 previewLinkBtn changeStatus" href="<?php echo $subject['edit_link'];?>">
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                Edit 
                                </button>
                              </a>
                              <?php if($this->nsession->userdata('ROLE')!= 'editor'){?>
                               <a class="various3 previewLinkBtn changeStatus" href="<?php echo $subject['delete_link'];?>" >
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure?')"><i class="fa fa-trash-o"></i>&nbsp;
                                Delete 
                                </button>
                              </a>
                                <?php }?>
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
                                            <?php
                                            $show_to_record   = $startRecord + $per_page;
                                            $to_record    = $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                           // error_reporting(0);
                                            ?>
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                    <!--<div class="pagination-panel">
                                                        <span class="showRecCount">Showing <?php //echo $startRecord+1; ?> to <?php //echo $to_record; ?></span> | Found total <?php //echo $totalRecord; ?> records
                                                    </div>-->
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
       alert("Search Field Must Contain Name Or Email");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
   $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#perPageFrm').attr('action','<?php echo BACKEND_URL."subject/all/0/0";?>');    
  });  
  
</script>






