function countdown_go() {
  
    if(timeleft > 0) {
      //  alert(timeleft);
	timeleft_func = timeleft;
	if(countdown_week=='block') {
		timevalue = Math.floor(timeleft_func/(7*24*60*60));
		timeleft_func -= timevalue*7*24*60*60;
		if(timevalue<10) timevalue = '0'+timevalue;
		$("#week span").html(timevalue);
	}
	if(countdown_day=='block') {
		timevalue = Math.floor(timeleft_func/(24*60*60));
		timeleft_func -= timevalue*24*60*60;
		if(timevalue<10) timevalue = '0'+timevalue;
		$("#day span").html(timevalue);
	}
	if(countdown_hour=='block') {
		timevalue = Math.floor(timeleft_func/(60*60));
		timeleft_func -= timevalue*60*60;
		if(timevalue<10) timevalue = '0'+timevalue;
		$("#hour span").html(timevalue);
	}
	if(countdown_minute=='block') {
		timevalue = Math.floor(timeleft_func/(60));
		timeleft_func -= timevalue*60;
		if(timevalue<10) timevalue = '0'+timevalue;
		$("#minute span").html(timevalue);
	}
	if(countdown_second=='block') {
		timevalue = Math.floor(timeleft_func/1);
		timeleft_func -= timevalue*1;
		if(timevalue<10) timevalue = '0'+timevalue;
		$("#second span").html(timevalue);
	}
    }
	timeleft-=1;
       if(timeleft == 0) { 
           alert('sdlujsl;dhl;shdsl;khdks')
	return false;
       }
}

$(document).ready(function() {
	setInterval(countdown_go,1000);
	$("#countdown").css('width',(block_count*98)+'px');
	return false;
});