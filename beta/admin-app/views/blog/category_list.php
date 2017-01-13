 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Blog Category Listing</div>
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
                                            
                                            <a href="<?php echo $add_link ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Add Category</a>
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                   <th style="width: 10%;" data-toggle="true">Title</th> 
                                                   <th style="width: 10%;" data-toggle="true">Status</th>
                                                   <th style="width: 15%;" data-sort-ignore="true">Actions</th> 
            </tr>
                                                </thead>
                                                <tbody id="listing">
        <?php
                            //pr($blogList);
                            if(isset($categoryList) && is_array($categoryList) && count($categoryList)>0){
                                foreach($categoryList as $key=>$c)
                                {
                              
                            ?>
          
                        <tr class="<?=($key%2==0?'even':'odd');?>">
                          <td><?php echo stripslashes($c['name']);?></td>
                                       
                          <td>
                          <?php if($c['status']=='Active'){  echo '<label class="label label-green">'. 'Active';  } else {  echo '<label class="label label-red">'. 'Inactve'; } ?>
                          </td>
                        <td><a class="various3 previewLinkBtn changeStatus" href="<?php echo str_replace('{{ID}}',$c['id'],$edit_link);?>">
                        
                         <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                          Edit 
                          </button>
                        </a>
                         <a class="various3 previewLinkBtn changeStatus" href="<?php echo str_replace('{{ID}}',$c['id'],$del_link);?>">
                        
                         <button type="button" class="btn btn-danger btn-xs" onclick="return confirm('Do you want to delete?')"><i class="fa fa-trash-o"></i>&nbsp;
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
                                                <div class="row mbm">
                                                <div class="col-lg-6">
                                                   
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
  
  
  
</script>

?>