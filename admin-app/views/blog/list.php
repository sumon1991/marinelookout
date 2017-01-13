 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Blog Listing</div>
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
                                    <div class="col-lg-12"><h4 class="box-heading">Blog Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL."blog/index/".$page."/0";?>">
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
                                                    <select name="per_page" id="per_page" class="form-control input-xsmall input-sm input-inline" style="display: none;">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="5">5</option>
                                                            <option value="10">10</option>
                                                            <option value="20">20</option>
                                                            <option value="50">50</option>
                                                            <option value="100">100</option>
                                                            <option value="500">>500</option>
                                                        </select>
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."blog/add/";?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Blog</a>&nbsp;
                                                    </div>
                                                    </div>
                                                </div>
                                                
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
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."blog/0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                   <th style="width: 10%;" data-toggle="true">Blog Title</th> 
                                                   <th style="width: 10%;" data-toggle="true">Author Name</th>
                                                   <th style="width: 10%;" data-toggle="true">No of views</th>
                                                   <th style="width: 5%;" data-toggle="true">Status</th>
                                                   <th style="width: 15%;" data-sort-ignore="true">Actions</th> 
            </tr>
                                                </thead>
                                                <tbody id="listing">
        <?php
                            //pr($blogList);
                            if(isset($blogList) && is_array($blogList) && count($blogList)>0){
                                foreach($blogList as $key=>$blog)
                                {
                              
                            ?>
          
                        <tr class="<?=($key%2==0?'even':'odd');?>">
                          <td><?php echo stripslashes($blog['title']);?></td>
                          <td><?php echo stripslashes($blog['first_name'].' '.$blog['last_name']);?></td>
                          <td><?php echo $blog['no_views'];?></td>                         
                          <td><?php if($blog['status']=='Active'){  echo '<label class="label label-green">'. 'Active';  } else {  echo '<label class="label label-red">'. 'Inactve'; } ?>
                                    </td>
                        <td><a class="various3 previewLinkBtn changeStatus" href="<?php echo $blog['edit_link'];?>">
                        
                         <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                          Edit 
                          </button>
                        </a>
                         <a class="various3 previewLinkBtn changeStatus" href="<?php echo $blog['delete_link'];?>">
                        
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
  
  
  
</script>

?>