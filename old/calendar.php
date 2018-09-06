<?php


function build_calendar($month,$year, $previousMonth, $nextMonth) {

     // Create array containing abbreviations of days of week.
     $daysOfWeek = array('S','M','T','W','T','F','S');

     // What is the first day of the month in question?
     $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

     // How many days does this month contain?
     $numberDays = date('t',$firstDayOfMonth);

     // Retrieve some information about the first day of the
     // month in question.
     $dateComponents = getdate($firstDayOfMonth);

     // What is the name of the month in question?
     $monthName = $dateComponents['month'];

     // What is the index value (0-6) of the first day of the
     // month in question.
     $dayOfWeek = $dateComponents['wday'];

     // Create the table tag opener and day headers
		 $calendar = "<h1><a class='arrow' href='calendar.php?date=$previousMonth'><</a>$monthName $year<a class='arrow' href='calendar.php?date=$nextMonth'>></a></h1>";
     $calendar .= "<table class='calendar'>";
     
     $calendar .= "<tr>";

     // Create the calendar headers

     foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header'>$day</th>";
     } 

     // Create the rest of the calendar

     // Initiate the day counter, starting with the 1st.

     $currentDay = 1;

     $calendar .= "</tr><tr>";

     // The variable $dayOfWeek is used to
     // ensure that the calendar
     // display consists of exactly 7 columns.

     if ($dayOfWeek > 0) { 
          $calendar .= "<td colspan='$dayOfWeek'>&nbsp;</td>"; 
     }
     
     $month = str_pad($month, 2, "0", STR_PAD_LEFT);
  
     while ($currentDay <= $numberDays) {

          // Seventh column (Saturday) reached. Start a new row.

          if ($dayOfWeek == 7) {

               $dayOfWeek = 0;
               $calendar .= "</tr><tr>";

          }
          
          $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
          
          $date = "$year-$month-$currentDayRel";

          $calendar .= "<td class='day' rel='$date'><a href='index.php?date=$date'>$currentDay</a></td>";

          // Increment counters
 
          $currentDay++;
          $dayOfWeek++;

     }
     
     

     // Complete the row of the last week in month, if necessary

     if ($dayOfWeek != 7) { 
     
          $remainingDays = 7 - $dayOfWeek;
          $calendar .= "<td colspan='$remainingDays'>&nbsp;</td>"; 

     }
     
     $calendar .= "</tr>";

     $calendar .= "</table>";

     return $calendar;

}
if(isset($_GET['date'])){
	$dateObject = DateTime::createFromFormat('Y-m', $_GET['date']);
}
else{
	$dateObject = DateTime::createFromFormat('Y-m', date('Y-m'));
}

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Calendar</title>
<link rel="stylesheet" href="../assets/main.css">
<style>
	.calendar{
		width: 50vw;
		height: 60vh;
		margin-left: auto;
		margin-right: auto;
		text-align: center;
		font-size: xx-large;
	}	
	
	.day{
		height: 15%;
	}
	
	.day a{
		text-decoration: none;
		color: black;
	}
	
	.arrow{
		color: black;
		text-decoration: none;
	}
</style>
</head>

<body>
	<?php
	$dateComponents = getdate();

     $month = $dateObject->format('m'); 			     
     $year = $dateObject->format('Y'); 	
		 $previousMonth = $dateObject->modify('-1 month')->format("Y-m");
		 $nextMonth = $dateObject->modify('+2 month')->format("Y-m");

     echo build_calendar($month,$year, $previousMonth, $nextMonth);
	?>
	
</body>
</html>