$(function(){
	
	var note = $('#note'),
	ts = new Date(2012, 0, 1),
	newYear = true;
	
	if((new Date()) > ts){
		ts = (new Date()).getTime() + 3*1000;
		newYear = false;
	}
		
	$('#countdown').countdown({
		timestamp	: ts,
		callback	: function(days, hours, minutes, seconds){			
			if (days == 0 && hours == 0 && minutes == 0 && seconds == 0)
			{
				
			}
		}
	});
	
});
