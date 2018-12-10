<?php

class DateAndTime {

    private $day;
    private $month;
    private $year;
    private $countMonth;
    private $countDays;
    private $hour;
    private $minute;
    private $second;
    public static $a=10;

    public function __construct($data, $countMonth, $countDays) {
        $this->day = date('d', $data);
        $this->month = date('m', $data);
        $this->year = date('Y', $data);
        $this->countMonth = $countMonth;
        $this->countDays = $countDays;
        $this->hour = date('H',$data);
        $this->minute = date('i',$data);
        $this->second = date('s',$data);
       
    }

    public function getDateForPeriodInMonth() {
        $currentDay = $this->day;
        $currentMonth = $this->month;
        $currentYear = $this->year;
        $cuurentHour = $this->hour;
        $currentMinute = $this->minute;
        $currentSecond = $this->second;
        $countMonth = $this->countMonth;
        
        $lastDays;
        $lastMonths;
        $lastYears;

        $i = 1;
        $days;
        while ($i <= $countMonth) {
            $currentMonth++;
            $days = mktime($cuurentHour, $currentMinute, $currentSecond, $currentMonth, $currentDay, intval($currentYear));
            if ($currentMonth == 13) {
                $currentMonth = 1; 
                $currentYear++;
            }
            $i++;
        }
        return date('Y:m:d:H:i:s', $days);
    }

    public function getDateForPeriodFrequencyInMonth() {
        
        $currentDay = $this->day;
        $currentMonth = $this->month;
        $currentYear = $this->year;
        $countDays = $this->countDays;
        $countMonth = $this->countMonth;
        $i = 1;
        $days;
        while ($i <= $countMonth) {
            $month = $currentMonth + $i;
            $days = mktime(0, 0, 0, $month, $currentDay, $currentYear);
            echo date('Y:m:d', $days) . '</br>';
            $i++;
        }
        date('Y:m:d', $days);
    }
    
    public function addTimer($year,$month,$day,$hour,$minute,$second) {
       
       // print_r($day);
        $countdown_setting = array(
	"type" 			=> "date", /* date или time, date - отстет до указанной даты, time - отсчет указанного времени */
	"cookie" 		=> true, /* true или false, запоминать время, только для режима time */
	"position"	=> "horizontal", /* horizontal или vertical, положение блока */
	"date"			=> array(
		"year" 		=> $year,
		"month" 	=> $month,
		"day"		=> $day,
		"hour"		=> $hour,
		"minute"	=> $minute,
		"second"	=> $second
	), /* указывается конечная дата, для режима date */
	"time" 			=> array(
		"week"	=> 0,
		"day"		=> 2,
		"hour"		=> 10,
		"minute"	=> 0,
		"second"	=> 0
	), /* указывается время, для режима time */
	"visible"		=> array(
		"week"	=> array("none","недель:"),
		"day"		=> array("block","дней:"),
		"hour"		=> array("block","часов:"),
		"minute"	=> array("block","минут:"),
		"second"	=> array("block","секунд:")
	) /* настройка отображения блоков, block - показывать соответствующий блок, none - не показывать; второй параметр - заголовок блока */
);
	$time = time();

	$script='';
	$countdown_txt = '';
	$block_count = 0;
	/* Генерация html кода таймера */
	foreach($countdown_setting['visible'] AS $i => $v) {
		$countdown_txt.='<div id="'.$i.'" style="display:'.$v[0].';">'.$v[1].' <span>00</span></div>';
		$script .= '<script type="text/javascript">var countdown_'.$i.' = "'.$v[0].'";</script>';
		if($v[0]=='block') $block++;
	}
	if($countdown_setting['position'] == 'vertical') $block = 1; 
	$script .= '<script type="text/javascript">var block_count = '.$block.';</script>';
	
	/* обработка, когда указано время отсчета */
	if($countdown_setting['type'] == 'time') {
		$time_value = $countdown_setting['time']['week']*7*60*60*24+$countdown_setting['time']['day']*60*60*24+$countdown_setting['time']['hour']*60*60+$countdown_setting['time']['minute']*60+$countdown_setting['time']['second'];
		$time_new = $time+$time_value;
		/* обработка кукисов */
		if($countdown_setting['cookie']) {
			$time_cookie = (int) $_COOKIE['time'];
			if($time_cookie==0) {
				setcookie("time",$time_new);
			} else {
				//$time_value = $time_cookie-$time;
			}
		}
		$script .= '<script type="text/javascript">var timeleft='.$time_value.';</script>';
	} elseif ($countdown_setting['type'] == 'date') { /* обработка, когда указана конечная дата */
		$time_value = mktime($countdown_setting['date']['hour'],$countdown_setting['date']['minute'],$countdown_setting['date']['second'],$countdown_setting['date']['month'],$countdown_setting['date']['day'],$countdown_setting['date']['year']);
		$time_value = $time_value-$time;
                echo $time_value;
             
		echo $script .= '<script type="text/javascript">var timeleft=$time_value;</script>';
  	
	}
        return $countdown_txt;
    }
}

?>
<script type="text/javascript">
    
   $(document).ready(function() {
    var timeleft = <?php
    echo DateAndTime::$a; 
    ?>;
  //  alert(timeleft);
	setInterval(countdown_go,1000);
	$("#countdown").css('width',(block_count*98)+'px');
	return false;
});
function countdown_go(timeleft) {
  
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
         //  alert('sdlujsl;dhl;shdsl;khdks')
	return false;
       }
}



</script>