 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Subscription Listing</div>
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
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                  <th style="width: 15%;" data-toggle="true">Subscription Date</th>
                                                  <th  data-toggle="true">Email</th>
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
                                                    <?php
                                                    //pr($records);
                                                    if(isset($records) && is_array($records) && count($records)>0){
                                                        foreach($records as $key=>$row) {
                                                          $date = date("d F Y", strtotime($row['created_at']));
                                                        ?>
                                                        <tr>
                                                            <td><?= $date ?></td>
                                                            <td><?= $row['email'] ?></td>
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






