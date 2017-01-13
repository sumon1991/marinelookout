<!-- BEGIN TITLE & BREADCRUMB PAGE -->
<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
    <div class="page-header pull-left">
        <div class="page-title">Admin Listing</div>
    </div>

     <!--For breadcrump-->    
      <ol class="breadcrumb page-breadcrumb pull-right">
        <?php
        /*
        $tot	=	count($brdLink);
        if(isset($brdLink) && is_array($brdLink)){
        foreach($brdLink as $k=>$v){?>
          <li><i class="<?php echo $v['logo'];?>">&nbsp;&nbsp;</i><a href="<?php echo $v['link'];?>"><?php echo $v['name'];?></a>
    	<?php if($tot != $k+1)
    	    echo "&nbsp;>&nbsp;";
    	?>
          </li>
        <?php }}*/
        ?>
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
                        <!-- <h4 class="box-heading">Admin User Search Panel</h4> -->
                            <div class="table-container">
                                <table class="table table-hover table-striped table-bordered table-advanced tablesorter tb-sticky-header">
                                <thead>
                                    <tr>
                                        <!-- <th width="3%"><input type="checkbox" class="checkall" id="checkallbox" name="checkallbox"/></th> -->
                                       
                                        <!-- <th width="5%" style="text-align:center" >User Image</th> -->
                                        <th width="10%">First Name</th>
                                        <th width="10%">Last Name</th>
                                        <th width="7%">Email</th>
        	                              <th width="5%" align="center">Status</th>
                                        <th width="12%">Actions</th>
                                    </tr>
                                <tbody>
                                    <?php
                                     $session_user_role  = $this->nsession->userdata('ROLE');
                                     $session_user_id    = $this->nsession->userdata('ID');
                                     
                                    if(is_array($adminList) && !empty($adminList))
                                    {
                                        for($i=0; $i<count($adminList); $i++)
                                        {
                                    ?>  
                                    <tr>
                                    <!-- <td>
                                        <input type="checkbox" value="<?php echo $adminList[$i]['id'];?>"/>
                                    </td> -->

                                    <!-- <td style="text-align:center" >
                                        <img src="<?=$user_image!=''?$user_image:'';?>" border="0" width="100" height="100">
                                    </td> -->
                                    <td><?php echo stripslashes($adminList[$i]['first_name']);?></td>
                                    <td><?php echo stripslashes($adminList[$i]['last_name']);?></td>
                                    <td><?php echo stripslashes($adminList[$i]['admin_email']);?></td>
                                    <td><?php if($adminList[$i]['is_active']=='active'){  echo '<label class="label label-green">'. ucwords( stripslashes($adminList[$i]['is_active']));  }else{  echo '<label class="label label-red">'. ucwords( stripslashes($adminList[$i]['is_active'])); } ?></label>
                                    </td>

                                    <td>
                                    <a href="<?php echo $adminList[$i]['id'];?>" class="tablectrl_small bDefault tipS" title="Edit">
                                    <button type="button" class="btn btn-info btn-xs"><i class="fa fa-edit"></i>&nbsp;
                                    Edit 
                                    </button>
                                    </a>
                                    &nbsp;
                                    <a href="" class="tablectrl_small bDefault tipS" title="Remove" onclick="return confirm('Are you sure?');">
                                    <button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i>&nbsp;
                                    Delete
                                    </button>
                                    </a>
                                    </td>
                                    </tr>
                                    <?php
                                        } 
                                    }
                                    else
                                    {
                                    ?>
                                    <tr>
                                        <td colspan="7" align="center">..::..No records found..::..</td>
                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                                </thead>
                                </table>                                
                                <div class="row mbl">                           
                                    <!-- <div class="col-lg-6">
                                        <div class="tb-group-actions"><span>Apply Action:</span>
                                            <select class="table-group-action-input form-control input-inline input-small input-sm mlm" name="apply_action" id="apply_action">
                                                <option value="">Select...</option>
                                               
                                                <option value="Activate">Activate</option>
                                                <option value="Inactivate">Inactivate</option>
                                            </select>
                                        </div>
                                    </div> -->
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
       alert("Search Field Must Contain Name Or Email");
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
<!--END CONTENT-->
<!--BEGIN CONTENT QUICK SIDEBAR-->

<!--END CONTENT QUICK SIDEBAR