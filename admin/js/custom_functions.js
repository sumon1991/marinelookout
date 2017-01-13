// JavaScript Document
var objCustomsManager;
var BACKEND_URL = "http://192.168.2.5/epariksha/admin/";
//var BACKEND_URL = "http://www.livephuket.com/admin/";
function CustomsManager() {
}


$(function(){ 
	// Initiate the InviteUserManager
	objCustomsManager = new CustomsManager();
	
	$("#apply_action").change(function(){
		objCustomsManager.batchAction();
	});
	
	$("#checkallbox").click(function () {
		var checked_status = $("#checkallbox").attr('checked');
		objCustomsManager.checkAll(checked_status);
	});
		
	$("#btn_show_all").click(function(){
		objCustomsManager.showAll();
	});
	
	$("#per_page").change(function(){
		objCustomsManager.showEntries();
	});
	
	$(".inactive_status").click(function(){
		var activeInactive = $(this).val();
		objCustomsManager.whyNotActive(activeInactive);
	});
	
	//$('#unavailable_calendar_dates').datepick({multiSelect: 999, monthsToShow: 3});

	
	
		
	//===== Check all checbboxes =====//
	$("#checkallbox").click(function() {
		var checkedStatus = this.checked;
		$(".checkItem").each(function() {
			this.checked = checkedStatus;
				if(checkedStatus){
					$('.checkItem').attr('checked', 'checked');
				}
				else {
					$('.checkItem').removeAttr('checked');
				}
		});
	});
	
	/// redirect function for avoid cache
	$(".no-cache-redirect").on("click",function(){
		var url = $(this).prop("href");
		var action_url = "<?php echo base_url(); ?>property_sales/redirect_to/";
		//alert(url);
		
		if ( checkURL(url) && ( url != '' || url != 'javascript:void(0);' || url != '#')  ) {
		var form = '<form name="frmPages" id="redirect_form" action="'+BACKEND_URL+'property_sales/redirect_to/" method="post"><input type="hidden" name="url" id="url" value="'+url+'" /></form>';
		$("body").prepend(form);
		$("#redirect_form").submit();
		}
		return false;
	});
});

function checkURL(value) {
    var urlregex = new RegExp("^(http|https|ftp)\://([a-zA-Z0-9\.\-]+(\:[a-zA-Z0-9\.&amp;%\$\-]+)*@)*((25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9])\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[1-9]|0)\.(25[0-5]|2[0-4][0-9]|[0-1]{1}[0-9]{2}|[1-9]{1}[0-9]{1}|[0-9])|([a-zA-Z0-9\-]+\.)*[a-zA-Z0-9\-]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|[a-zA-Z]{2}))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
    if (urlregex.test(value)) {
        return (true);
    }
    return (false);
}


//start of custom javascript and jquery codes that are used for Admin Section
CustomsManager.prototype.batchAction = function() {

	var val1 = $("#apply_action").val();	 
	if (val1 == ''){
		alert("Are you sure to perform batch action?");
	}
	else{
		var n = $( "input[name='page[]']:checked" ).length;
		if (n<1) {
			alert('Please select atleast one item for action');
			$('#apply_action option:eq(0)').attr("selected", "selected");
		}
		else {
			$("#group_mode").val(val1);
			$('#frmPages').submit();
		}
	}
}

CustomsManager.prototype.checkAll = function(checked_status) {
	
	if(checked_status == 'checked'){
		$('.checkItem').attr('checked', 'checked');
		$('.checkItem').parent().addClass('checked');
	}
	else {
		$('.checkItem').removeAttr('checked');
		$('.checkItem').parent().removeClass('checked');
	}
}

CustomsManager.prototype.showEntries = function() {
	$("#perPageFrm").submit();
}

CustomsManager.prototype.showAll = function() {
	$("#search_keyword").val('');
	$('#per_page option:eq(4)').attr("selected", true);
	$("#perPageFrm").submit();
}

CustomsManager.prototype.whyNotActive = function(activeInactive)
{
	if(activeInactive == 'Active')
	{
		$("#why_not_live_div").hide();
	}
	else
	{
		$("#why_not_live_div").show();
	}
}



$(function(){
	$("#bedrooms").change(function(){		
		var no_bed=$(this).val();
		var str="";
		for(var x=1; x <= no_bed; x++){
			
			str +='<div class="bedroom_details" data-content="'+x+'">';
			str +='<label for="bedroom'+x+'" class="bedroom">Bedroom '+x+' Details In '+current_lang_short+' :</label>';
			str +='<input type="text" name="bedroom[]" id="bedroom" value="" class="form-control">';
			str +='</div>';
		}
		$("#details_box").html(str);
		alert(str);
	});
});

//End of custom javascript and jquery codes that are used for Admin Section by WDC
