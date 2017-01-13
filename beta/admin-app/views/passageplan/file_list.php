 <!--BEGIN TITLE & BREADCRUMB PAGE-->

<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">File Listing</div>
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
                                <a href="<?php echo base_url()."passageplan/create/" ?>" class="btn btn-primary"><i class="fa fa-plus"></i> New File Upload</a>
                              
                                    <!-- Start : main content loads from here -->   
    
                                    
                                
                                <div class="row">
                                    <div class="col-lg-12">

                                        <div class="table-container">
                                            
                                            <?php
                                            $show_to_record   = $startRecord + $per_page;
                                            $to_record    = $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                            elseif($totalRecord == 1)
                                                $to_record =1;
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."advertisement//0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                   <th style="width: 10%;" data-toggle="true">Title</th>
                                                   <th style="width: 10%;" data-toggle="true">File name</th> 
                                                   <th style="width: 10%;" data-toggle="true">Added On</th>
                                                   <th style="width: 5%;" data-toggle="true">Status</th>
                                                   <th style="width: 15%;" data-sort-ignore="true">Actions</th> 
            </tr>
                                                </thead>
                                                <tbody id="listing">
        <?php
        //pr($enquiryList);
                            if(isset($file_all) && is_array($file_all) && count($file_all)>0){
                            foreach($file_all as $key=>$file) {
                              
                            ?>
          
                        <tr class="<?=($key%2==0?'even':'odd');?>">
                          <td><?php echo stripslashes($file['file_title']);?></td>
                          <td><?php echo stripslashes($file['file_name']);?></td>
                           <td><?php echo stripslashes($file['update_at']);?></td>
                          <td><?php if($file['status']=='Active'){  echo '<label class="label label-green">'. 'Active';  }
                          else {  echo '<label class="label label-red">'. 'Inactve'; } ?>
                                    </td>
                              <td>   
                               <a class="various3 previewLinkBtn changeStatus" href="<?php echo $file['delete_link'];?>">
                              
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
       alert("Search Field Must Contain Name Or Email");
       $("#search_keyword").css('border-color','red');
       $("#search_keyword").focus();
       return false;
    }
    return true;    
  }
  
  $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#perPageFrm').attr('action','<?php echo BACKEND_URL."advertisement/index/0/0";?>');    
  });  
</script>
