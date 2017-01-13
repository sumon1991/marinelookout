 <!--BEGIN TITLE & BREADCRUMB PAGE-->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Blog Post Listing</div>
    </div>
    <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    
  </ol>  
  <!--For breadcrump end-->
    <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE-->
<!--BEGIN CONTENT-->

            <div class="page-content" style="padding: 15px 14px 0 20px;">
                <div id="table-action" class="row">
                    <div class="col-lg-14">
                        
                        <div id="tableactionTabContent" class="tab-content">
                            <div id="table-table-tab" class="tab-pane fade in active">
                                
                              
                                    <!-- Start : main content loads from here -->   
                                <div class="row">
                                    <div class="col-lg-12"><h4 class="box-heading">Blog Post Search Panel</h4>

                                        <div class="table-container">
                                            <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL."blogpost/index/0/0";?>">
                                            <input type="hidden" name="is_show_all" id="is_show_all" value="0"/>
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
                                                        <option value="1"   <?php if($per_page == "1")   { echo ' selected="selected"'; } ?>>1</option>
                                                        <option value="2"   <?php if($per_page == "2")   { echo ' selected="selected"'; } ?>>2</option>
                                                        <option value="5"   <?php if($per_page == "5")   { echo ' selected="selected"'; } ?>>5</option>
                                                        <option value="10"  <?php if($per_page == "10")  { echo ' selected="selected"'; } ?>>10</option>
                                                        <option value="20"  <?php if($per_page == "20")  { echo ' selected="selected"'; } ?>>20</option>
                                                        <option value="50"  <?php if($per_page == "50")  { echo ' selected="selected"'; } ?>>50</option>
                                                        <option value="100" <?php if($per_page == "100") { echo ' selected="selected"'; } ?>>100</option>
                                                        <option value="500" <?php if($per_page == "500") { echo ' selected="selected"'; } ?>>500</option> 
                                                        </select>
                                                    <div class="tb-group-actions pull-right">
                                                    <div class="actions"><a href="<?php echo BACKEND_URL."blogpost/add/";?>" class="btn btn-info btn-sm"><i class="fa fa-plus"></i>&nbsp;
                                                    Add Blog Post</a>&nbsp;
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
                                            
                                            
                                            
                                            
                                            <form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."blogpost//0/".$page;?>" method="post">
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th style="width: 10%;" data-toggle="true">Image</th> 
                                                    <th style="width: 10%;" data-toggle="true">Title</th>
                                                    <th style="width: 10%;" data-toggle="true">Author</th>
                                                    <th style="width: 10%;" data-toggle="true">Status</th>
                                                    <th style="width: 10%;" data-sort-ignore="true">Actions</th> 
                                                </tr>
                                                </thead>
                                                <tbody id="listing">
        <?php
        //pr($enquiryList);
                            if(isset($blog_post_all) && is_array($blog_post_all) && count($blog_post_all)>0){
                            foreach($blog_post_all as $key=>$blogpost) {
                              
                             // echo (file_exists(FILE_UPLOAD_ABSOLUTE_PATH."student/".$student['image']))?'true':'false';
                            ?>
          
                        <tr class="<?=($key%2==0?'even':'odd');?>">
                          <td><img src="<?php echo(isset($blogpost['featured_image']) && $blogpost['featured_image']!='' && file_exists(FILE_UPLOAD_ABSOLUTE_PATH."blogpost/thumb/".$blogpost['featured_image']) ? BACKEND_IMAGE_PATH."blogpost/thumb/".$blogpost['featured_image'] : BACKEND_IMAGE_PATH.'no_image.png');?>" alt="No Image" height="70" width="90"/></td>
                          <td><?php echo stripslashes($blogpost['post_title']);?></td>
                          <td><?php echo stripslashes($blogpost['author']);?></td>
                          <td><?php if($blogpost['post_status']=='Publish'){  echo '<label class="label label-green">'. 'Publish';  } else {  echo '<label class="label label-red">'. 'Draft'; } ?>
                                    </td>
                              <td>    <a class="various3 previewLinkBtn changeStatus" href="<?php echo $blogpost['edit_link'];?>">
                               <!-- <span class="btn btn-blue property_list property_list_preview">Edit</span>-->
                               <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                Edit 
                                </button>
                              </a>
                               <a class="various3 previewLinkBtn changeStatus" href="<?php echo $blogpost['delete_link'];?>">
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
           alert("Search field cant not be empty!");
           $("#search_keyword").css('border-color','red');
           $("#search_keyword").focus();
           return false;
        }
        return true;    
    }
    $('#btn_show_all').click(function(){
    $('#is_show_all').val(1);
    $('#perPageFrm').attr('action','<?php echo BACKEND_URL."blogpost/index/0/0/";?>');    
  });
</script>






