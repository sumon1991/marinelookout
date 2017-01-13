 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Notifications Listing</div>
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
                                    <div class="col-lg-12"><h4 class="box-heading">Notification Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL ."notification/index/" . $this->uri->segment(3); ?>">
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
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."notification/send/";?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Send New Notification</a>&nbsp;
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
                
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                  <th style="width: 15%;" data-toggle="true">Added on</th>
                                                  <th  data-toggle="true">Notification Message</th>
                                                  <th style="width: 10%;">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                    <?php
                                                    //pr($records);
                                                    if(isset($records) && is_array($records) && count($records)>0){
                                                        foreach($records as $key=>$row) {
                                                        ?>
                                                        <tr>
                                                            <td><?php echo date('m/d/Y H:i',strtotime($row['added_on'])) ?></td>
                                                            <td><?php if(strlen($row['message']) > 100)echo stripslashes(substr($row['message'],0,100)).'...';else echo stripslashes($row['message']); ?></td>
                                                            <td><a class="btn btn-info btn-xs" href="<?php echo base_url('notification/view/' . $row['id']); ?>">View</a></td>
                                                        </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                    ?>
                                                    <tr><td align="center" colspan="10">..::..No records found..::..</td></tr>
                                                    <tr><td colspan="10">&nbsp;</td></tr>                
                                                <?php } ?>
                                              </tbody>
                      
                                                </table>
                                
                                            <div class="row mbl">
                                                
                                             
                                            </div>
                                            
                                            <div class="row mbm">
                                            <div class="col-lg-6">
                                                <div class="pagination-panel">
                                                 
                                                     <?php
                                                    $show_to_record 	= $startRecord + $per_page;
                                                    $to_record		= $show_to_record;
                                                    if($show_to_record > $totalRecord) {
                                                          $to_record = $totalRecord;
                                                    }
                                                   // error_reporting(0);
                                                    ?>
                                                    <span class="showRecCount">Showing <?php echo $to_record>0?$startRecord+1:0; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
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
  
  
</script>






