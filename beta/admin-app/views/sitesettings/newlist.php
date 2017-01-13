
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">Site Settings Listing</div>
                </div>
               <!--For breadcrump-->    
  <ol class="breadcrumb page-breadcrumb pull-right">
    <?php
    $tot	=	count($brdLink);
    if(isset($brdLink) && is_array($brdLink)){
    foreach($brdLink as $k=>$v){?>
      <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
	<?php if($tot != $k+1)
	    echo "&nbsp;>&nbsp;";
	?>
      </li>
    <?php }}?>
  </ol>  
  <!--For breadcrump end-->
                <div class="clearfix"></div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE--><!--BEGIN CONTENT-->
            <div class="page-content">
                <div id="form-layouts" class="row">
                    <!--<div class="col-lg-12">
                        <div class="note note-info"><h4 class="box-heading">Responsive tab</h4>

                            <p>Please resize browser to see tab version on Tablet & Mobile</p></div>
                    </div>-->
                    <div class="col-lg-12">
                        <?php
                           $get_id =  $this->uri->segment(3);   
                        ?>
                        <ul class="nav ul-edit nav-tabs responsive">
                            <li class="<?php if(!isset($get_id) || $get_id == '' ) echo 'active'; ?>" >
                            <a href="#tab-form-actions" onclick="location.href='<?php echo base_url().'site_setting/index/'?>'" data-toggle="tab"> Emails</a>
                            </li>
                            
                            <!--<li class="<?php if(isset($get_id) && $get_id == 'email' ) echo 'active'; ?>" >
                            <a href="#tab-form-actions" onclick="location.href='<?php echo base_url().'site_setting/index/email'?>'" data-toggle="tab"> Emails</a>
                            </li>-->
                            
                            
                            
                            <li class="<?php if(isset($get_id) && $get_id == 'contact' ) echo 'active'; ?>">
                                <a href="#tab-two-columns" onclick="location.href='<?php echo base_url().'site_setting/index/contact'?>'"  data-toggle="tab">Contacts</a>
                            </li>
                            <li class="<?php if(isset($get_id) && $get_id == 'seo' ) echo 'active'; ?>">
                                <a href="#tab-two-columns-horizontal"  onclick="location.href='<?php echo base_url().'site_setting/index/seo'?>'" data-toggle="tab">SEO Contents</a>
                            </li>
                            <li class="<?php if(isset($get_id) && $get_id == 'social' ) echo 'active'; ?>">
                                <a href="#tab-two-columns-readonly" onclick="location.href='<?php echo base_url().'site_setting/index/social'?>'" data-toggle="tab"> Social Links</a>
                            </li>
                            <li class="<?php if(isset($get_id) && $get_id == 'site' ) echo 'active'; ?>">
                                <a href="#tab-form-seperated" onclick="location.href='<?php echo base_url().'site_setting/index/site'?>'" data-toggle="tab">Site Text & Other</a>
                            </li>
                            <li class="<?php if(isset($get_id) && $get_id == 'exam_settings' ) echo 'active'; ?>">
                                <a href="#tab-form-seperated" onclick="location.href='<?php echo base_url().'site_setting/index/exam_settings'?>'" data-toggle="tab">Exam Settings</a>
                            </li>
                        </ul>
                        <?php //echo $tabs;?>
                        <div style="background: transparent; border: 0; box-shadow: none !important" class="tab-content pan mtl mbn responsive">
                            
                            <div id="tab-form-actions" class="tab-pane fade active in">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <!--<h4 class="box-heading">Site Setting</h4>-->
                                        
                                        <!--------------------------------code------------------------>    
                                            
                                        <div class="table-container">
<!--                                         <form name="perPageFrm" id="perPageFrm" method="post" action="<?php echo BACKEND_URL;?>site_new/index/<?php echo $get_id;?>">
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
-->                                            
                                            <?php
                                            $show_to_record 	= $startRecord + $per_page;
                                            $to_record		= $show_to_record;
                                            if($show_to_record > $totalRecord) {
                                                  $to_record = $totalRecord;
                                            }
                                            ?>
                                           
                                            <!--<div class="row mbm">
                                                <div class="col-lg-4">
                                                   <div class="pagination-panel">
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                 </div>
                                                    
                                                </div>
                                                <div class="col-lg-8 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $this->pagination->create_links();?>
                                                        
                                                    </div>
                                                </div>
                                            </div>-->
                                            
                                            
                                            
                                            
                                            <!--<form name="frmPages" id="frmPages" action="<?php echo BACKEND_URL."user/batch_action/0/".$page;?>" method="post">-->
                                            
                                            <input type="hidden" name="group_mode" id="group_mode" value="" />  
                                            <input type="hidden" name="totalRecord" id="totalRecord" value="<?php echo $totalRecord; ?>">
                                            <input type="hidden" name="startRecord" id="startRecord" value="<?php echo $startRecord; ?>">
                                            <input type="hidden" name="per_page1" id="per_page1" value="<?php echo $page; ?>">
                                            <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                                <thead>
                                                <tr>
                                                    <th>SL No.</th>
                                                    <th>Settings Name</th>
                                                    <th>Settings Value</th>
                                                    <th>Actions </th> 
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                //pr($settingList);
                                                if(is_array($settingList))
                                                {
                                                for($i=0; $i<count($settingList); $i++)
                                                {
                                                    
                                                 $editLink = str_replace("{{ID}}",$settingList[$i]['sitesettings_id'],$edit_link);
                                                
                                                ?>  
                                                <tr>
                                                    <td><?php echo $i+1+$startRecord; ?></td>
                                                    <td><?php echo stripslashes($settingList[$i]['sitesettings_lebel']);?></td>
                                                    <td><?php echo ucfirst(stripslashes(sub_word(strip_tags($settingList[$i]['sitesettings_value']),10)));?></td>
                                                    
                                                    
                                                    <td>
                                                    <a href="<?php echo $editLink; ?>" class="tablectrl_small bDefault tipS" title="Edit">
                                                        <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                                            Edit 
                                                        </button>
                                                    </a>
                                         
                                                    </td>
                                                </tr>
                                                <?php } } else {  ?>
                            <tr><td colspan="4">..::..No records found..::..</td></tr>
                            <tr><td colspan="4">&nbsp;</td></tr>                
                        <?php } ?>
                                                </tbody>
                                                </table>
                               <!-- </form>-->
                                                <!--<div class="row mbm">
                                                <div class="col-lg-6">
                                                    <div class="pagination-panel">
                                                     Page
                                                        &nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-left"></i></a>&nbsp;<input type="text" maxlenght="5" value="<?php echo $startRecord+1; ?>" class="pagination-panel-input form-control input-mini input-inline input-sm text-center"/>&nbsp;<a href="#" class="btn btn-sm btn-default btn-prev"><i class="fa fa-angle-right"></i></a>&nbsp;
                                                        of <?php echo $to_record; ?> | 
                                                        
                                                        <span class="showRecCount">Showing <?php echo $startRecord+1; ?> to <?php echo $to_record; ?></span> | Found total <?php echo $totalRecord; ?> records
                                                    </div>
                                                </div>
                                                <div class="col-lg-6 text-right">
                                                    <div class="pagination-panel">
                                                        
                                                            <?php echo $this->pagination->create_links();?>
                                                        
                                                    </div>
                                                </div>
                                            </div>-->
                                            
                                        </div>

                                        <!--------------------------------code----------------------------->    
                                    
                                    </div>
                                </div>
                            </div>
                            
                            <!----------------------------another section--------------->                   
 
                            <!----------------------------another section--------------->                         
                           
                        </div>
                    </div>
                </div>
            </div>

<!--LOADING SCRIPTS FOR PAGE-->


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
</script>
