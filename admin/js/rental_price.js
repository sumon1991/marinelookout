var base_url_suffix='livephuket/';
var base_url_suffix='';
var base_url = location.protocol + '//' + location.host + '/' + base_url_suffix+"warp/";

function addMoreSeasons(year){
	var appendToID		= 'tableSeasons_' + year;
	var itemType =$('#'+appendToID).find('div.sub-season').last().attr('id');
	var last_id = itemType.replace('season_', '');
	
	if ($('#'+appendToID+' #end_date_'+year+'_'+last_id).val()!='' && $('#'+appendToID +' #start_date_'+year+'_'+last_id).val()!='') 	{
	
	
	var countSeasons1	= $('#' + appendToID + ' div.sub-season').length;
	countSeasons1		= countSeasons1+1;
	var last_id1 = parseInt(last_id);
	var countSeasons		= parseInt(last_id)+1;
	var last_insert_date = ($('#'+appendToID +' #end_date_'+year+'_'+last_id1).val());
	if(last_insert_date == '31/12/'+year)
	{
		
		$.scojs_message("You have already entered all the season. Your last entered end date is 31/12/"+year+". If you want to break into more season please change last entered season end date.", $.scojs_message.TYPE_ERROR);
		
	}
	else
	{
	var appendHTML = '<br class="spacer"><div class="custom-border sub-season" id="season_'+countSeasons+'"><div class="col-mb-12"><div class="col-md-4">';
	appendHTML+='<h3>Season '+countSeasons+'</h3></div><div class="col-md-8 text-right"><button class="removeSeason btn btn-primary" id="removeSeason_'+countSeasons+'_'+year+'" type="button">';
	appendHTML +='<i class="fa fa-times"></i> Remove Season</button></div><div style="clear: both"></div><br class="spacer">';
	appendHTML +='</div><div class="col-sm-4 rentDailyPricePan"><div class="col-sm-12"><label class="req" for="reg_input_name">Daily Price</label><br>';
	appendHTML +='<input type="hidden" value="" id="dailyPriceTmp_'+countSeasons+'" name="dailyPriceTmp['+year+'][]">';
	appendHTML +='</div>';
	
	appendHTML +='<div class="col-sm-12"><div class="dailyAutoPricePan" id="dailyPricePan_'+countSeasons+'" data-year="'+year+'">';
	appendHTML +='<div class="pan1"><span><a class="dailyMPrice" href="javascript:void(0);" id="dailyMPrice_'+countSeasons+'">M</a></span>';
	appendHTML +='<span><a class="daily0Price" href="javascript:void(0);" id="daily0Price_'+countSeasons+'">0</a></span>';
	appendHTML +='</div><div class="pan2"><span><a class="daily5Price" href="javascript:void(0);" id="daily5Price_'+countSeasons+'">5</a></span>';
	appendHTML +='<span><a class="daily10Price" href="javascript:void(0);" id="daily10Price_'+countSeasons+'">10</a></span>';
	appendHTML +='<span><a class="daily15Price" href="javascript:void(0);" id="daily15Price_'+countSeasons+'">15</a></span>';
	appendHTML +='<span><a class="daily20Price" href="javascript:void(0);" id="daily20Price_'+countSeasons+'">20</a></span>';
	appendHTML +='<span><a class="daily25Price" href="javascript:void(0);" id="daily25Price_'+countSeasons+'">25</a></span>';
	appendHTML +='<span><a class="daily30Price" href="javascript:void(0);" id="daily30Price_'+countSeasons+'">30</a></span>';
	appendHTML +='<span><a class="daily35Price" href="javascript:void(0);" id="daily35Price_'+countSeasons+'">35</a></span>';
	appendHTML +='<span><a class="daily40Price" href="javascript:void(0);" id="daily40Price_'+countSeasons+'">40</a></span>';
	appendHTML +='<span><a class="daily45Price" href="javascript:void(0);" id="daily45Price_'+countSeasons+'">45</a></span>';
	appendHTML +='<span><a class="daily50Price" href="javascript:void(0);" id="daily50Price_'+countSeasons+'">50</a></span>';
	appendHTML +='</div></div></div>';
	
	
	appendHTML +='<div class="col-sm-12 input-icon"><i class="fa fa-money"></i>';
	appendHTML +='<input type="text" id="dailyprice_'+countSeasons+'" data-type="number" data-required="true" class="form-control required daily-price-fld" name="season_daily['+year+'][]" value="">';
	appendHTML +='</div>';
	
	appendHTML +='</div>';
	appendHTML +='<div class="col-sm-4 rentWeeklyPricePan"><div class="col-sm-12">';
	appendHTML +='<label class="req" for="reg_input_name">Weekly Price</label><br>';
	appendHTML +='<input type="hidden" id="weeklydisc_'+countSeasons+'" data-type="number" data-required="true" class="form-controltwo required" name="disc_weekly['+year+'][]" value="">';
	appendHTML +='</div>';
	appendHTML +='<div class="col-sm-12">';
	appendHTML +='<div class="weeklyAutoPricePan" id="weeklyPricePan_'+countSeasons+'" data-year="'+year+'">';
	appendHTML +='<div class="pan1">';
	appendHTML +='<span><a class="weeklyMPrice" href="javascript:void(0);" id="weeklyMPrice_'+countSeasons+'">M</a></span>';
	appendHTML +='<span><a class="weekly0Price" href="javascript:void(0);" id="weekly0Price_'+countSeasons+'">0</a></span>';
	appendHTML +='</div><div class="pan2">';
	appendHTML +='<span><a class="weekly5Price" href="javascript:void(0);" id="weekly5Price_'+countSeasons+'">5</a></span>';
	appendHTML +='<span><a class="weekly10Price" href="javascript:void(0);" id="weekly10Price_'+countSeasons+'">10</a></span>';
	appendHTML +='<span><a class="weekly15Price" href="javascript:void(0);" id="weekly15Price_'+countSeasons+'">15</a></span>';
	appendHTML +='<span><a class="weekly20Price" href="javascript:void(0);" id="weekly20Price_'+countSeasons+'">20</a></span>';
	appendHTML +='<span><a class="weekly25Price" href="javascript:void(0);" id="weekly25Price_'+countSeasons+'">25</a></span>';
	appendHTML +='<span><a class="weekly30Price" href="javascript:void(0);" id="weekly30Price_'+countSeasons+'">30</a></span>';
	appendHTML +='<span><a class="weekly35Price" href="javascript:void(0);" id="weekly35Price_'+countSeasons+'">35</a></span>';
	appendHTML +='<span><a class="weekly40Price" href="javascript:void(0);" id="weekly40Price_'+countSeasons+'">40</a></span>';
	appendHTML +='<span><a class="weekly45Price" href="javascript:void(0);" id="weekly45Price_'+countSeasons+'">45</a></span>';
	appendHTML +='<span><a class="weekly50Price" href="javascript:void(0);" id="weekly50Price_'+countSeasons+'">50</a></span>';
	appendHTML +='</div></div></div>';
	appendHTML +='<div class="col-sm-12 input-icon"><i class="fa fa-money"></i>';
	appendHTML +='<input type="text" id="weeklyprice_'+countSeasons+'" data-type="number" data-required="true" class="form-control required" name="season_weekly['+year+'][]" value="">';
	appendHTML +='</div>';
	
	appendHTML +='</div>';
	appendHTML +='<div class="col-sm-4 rentMonthlyPricePan"><div class="col-sm-12">';
	appendHTML +='<label class="req" for="reg_input_name">MonthlyPrice</label><br>';
	appendHTML +='</div>';
	
	appendHTML +='<div class="col-sm-12">';
	appendHTML +='<div class="monthlyAutoPricePan" id="monthlyPricePan_'+countSeasons+'" data-year="'+year+'">';
	appendHTML +='<div class="pan1">';
	appendHTML +='<span><a class="monthlyMPrice" href="javascript:void(0);" id="monthlyMPrice_'+countSeasons+'">M</a></span>';
	appendHTML +='<span><a class="monthly0Price" href="javascript:void(0);" id="monthly0Price_'+countSeasons+'">0</a></span>';
	appendHTML +='</div>';
	appendHTML +='<div class="pan2">';
	appendHTML +='<span><a class="monthly5Price" href="javascript:void(0);" id="monthly5Price_'+countSeasons+'">5</a></span>';
	appendHTML +='<span><a class="monthly10Price" href="javascript:void(0);" id="monthly10Price_'+countSeasons+'">10</a></span>';
	appendHTML +='<span><a class="monthly15Price" href="javascript:void(0);" id="monthly15Price_'+countSeasons+'">15</a></span>';
	appendHTML +='<span><a class="monthly20Price" href="javascript:void(0);" id="monthly20Price_'+countSeasons+'">20</a></span>';
	appendHTML +='<span><a class="monthly25Price" href="javascript:void(0);" id="monthly25Price_'+countSeasons+'">25</a></span>';
	appendHTML +='<span><a class="monthly30Price" href="javascript:void(0);" id="monthly30Price_'+countSeasons+'">30</a></span>';
	appendHTML +='<span><a class="monthly35Price" href="javascript:void(0);" id="monthly35Price_'+countSeasons+'">35</a></span>';
	appendHTML +='<span><a class="monthly40Price" href="javascript:void(0);" id="monthly40Price_'+countSeasons+'">40</a></span>';
	appendHTML +='<span><a class="monthly45Price" href="javascript:void(0);" id="monthly45Price_'+countSeasons+'">45</a></span>';
	appendHTML +='<span><a class="monthly50Price" href="javascript:void(0);" id="monthly50Price_'+countSeasons+'">50</a></span>';
	appendHTML +='</div></div></div>';
	
	
	appendHTML +='<div class="col-sm-12 input-icon"><i class="fa fa-money"></i>';
	appendHTML +='<input type="text" id="monthlyprice_'+countSeasons+'" data-type="number" data-required="true" class="form-control required" name="season_monthly['+year+'][]" value="">';
	appendHTML +='<input type="hidden" id="monthlydisc_'+countSeasons+'" data-type="number" data-required="true" class="form-controltwo required" name="disc_monthly['+year+'][]" value="">';
	appendHTML +='</div>';
	
	appendHTML +='</div>';
	appendHTML +='<div style="clear: both"></div><br class="spacer" /><br class="spacer" />';
	appendHTML +='<div class="col-sm-4">';
	appendHTML +='<div class="col-sm-12">';
	appendHTML +='<label class="req" for="reg_input_name">Minimum Rental Days</label>';
	appendHTML +='</div>';
	appendHTML +='<div class="col-sm-12 input-icon">';
	appendHTML +='<i class="fa fa-exclamation"></i>';
	appendHTML +='<input type="text" id="minrental_'+countSeasons+'" data-type="number" data-required="true" class="form-control required" name="minimum_rental_days['+year+'][]" value="">';
	appendHTML +='</div></div>';
	appendHTML +='<div class="col-sm-4"><div class="col-sm-12">';
	appendHTML +='<label class="req" for="reg_input_name">Season Start Date</label>';
	appendHTML +='</div><div class="col-sm-12 input-icon">';
	appendHTML +='<i class="fa fa-calendar"></i>';
	appendHTML +='<input type="text" id="start_date_'+year+"_"+countSeasons+'" data-element="'+countSeasons+'" data-year="'+year+'" name="season_start_date['+year+'][]" class="season_start_date form-control required rental_start_date date_start_'+countSeasons+'" data-required="true"  value="">';
	appendHTML +='</div></div>';
	appendHTML +='<div class="col-sm-4"><div class="col-sm-12">';
	appendHTML +='<label class="req" for="reg_input_name">Season End Date</label>';
	appendHTML +='</div>';
	appendHTML +='<div class="col-sm-12 input-icon">';
	appendHTML +='<i class="fa fa-calendar"></i>';
	appendHTML +='<input type="text" id="end_date_'+year+'_'+countSeasons+'" data-element="'+countSeasons+'" data-year="'+year+'"  name="season_end_date['+year+'][]" class="season_start_date form-control required rental_end_date date_end_'+countSeasons+'" data-required="true" value="" readonly="">';
	appendHTML +='</div></div>';
	
	appendHTML +='<div style="clear: both"></div><br class="spacer" /><br class="spacer" />';
	
	appendHTML +='<div class="col-sm-12"><div class="col-sm-12 text-center">';
	appendHTML +='<div class="defaultSeason">';
	appendHTML +='<label class="req" for="reg_input_name"> Is Default Season ?</label>';
	appendHTML +='<input type="hidden" value="No" class="is_default_hidden_class" id="is_default_hidden_'+countSeasons+'" name="is_default_hidden['+year+'][]">';
	appendHTML +='<input type="radio" name="isDefault['+year+'][]" id="isdefault_'+countSeasons+'" class="form-controltwo seasonDefault custom-radio" onclick="javascript:setDefault('+countSeasons+');" value="'+countSeasons+'" >';
	appendHTML +='</div></div></div><div style="clear: both"></div></div>';
	
	
		$('#' + appendToID).append(appendHTML);
		
		var custom_date_format="dd/mm/yy";
		var elemID=Number(last_id1)+1;
		end_dt =$.datepicker.parseDate( custom_date_format ,$('#'+appendToID +' #end_date_'+year+'_'+last_id1).val());
		var next_date=getNextPreDate(end_dt,'next');
		$( "#"+appendToID +" #start_date_"+year+'_'+elemID ).datepicker( "option", "minDate",next_date);
		$( "#"+appendToID +" #start_date_"+year+'_'+elemID ).datepicker( "option", "maxDate",next_date);
		$( "#"+appendToID +" #start_date_"+year+'_'+elemID ).val($.datepicker.formatDate(custom_date_format, next_date));
		
		var itemType =$('ul.yeartab  li.active').attr('data-itemtype');
		getDatepicker(itemType);
		
		
		return false;
	}
    	return false;
	}else{
		$.scojs_message("Please add start date and end date of previous season", $.scojs_message.TYPE_ERROR);
		
		return false;
	}
	
	return false;
	
}

    
 function setDefault(id){
	var defaultID	= 'isdefault_' + id;
	
	$('.defaultSeason').removeClass('active');	
	//$('#' + defaultID).parent().addClass('active');
	$(".is_default_hidden_class").val("No");
	$("#is_default_hidden_"+id).val("Yes");
	
	$(".iradio_minimal-grey").removeClass("checked");
	$("#"+defaultID).parent().addClass("checked");
    }
   
   
    $(document).ready(function(){
	

	// Remove Season
	$(document).on('click', '.removeSeason', function(){
	    var appendToID		= 'tableSeasons_' + year;
	    var custom_date_format="dd/mm/yy";
	    var removalPanID	= $(this).attr('id').replace('removeSeason_', '');
	    var removalPanID	= removalPanID.split('_');
	    var removalID	= removalPanID[0];
	    var year		= removalPanID[1];
	    if($(this).parents(".sub-season").find(".seasonDefault").prop("checked")==false )
	    {
		$(this).parents(".sub-season").addClass("remove_box");
		var parent_id=$(this).parents(".sub-season").attr("id");
		var data_element=$(this).parents(".sub-season").attr("id").replace("season_",'');
		var year=$(this).parents(".tableSeasons").attr("id").replace("tableSeasons_",'');
		
		 var count=0, start_date_change_count=0, start_date="";
		 $(this).parents('.tableSeasons').find(".sub-season").each(function(){
			if (count > 0) {
				count =Number(count)+1;
				var s_no=count-1;
				
				$(this).find("h3").html( "Season "+ s_no );
				$(this).find(".removeSeason").attr("id","removeSeason_"+s_no+"_"+year);
				$(this).find('input[id^="dailyPriceTmp"]').attr("id","dailyPriceTmp_"+s_no);
				$(this).find('input[id^="dailydisc_"]').attr("id","dailyPriceTmp_"+year+"_"+s_no);
				$(this).find('input[id^="dailyprice_"]').attr("id","dailyprice_"+s_no);
				$(this).find('input[id^="weeklydisc_"]').attr("id","weeklydisc_"+s_no);
				$(this).find('input[id^="weeklydisc_"]').attr("id","weeklydisc_"+s_no);
				$(this).find('input[id^="weeklyprice_"]').attr("id","weeklyprice_"+s_no);
				$(this).find('input[id^="weeklyprice_"]').attr("id","weeklyprice_"+s_no);
				$(this).find('input[id^="monthlydisc_"]').attr("id","monthlydisc_"+s_no);
				$(this).find('input[id^="monthlyprice_"]').attr("id","monthlyprice_"+s_no);
				
				$(this).find('div[id^="monthlyPricePan_"]').attr("id","monthlyPricePan_"+s_no);
				$(this).find('div[id^="weeklyPricePan_"]').attr("id","weeklyPricePan_"+s_no);
				$(this).find('div[id^="dailyPricePan_"]').attr("id","dailyPricePan_"+s_no);
				
				$(this).find('input[id^="minrental_"]').attr("id","minrental_"+s_no);
				
				$(this).find('input[id^="start_date_"]').attr("id","start_date_"+year+"_"+s_no);
				$(this).find('input[id^="start_date_"]').attr("data-element",s_no);
				
				$(this).find('input[id^="start_date_"]').removeClass("date_start_"+count);
				$(this).find('input[id^="start_date_"]').addClass("date_start_"+s_no);
				
				$(this).find('input[id^="end_date_"]').attr("id","end_date_"+year+"_"+s_no);
				$(this).find('input[id^="end_date_"]').attr("data-element",s_no);
				
				$(this).find('input[id^="end_date_"]').removeClass("date_end_"+count);
				$(this).find('input[id^="end_date_"]').addClass("date_end_"+s_no);
				
				$(this).find('input[id^="is_default_hidden_"]').attr("id","is_default_hidden_"+s_no);
				$(this).find('input[id^="is_default_hidden_"]').attr("id","is_default_hidden_"+s_no);
				$(this).find('input[id^="isdefault_"]').attr("id","isdefault_"+s_no);
				$(this).find('input[id^="isdefault_"]').attr("onclick","setDefault("+s_no+")");
				$(this).find('input[id^="isdefault_"]').attr("value",s_no);
				
				$(this).find('a.dailyMPrice').attr("id","dailyMPrice_"+s_no);
				$(this).find('a[id^="daily0Price_"]').attr("id","daily0Price_"+s_no);
				$(this).find('a[id^="daily5Price_"]').attr("id","daily5Price_"+s_no);
				$(this).find('a[id^="daily10Price_"]').attr("id","daily10Price_"+s_no);
				$(this).find('a[id^="daily15Price_"]').attr("id","daily15Price_"+s_no);
				$(this).find('a[id^="daily20Price_"]').attr("id","daily20Price_"+s_no);
				$(this).find('a[id^="daily25Price_"]').attr("id","daily25Price_"+s_no);
				$(this).find('a[id^="daily30Price_"]').attr("id","daily30Price_"+s_no);
				$(this).find('a[id^="daily35Price_"]').attr("id","daily35Price_"+s_no);
				$(this).find('a[id^="daily40Price_"]').attr("id","daily40Price_"+s_no);
				$(this).find('a[id^="daily45Price_"]').attr("id","daily45Price_"+s_no);
				$(this).find('a[id^="daily50Price_"]').attr("id","daily50Price_"+s_no);
				
				$(this).find('a[id^="weeklyMPrice_"]').attr("id","weeklyMPrice_"+s_no);
				$(this).find('a[id^="weekly0Price_"]').attr("id","weekly0Price_"+s_no);
				$(this).find('a[id^="weekly5Price_"]').attr("id","weekly5Price_"+s_no);
				$(this).find('a[id^="weekly10Price_"]').attr("id","weekly10Price_"+s_no);
				$(this).find('a[id^="weekly15Price_"]').attr("id","weekly15Price_"+s_no);
				$(this).find('a[id^="weekly20Price_"]').attr("id","weekly20Price_"+s_no);
				$(this).find('a[id^="weekly25Price_"]').attr("id","weekly25Price_"+s_no);
				$(this).find('a[id^="weekly30Price_"]').attr("id","weekly30Price_"+s_no);
				$(this).find('a[id^="weekly35Price_"]').attr("id","weekly35Price_"+s_no);
				$(this).find('a[id^="weekly40Price_"]').attr("id","weekly40Price_"+s_no);
				$(this).find('a[id^="weekly45Price_"]').attr("id","weekly45Price_"+s_no);
				$(this).find('a[id^="weekly50Price_"]').attr("id","weekly50Price_"+s_no);
				
				$(this).find('a[id^="monthlyMPrice_"]').attr("id","monthlyMPrice_"+s_no);
				$(this).find('a[id^="monthly0Price_"]').attr("id","monthly0Price_"+s_no);
				$(this).find('a[id^="monthly5Price_"]').attr("id","monthly5Price_"+s_no);
				$(this).find('a[id^="monthly10Price_"]').attr("id","monthly10Price_"+s_no);
				$(this).find('a[id^="monthly15Price_"]').attr("id","monthly15Price_"+s_no);
				$(this).find('a[id^="monthly20Price_"]').attr("id","monthly20Price_"+s_no);
				$(this).find('a[id^="monthly25Price_"]').attr("id","monthly25Price_"+s_no);
				$(this).find('a[id^="monthly30Price_"]').attr("id","monthly30Price_"+s_no);
				$(this).find('a[id^="monthly35Price_"]').attr("id","monthly35Price_"+s_no);
				$(this).find('a[id^="monthly40Price_"]').attr("id","monthly40Price_"+s_no);
				$(this).find('a[id^="monthly45Price_"]').attr("id","monthly45Price_"+s_no);
				$(this).find('a[id^="monthly50Price_"]').attr("id","monthly50Price_"+s_no);
				
				
				if (start_date_change_count==0) {
					
					$(this).find('input[id^="start_date_"]').val(start_date);
					start_date_change_count=1;					
				}
				
			}
			if (parent_id == $(this).attr("id") ) {
				start_date=$(this).find('input[id^="start_date_"]').val();
				count=Number(data_element);		
			}
			
		 });
		
		    
		   // return false;
		
		$('#tableSeasons_' + year + ' .remove_box').slideUp('slow',function(){
		     var count=1;
		        $('#tableSeasons_' + year + ' .remove_box').remove();
			$('#tableSeasons_' + year ).find(".sub-season").each(function(){
			       $(this).attr("id","season_"+count);
			       count=Number(count)+1;
			});
			
			$('.rental_end_date').datepicker("destroy");
			$('.rental_start_date').datepicker("destroy");
			var itemType =$('ul.yeartab  li.active').attr('data-itemtype');
			getDatepicker(itemType);
			
			//$('.rental_end_date').datepicker( "option", "minDate",next_date);;
			//getDatepicker('');
			
			
			//$("#start_date_" + year + "_" + removalID).datepicker("destroy");
			//$("#end_date_" + year + "_" + removalID).datepicker("destroy");
			//$("#start_date_" + year + "_" + removalID).removeClass("hasDatepicker");
			//$("#end_date_" + year + "_" + removalID).removeClass("hasDatepicker");
		});
		
		//var itemType =$('ul.yeartab  li.active').attr('data-itemtype');
		//getDatepicker(itemType);
		
	    }else{
		 $.scojs_message("Default season can not be deleted", $.scojs_message.TYPE_ERROR);
		    
	    }
	});
	
	// Daily price keyup tracking
	$(document).on('keyup', '.daily-price-fld', function(){
	    var elemVal = $(this).val();	
	    var elemID = $(this).attr('id').replace('dailyprice_', '');
	    var tmpPan = 'dailyPriceTmp_' + elemID;
	    $('#' + tmpPan).val(elemVal);
	});
	
	// Daily price percent calculation
	$(document).on('click', '.dailyMPrice, .daily0Price, .daily5Price, .daily10Price, .daily15Price, .daily20Price, .daily25Price, .daily30Price, .daily35Price, .daily40Price, .daily45Price, .daily50Price', function(){
		
		
	    var year_element=$(this).parents(".dailyAutoPricePan").attr('data-year');
	    var btnValue		= $(this).html();
	    var panIDReplacer	= 'daily'+btnValue+'Price_';
	    var panID		= $(this).attr('id').replace(panIDReplacer, '');	
	    var dailyPricePan	= 'dailyprice_' + panID;
	    var dailyPriceTmpPan	= 'dailyPriceTmp_' + panID;	
	    var dailydiscPan	= 'dailydisc_' + panID;
	    var dailyPriceValue	= $('#season_pan_'+year_element+' #' + dailyPricePan).val();
	    var dailyPriceTmpValue	= $('#season_pan_'+year_element+' #' + dailyPriceTmpPan).val();
	    
	    if (btnValue == 'M') {
		$('#dailyPricePan_' +panID+' a').removeClass('active');
		$(this).addClass('active');
		$('#' + dailyPricePan).val('');
		$('#' + dailydiscPan).val(btnValue);
		$('#'+dailyPricePan).attr('readonly', false);
	    }else{	    
		if (parseInt(dailyPriceValue) > 0) {		
		    var intermediateValue	= (btnValue/100);	
		    var dailyPriceValueNew	= dailyPriceTmpValue*intermediateValue;
		    dailyPriceValueNew	= dailyPriceTmpValue-dailyPriceValueNew;
		    $('#season_pan_'+year_element+' #' + dailyPricePan).val(dailyPriceValueNew.toFixed(2));
		    $('#season_pan_'+year_element+' #' + dailydiscPan).val(btnValue);
		    //$('#'+dailyPricePan).attr('readonly', true);
		    $('#season_pan_'+year_element+' #dailyPricePan_' +panID+' a').removeClass('active');
		    $(this).addClass('active');
		}else{
		   var season=$(this).parents(".sub-season").find("h3").text();	
		    $.scojs_message("Please Enter Daily Price in "+year_element+" : "+ season+" ", $.scojs_message.TYPE_ERROR);
		    
		    $('#' + dailyPricePan).focus();
		}
	    }
	});
	
	// Weekly price percent calculation
	$(document).on('click', '.weeklyMPrice, .weekly0Price, .weekly5Price, .weekly10Price, .weekly15Price, .weekly20Price, .weekly25Price, .weekly30Price, .weekly35Price, .weekly40Price, .weekly45Price, .weekly50Price', function(){
		
		var year_element=$(this).parents(".weeklyAutoPricePan").attr('data-year');
		var btnValue		= $(this).html();
		var panIDReplacer	= 'weekly'+btnValue+'Price_';
		var panID		= $(this).attr('id').replace(panIDReplacer, '');
		var weeklyPricePan	= 'weeklyprice_' + panID;
		var weeklydiscPan	= 'weeklydisc_' + panID;
		var dailyPricePan	= 'dailyprice_' + panID;
		
		var dailyPriceValue	= $('#season_pan_'+year_element+' #' + dailyPricePan).val();
		if (btnValue == 'M') {
		    $('#weeklyPricePan_' +panID+' a').removeClass('active');
		    $(this).addClass('active');
		    $('#' + weeklyPricePan).val('');
		    $('#' + weeklydiscPan).val(btnValue);
		    $('#'+weeklyPricePan).attr('readonly', false);
		}else{	    
		    if (parseInt(dailyPriceValue) > 0) {
			var intermediateValue	= 1-(btnValue/100);	
			var weeklyPriceValue	= (parseFloat(dailyPriceValue) * 7) * parseFloat(intermediateValue);
			$('#season_pan_'+year_element+' #' + weeklyPricePan).val(weeklyPriceValue.toFixed(2));
			$('#season_pan_'+year_element+' #' + weeklydiscPan).val(btnValue);
			$('#season_pan_'+year_element+' #'+weeklyPricePan).attr('readonly', true);
			$('#season_pan_'+year_element+' #weeklyPricePan_' +panID+' a').removeClass('active');
			$(this).addClass('active');
		    }else{
			
			var season=$(this).parents(".sub-season").find("h3").text();	
		        $.scojs_message("Please Enter Daily Price in "+year_element+" : "+ season+" ", $.scojs_message.TYPE_ERROR);
			$('#' + dailyPricePan).focus();
		    }
		}
	});
	
	// Monthly price percent calculation
	$(document).on('click', '.monthlyMPrice, .monthly0Price, .monthly5Price, .monthly10Price, .monthly15Price, .monthly20Price, .monthly25Price, .monthly30Price, .monthly35Price, .monthly40Price, .monthly45Price, .monthly50Price', function(){
		
	    var year_element=$(this).parents(".monthlyAutoPricePan").attr('data-year');

	    var btnValue		= $(this).html();
	    var panIDReplacer	= 'monthly'+btnValue+'Price_';
	    var panID		= $(this).attr('id').replace(panIDReplacer, '');
	    var monthlyPricePan	= 'monthlyprice_' + panID;
	    var monthlydiscPan	= 'monthlydisc_' + panID;
	    var dailyPricePan	= 'dailyprice_' + panID;
	    var dailyPriceValue	= $('#season_pan_'+year_element+' #' + dailyPricePan).val();
	    
	    $('.monthlyAutoPricePan a').removeClass('active');
	    
	    if (btnValue == 'M') {

		$('#monthlyPricePan_' +panID+' a').removeClass('active');
		$(this).addClass('active');
		$('#' + monthlyPricePan).val('');
		$('#' + monthlydiscPan).val(btnValue);
		$('#'+monthlyPricePan).attr('readonly', false);
	    }else{
		if (parseInt(dailyPriceValue) > 0) {
		    var intermediateValue	= 1-(btnValue/100);	
		    var monthlyPriceValue	= (parseFloat(dailyPriceValue) * 28) * parseFloat(intermediateValue);
		    $('#season_pan_'+year_element+' #' + monthlyPricePan).val(monthlyPriceValue.toFixed(2));
		    $('#season_pan_'+year_element+' #' + monthlydiscPan).val(btnValue);
		    $('#season_pan_'+year_element+' #'+monthlyPricePan).attr('readonly', true);
		    $('#season_pan_'+year_element+'#monthlyPricePan_' +panID+' a').removeClass('active');
		    $(this).addClass('active');
		}else{
		    var season=$(this).parents(".sub-season").find("h3").text();	
		    $.scojs_message("Please Enter Daily Price in "+year_element+" : "+ season+" ", $.scojs_message.TYPE_ERROR);
		    $('#' + dailyPricePan).focus();
		}
	    }
	});
	
	var itemType =$('ul.yeartab  li.active').attr('data-itemtype');
	getDatepicker(itemType);
	
	
	

		
    });
  
  function getDatepicker(itemType){
	
	
	var custom_date_format="dd/mm/yy";
	
	$( '.rental_start_date').datepicker({
		showButtonPanel: true,
		dateFormat :custom_date_format,
		numberOfMonths: 2,
		beforeShow: function (textbox, instance) {
			var elemID_id      = $(this).attr('id').replace('start_date_', '');
			
			var elemID     = $(this).attr('data-element');
			var dataYear	=$(this).attr("data-year");
			$('#ui-datepicker-div').attr("data-element",elemID);
			
			var elemID1 = elemID-1;
			var currentYear = dataYear;
			var yearFirstDay = '01/01/'+currentYear;
			var yearLastDay = '31/12/'+currentYear;
			if (elemID > 1) {
				
				var end_date_id1 = "end_date_"+dataYear+"_"+ elemID1;
				
				var end_dt = $("#season_pan_"+currentYear+" #"+end_date_id1).val();
				end_dt =$.datepicker.parseDate( custom_date_format ,end_dt);
				var next_date=new Date( end_dt.setDate(end_dt.getDate() + 1 ) );
				
				$( "#season_pan_"+currentYear+" #start_date_"+elemID_id ).datepicker( "option", "minDate",next_date);
				$( "#season_pan_"+currentYear+" #start_date_"+elemID_id ).datepicker( "option", "maxDate",next_date);
			}else{
				
				var d1=new Date();
				var dateDiff=getDayDiff(d1,yearFirstDay);
				$( "#season_pan_"+currentYear+" #start_date_"+elemID_id ).datepicker( "option", "defaultDate",yearFirstDay);  
				$( "#season_pan_"+currentYear+" #start_date_"+elemID_id ).datepicker( "option", "minDate",yearFirstDay);
				
				$( "#season_pan_"+currentYear+" #start_date_"+elemID_id ).datepicker( "option", "maxDate",yearFirstDay);
			}
			
	
			//$("#start_date_"+).datepicker( "option", "maxDate", "31/12/"+currentYear );
			
			
		},
		beforeShowDay: function(date) {
			var currentYear	=$(this).attr("data-year");
			 
			var elemID_id      = $(this).attr('id').replace('start_date_', '');
			var start_date  = $("#season_pan_"+currentYear+" #start_date_"+elemID_id).val();
			
			var end_date  	= $("#season_pan_"+currentYear+" #end_date_"+elemID_id).val();
			
			start_date =$.datepicker.parseDate( custom_date_format ,start_date);
			end_date =$.datepicker.parseDate( custom_date_format ,end_date);
			
			
			if (start_date!=null && end_date!=null) {
				getNights(date,start_date,end_date);  // GET TOTAL NIGHTS
			}
			
			 
			if (date >= start_date && date <=end_date) {
				return [true, 'ui-state-highlight' ]; 
			}else{
				return [true, '' ]; 
			}
			//return [true, 'ui-state-default' ]; 
			
		},
		onClose: function (selectedDate) {
		    var currentYear	=$(this).attr("data-year");
			
		    var elemID      = $(this).attr('id').replace('start_date_', '');
		    
                    var end_date_id = "end_date_" + elemID;
                    $("#season_pan_"+currentYear+" #"+end_date_id).datepicker("option", "minDate", selectedDate);   
	    
		},
		onSelect: function(dateText, inst) {
			var currentYear	=$(this).attr("data-year");
			
			var elemID          = $(this).attr('id').replace('start_date_', '');
			var start_date_id   = "start_date_"+elemID;
			var end_date_id     = "end_date_"+elemID;
			
			setTimeout(function(){
				
				$( "#season_pan_"+currentYear+" #"+end_date_id ).datepicker('show');
				$( "#season_pan_"+currentYear+" #"+end_date_id ).addClass('active-cal'); 
				$( "#season_pan_"+currentYear+" #"+start_date_id ).removeClass('active-cal'); 
				
			}, 5);
			
			
		}
	});
	

	$('.rental_end_date').datepicker({		
		dateFormat :custom_date_format,
		showButtonPanel: true,	  
		numberOfMonths: 2,
		beforeShow: function (textbox, instance) {
			
			var currentYear =$(this).attr("data-year");
			
			var elemID      = $(this).attr('data-element');
			$('#ui-datepicker-div').attr("data-element",elemID);
			var end_date_id = "end_date_" +currentYear+'_'+ elemID;
			var start_date_id = "start_date_" +currentYear+'_'+ elemID;
			
			var  start_date_val=$("#season_pan_"+currentYear+" #"+start_date_id).val();
			
			
			if (start_date_id!='' && start_date_val !='')
			{
				start_date_val =$.datepicker.parseDate( custom_date_format ,start_date_val);
				
				var next_date=getNextPreDate(start_date_val,'next');
			
				var dt = currentYear;
				var dt1 = '31/12/'+dt;
				
				$("#season_pan_"+currentYear+" #"+end_date_id).datepicker( "option", "minDate",next_date);		
				$("#season_pan_"+currentYear+" #"+end_date_id).datepicker( "option", "defaultDate",next_date);
				$("#season_pan_"+currentYear+" #"+end_date_id).datepicker( "option", "maxDate", dt1 );
			}
			
			
			var end_dt = $("#season_pan_"+currentYear+" #"+end_date_id).val();
			
			if (end_dt!='') {
				elemID=Number(elemID)+1;
				end_dt =$.datepicker.parseDate( custom_date_format ,end_dt);
				var next_date=getNextPreDate(end_dt,'next');
				
				$( "#season_pan_"+currentYear+" #start_date_"+currentYear+"_"+elemID ).datepicker( "option", "minDate",next_date);
				$( "#season_pan_"+currentYear+" #start_date_"+currentYear+"_"+elemID ).datepicker( "option", "maxDate",next_date);
				$( "#season_pan_"+currentYear+" #start_date_"+currentYear+"_"+elemID ).val($.datepicker.formatDate(custom_date_format, next_date));	
			}
			
			
			
		},
		beforeShowDay: function(date) {
			 var currentYear = $(this).attr("data-year");
			
			var elemID      = $(this).attr('data-element');
			var start_date  = $("#season_pan_"+currentYear+" #start_date_"+currentYear+'_'+elemID).val();
			var end_date  	= $("#season_pan_"+currentYear+" #end_date_"+currentYear+'_'+elemID).val();
			start_date =$.datepicker.parseDate( custom_date_format ,start_date);
			end_date =$.datepicker.parseDate( custom_date_format ,end_date);
			if (start_date!=null && end_date!=null) {
				
				getNights(date,start_date,end_date);   // GET TOTAL NIGHTS
			}
			
			
			if (date >= start_date && date <=end_date) {
				return [true, 'ui-state-highlight' ]; 
			}else{
				return [true, '' ]; 
			}
			//return [true, 'ui-state-default' ]; 
			
		},
		onSelect:function(dateText){			
			var currentYear = $(this).attr("data-year");
			
			var elemID     = $(this).attr('data-element');
			var dataYear	=$(this).attr("data-year");
			
			var end_dt = $("#season_pan_"+currentYear+" #end_date_"+currentYear+'_'+elemID).val();
			
			elemID=Number(elemID)+1;
			end_dt =$.datepicker.parseDate( custom_date_format ,end_dt);
			var next_date=getNextPreDate(end_dt,'next');
			
			$( "#season_pan_"+currentYear+" #start_date_"+dataYear+"_"+elemID ).datepicker( "option", "minDate",next_date);
			$( "#season_pan_"+currentYear+" #start_date_"+dataYear+"_"+elemID ).datepicker( "option", "maxDate",next_date);
			$( "#season_pan_"+currentYear+" #start_date_"+dataYear+"_"+elemID ).val($.datepicker.formatDate(custom_date_format, next_date));
			
		}
		
		
	});
	$('body').on('mouseover', '.ui-state-hover', function(e){
	    var d1 = '';
	    var d2 = '';
	    var elemID=$(this).parents("#ui-datepicker-div").attr("data-element");
	    var dataYear=$(this).parent().attr("data-year");
	    
	    var start_element=$('#season_pan_'+itemType+ ' #start_date_'+dataYear+'_'+elemID);
	    
	    d1 = start_element.datepicker('getDate');
	    
	    var day = $(this).html();
	    var year = $(this).parent().attr("data-year");
	    var month = $(this).parent().attr("data-month");
	    var minutes=1000*60;
	    var hours=minutes*60;
	    var days=hours*24;
	    var years=days*365;
      
	    var d2 = new Date(year, month, day); 
	    
	
		d1_input = start_element.val();
		
		var diff1=Number(getDayDiff(d2,d1));
		
	    if (d1!=null && isNaN(diff1)==false) {
		getNights(d2,d1,d2);  // GET TOTAL NIGHTS
	
	    }    
	  
	});
	
  }
 
 function getNextPreDate(date,type){
	if (type=="pre") {
		//var date =$.datepicker.parseDate( custom_date_format ,date);
		var pre_date=new Date( date.setDate(date.getDate() - 1 ) );
		return pre_date;
	
	}else if (type=="next") {
		//var date =$.datepicker.parseDate( custom_date_format ,date);
		var next_date=new Date( date.setDate(date.getDate() + 1 ) );
		return next_date;	
	}
 }
 
 function leftZeroInt(str){
	var i=Number(str);
	var s="";
	if (i<10) {
		s="0"+i;
	}else{
		s=i;
	}
	return s;
 }
function getDayDiff(date1, date2){
	var date_diff="";
	var d1=new Date(date1);
	
	var d2=new Date(date2);
	date_diff=Math.floor((d1.getTime()-d2.getTime())/(1000*60*60*24));
	
	return date_diff;
}
 function getNights(date,start_date,end_date){
	
	setTimeout(function () {
		var date_diff= getDayDiff(end_date,start_date);
		
		if (date_diff < 0) {
			date_diff=0;
		}
		var buttonPane = $(date).datepicker("widget").find(".ui-datepicker-buttonpane");
		var btn = $('<a class="">' + date_diff + '  Nights </a>');
		btn.unbind("click").bind("click", function () {
		    $.datepicker._clearDate(date);
		});
		buttonPane.empty();
		btn.appendTo(buttonPane);
	}, 1);
 }
 
 
$(document).ready(function(){
	
	var itemType =$('ul.yeartab > li.active').attr('data-itemtype');
	
	$('#curr_tab').val(itemType);
	
	$('.cloneSeason').click(function(){
		var clone_exist =  $('#clone_exist').val();
		if (clone_exist == 0) {
		var last_year = Number($( ".yeartab li:last-child a" ).text());
		
		var dt = new Date("01/01/"+last_year);
		
		var last_tr = ($('.tableSeasons .sub-season').last().attr('id'));
		
		var last_id = last_tr.replace('season_', '');
		
		var last_dt = ($('#end_date_'+last_year+'_'+last_id).val());
		
		var current_year = dt.getFullYear();
		var year = dt.getFullYear()+1;
		var dt1 = '31/12/'+current_year;
		
		if (last_dt == dt1) {
			$(".loader").show();
			var pid	= $('#property_id').val();
			$.ajax({
				type: "POST",
				url:   base_url+ "property_rental/get_season/",
				data: {year: current_year,pid: pid},
				success:function(data) {
					
				    if($("#tableSeasons_"+year).length ==0){
					$( ".yeartab li.active").removeClass("active");
					var str ='<li class="active"  data-itemtype="'+year+'" >';
					str +='<a class="seasonHolder" data-toggle="tab" href="#season_pan_'+year+'" title="'+year+'">';
					str +=year;
					str +='</a>';
					str +='</li>';				
					$( ".yeartab li:last-child" ).after(str);
					$('#clone_exist').val('1');
					
					$('#myTabContent .active').removeClass('in active');
					$('#myTabContent .tab-pane').last().after(data);
					$('#season_pan_' + year).addClass('in active');
					$("#curr_tab").val(year);
					
					var itemType =$('ul.yeartab  li.active').attr('data-itemtype');
					
					getDatepicker(itemType);
					
				    }
				    $(".loader").hide();
				},
				error:function(error){
					$(".loader").hide();
				}
			});
			
		}
		else
		{
			$.scojs_message("Year "+current_year+ " is incomplete", $.scojs_message.TYPE_ERROR);
		    
		}
		}
	});
	
	
/**/	$(document).on('click', '.seasonHolder', function(){
	    $('.seasonHolder').parent().removeClass('active');
		
		var year	= $(this).parent().attr('data-itemtype');
		$(this).parent().addClass('active');
	        $("#curr_tab").val(year);
		
		
	    });
    });

$(function(){
	$(".button-box button").click(function(){
		var blank_count=0;var blank_str=[];var d_top=0, x_top=0;var date_err=0;var date_str="";
		
		$("#myTabContent input[type=text]").each(function(){
			var cur_year=$(this).parents(".tableSeasons").attr('id').replace('tableSeasons_','');
			if ($(this).val()=='') {
				$( ".yeartab li.active").removeClass("active");
				$(".yeartab").find("a[title='"+cur_year+"']").parent().addClass("active");
				
				$("#myTabContent .tab-pane").removeClass("in active");
				    $("#season_pan_"+cur_year).addClass("in active");
				    var season_name=$(this).parents(".sub-season").find("h3").html();
				   
				    blank_count =Number(blank_count)+1;
				    
				    $(this).addClass("invalid");
				    $(this).parent().addClass("state-error");
				    if ($(this).parent().find("em").length >0) {
					$(this).parent().find("em").remove();
				    }
				    $(this).parent().append("<em class='blank'>This field is required</em>");
				    if (d_top!=0) {
					d_top=$(this).parents(".sub-season").position();
					d_top=d_top.top;
				    }
				    
				    // return false;
				
			}
			else if ($(this).hasClass("rental_start_date")==true || $(this).hasClass("rental_end_date")==true) {
			     
			     
			    
			     var cur_date=$.datepicker.parseDate( 'dd/mm/yy' ,$(this).val());
			     var year =cur_date.getFullYear();
			     var data_element=$(this).attr("data-element");
			     
			     if ($(this).hasClass("rental_end_date")==true) {
				//alert($(this).attr("id")+"=>"+$(this).val());
				var start_date=$.datepicker.parseDate( "dd/mm/yy",$("#start_date_"+year+"_"+data_element).val());
				var end_date =$.datepicker.parseDate( "dd/mm/yy",	 $(this).val());
				 
				 if (start_date > end_date) {
					//alert($("#start_date_"+year+"_"+data_element).attr("id")+"=>"+start_date+"\n"+$(this).attr("id")+"=>"+end_date);
					$( ".yeartab li.active").removeClass("active");
					$(".yeartab").find("a[title='"+year+"']").parent().addClass("active");
					   
					$("#myTabContent .tab-pane").removeClass("in active");
					$("#season_pan_"+year).addClass("in active");
					
					$("#myTabContent .tab-pane").removeClass("in active");
					$("#season_pan_"+year).addClass("in active");
					var season_name=$(this).parents(".sub-season").find("h3").html();				   
					 date_err=Number(date_err)+1;
					
					date_str="Enter Wrong date in "+year+": "+season_name;
					
					$(this).addClass("invalid");
					$(this).parent().addClass("state-error");
					if ($(this).parent().find("em").length >0) {
					    $(this).parent().find("em").remove();
					}
					$(this).parent().append("<em class='date'>Date is wrong</em>");
					if (x_top==0) {
						x_top=$(this).parents(".sub-season").position();
						x_top=x_top.top;
					}
				 }
			     }
			   
			   
			}else{
				$(this).removeClass("invalid");
				$(this).parent().removeClass("state-error");
				$(this).parent().find("em").remove();
			}
		
			
		});
		
		//return false;
		if (blank_count > 0) {
			
			
			$.scojs_message("Some required fields are blank", $.scojs_message.TYPE_ERROR);
			$('html, body').animate({scrollTop : Number(d_top)+680},500);
			return false;
		}else{
			$("em.blank").parent().removeClass('state-error');
			$("em.blank").remove();
		}
		
		if (date_err > 0) {
			
			$.scojs_message(date_str, $.scojs_message.TYPE_ERROR);
			$('html, body').animate({scrollTop : Number(x_top)},500);
			return false;
		}else{
			$("em.date").remove();
		}
		
		var last_year = Number($( ".yeartab li.active a" ).attr("title"));
		
		var dt = new Date("01/01/"+last_year);
		
		var last_tr = ($('#tableSeasons_'+last_year+" .sub-season ").last().attr('id'));
		var last_id = last_tr.replace('season_', '');
		
		var last_dt = ($('#end_date_'+last_year+'_'+last_id).val());
		
		var current_year = dt.getFullYear();
		var year = dt.getFullYear()+1;
		var dt1 = '31/12/'+current_year;
		//alert(dt1+"\n"+last_dt);
		if (dt1 != last_dt) {
			$.scojs_message("Year "+current_year+" is incomplete", $.scojs_message.TYPE_ERROR);
			$('html, body').animate({scrollTop : 0},500);
			return false;
		}
		
		
	});
});