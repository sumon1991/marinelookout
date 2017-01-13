<?php //pr($subjects);?>
<!--BEGIN TITLE & BREADCRUMB PAGE-->

<div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
  <div class="page-header pull-left">
    <div class="page-title">Dashboard</div>
  </div>
  
<!--For breadcrump-->    
  <!-- <ol class="breadcrumb page-breadcrumb pull-right">
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
  </ol>   -->
  <!--For breadcrump end-->
  
  <div class="clearfix"></div>
</div>
<!--END TITLE & BREADCRUMB PAGE--> 
<!--BEGIN CONTENT-->
<div class="page-content">
<div id="tab-general">
  <div id="sum_box" class="row mbl">
    

    <div class="col-lg-12"> 
      <div class="panel panel-blue portlet box portlet-blue">
      <div class="portlet-header">
      <div class="caption">Traffic Activity</div>
      <div class="tools"> <i class="fa fa-chevron-up"></i></div>
      </div>

      <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
      <div class="col-lg-12">
      <br class="spacer">

      <!-- Total Editors -->
	    <div class="col-sm-6 col-md-3" style="cursor: pointer;">
        <div class="panel income db mbm" onclick="window.location.href='<?php echo BACKEND_URL.'editor/all/';?>'">
          <div class="panel-body">
          <p class="icon">
          <i class="fa fa-user" style="color: #0A819C;"></i>
          </p>
          <p class="description">
          </p><h4><?php echo $total_editor[0]['no_of_editor'];?></h4>
          <br>
          Total Editors<p></p>
          </div>
        </div>
      </div>

      <!-- Total Students -->
      <div class="col-sm-6 col-md-3" style="cursor: pointer;">
        <div class="panel income db mbm" onclick="window.location.href='<?php echo BACKEND_URL.'studentuser/index/';?>'">
          <div class="panel-body">
          <p class="icon">
          <i class="fa fa-user" style="color: #0A819C;"></i>
          </p>

          <p class="description">
          </p><h4><?php echo $total_student[0]['no_of_student'];?></h4>
          <br>
          Total Students<p></p>
          </div>
        </div>
      </div>

      <!-- Total Subjects -->
      <div class="col-sm-6 col-md-3" style="cursor: pointer;">
        <div class="panel income db mbm" onclick="window.location.href='<?php echo BACKEND_URL.'subject/all/';?>'">
          <div class="panel-body">
          <p class="icon">
          <i class="fa fa-file" style="color: #0A819C;"></i>
          </p>

          <p class="description">
          </p><h4><?php echo $total_subject[0]['no_of_subject'];?></h4>
          <br>
          Total Subjects<p></p>
          </div>
        </div>
      </div>


      <div class="col-sm-6 col-md-3" style="cursor: pointer;" id="no_of_question">
        <div class="panel income db mbm" onclick="#">
          <div class="panel-body">
          <p class="icon">
          <i class="fa fa-question" style="color: #0A819C;"></i>
          </p>

          <p class="description">
          </p><h4><?php echo $total_question[0]['no_of_question'];?></h4>
          <br>
          Total Questions<p></p>
          </div>
        </div>
      </div>

      <div style="clear: both"></div>
      <br class="spacer">
      </div>
      </div>
      </div>
    </div>
	
	
	
<!--  Subjectwise Question List -->
	  <div class="col-lg-12" id="subject_list" style="display: none"> 
      <div class="panel panel-blue portlet box portlet-blue">
      <div class="portlet-header">
      <div class="caption">Subjectwise Question List</div>
      <div class="tools"> <i class="fa fa-chevron-up"></i></div>
      </div>

      <div class="box portlet-body panel-body pan" style="background: #F4F4F4;">
      <div class="col-lg-12">
      <br class="spacer">

	  <ul>
	  <?php		
		foreach($subjects as $index=>$subject)
		{ 
	  ?>
      <!-- Total Subjects -->
	    <div class="col-sm-6 col-md-3" style="cursor: pointer;">
        <div class="panel income db mbm" onclick="window.location.href='<?php echo BACKEND_URL.'subject_list/listing_sub/'.$subject['subject_slug'].'/';?>'">
          <div class="panel-body">
          <p class="icon">
          <!--<i class="fa fa-file" style="color: #0A819C;"></i>-->
          </p>
          <p class="description">
          </p><h4>No Of Question <strong><?php echo $subject['no_of_question']; ?></strong> </h4>
          <br>
          <?php echo stripslashes($subject['title']); ?><p></p>
          </div>
        </div>
      </div>
	  <?php
		}
	  ?>
	  </ul>
      <div style="clear: both"></div>
      <br class="spacer">
      </div>
      </div>
      </div>
    </div>
        </div>
        </div>
      </div>
<script>
    $(function(){
       $(".input-daterange #startdate").datepicker();
       $(".input-daterange #enddate").datepicker({
          defaultDate:$(".input-daterange #startdate").val()
        });
    });
	$("#no_of_question").click(function(){
	  $("#subject_list").slideToggle();
	});
</script>