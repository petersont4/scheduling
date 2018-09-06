<?php

include_once("../assets/scripts.php");

$staffQuery = "SELECT userID, firstName, lastName, department, branch FROM user ORDER BY department, lastName, firstName";
if(!$staffMembers = $connection->query($staffQuery)){
	die('There was an error running the query [' . $connection->error . ']');
}

if(isset($_GET['date'])){
	$date = $_GET['date'];
	$dateFormated = DateTime::createFromFormat('Y-m-d', $date);
}
else{
	$date = date('Y-m-d');
	$dateFormated = DateTime::createFromFormat('Y-m-d', date('Y-m-d'));
}
$yesterday = $dateFormated->modify('-1 day')->format("Y-m-d");
$tomorrow = $dateFormated->modify('+1 day')->format("Y-m-d");
$times = array("1" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 08:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 09:00:00 EST')),
									 "2" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 09:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 10:00:00 EST')),
									 "3" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 10:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 11:00:00 EST')),
									 "4" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 11:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 12:00:00 EST')),
									 "5" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 12:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 13:00:00 EST')),
									 "6" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 13:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 14:00:00 EST')),
									 "7" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 14:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 15:00:00 EST')),
									 "8" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 15:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 16:00:00 EST')),
									 "9" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 16:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 17:00:00 EST')),
									 "10" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 17:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 18:00:00 EST')),
									 "11" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 18:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 19:00:00 EST')),
									 "12" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 19:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 20:00:00 EST')),
									 "13" => array(DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 20:00:00 EST'), DateTime::createFromFormat('Y-m-d H:i:s e', $date . ' 21:00:00 EST')),
									);

$locations = array("1", "2", "3", "8", "5", "7");

?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>KCPL Schedule</title>
	<link rel="stylesheet" href="../assets/main.css">
	
	<script>
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

function drop(ev, el) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
		var nodeCopy = document.getElementById(data).cloneNode(true);
		nodeCopy.id = data + "_" + Math.floor(Math.random() * 1000);
	  nodeCopy.draggable = false;
		nodeCopy.setAttribute('onclick', 'staffPopup(this)');
		el.appendChild(nodeCopy);
		var userID = nodeCopy.getAttribute('userid');
		var startTime = nodeCopy.parentElement.getAttribute('startTime');
		var stopTime = nodeCopy.parentElement.getAttribute('stopTime');
	  var desk = nodeCopy.parentElement.getAttribute('desk');
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange = function() {
    	if (this.readyState == 4 && this.status == 200) {
				if(this.responseText == 'False'){
					alert('Scheduling Conflict!');
					nodeCopy.parentNode.removeChild(nodeCopy);
				}
				else{
      		nodeCopy.setAttribute('scheduleID', this.responseText);
				}
			}
  	};
		xhttp.open("GET", "update.php?addAssignment&userID=" + userID + "&startTime=" + startTime + "&stopTime=" + stopTime + "&desk=" + desk, true);
		xhttp.send();
}
		
function staffPopup(object){
	var scheduleID = object.getAttribute('scheduleID');
	var objectID = object.getAttribute('id');
	$('#staffModal').modal();
	$.ajax({url: "staffModal.php?scheduleID=" + scheduleID, success: function(xml){
		$(xml).find('Staff').each(function(){
			$(this).find("header").each(function(){
				var header = $(this).text();
				$("#staffModalHeader").html(header);
			})
			$(this).find("content").each(function(){
				var content = $(this).text();
				$("#staffModalContent").val(content);
			})
		})
	}});
	
	document.getElementById('modalButton').setAttribute('onclick', 'unassign(' + scheduleID + ', \'' + objectID + '\')');
	document.getElementById('staffModalContent').setAttribute('onchange', 'saveData(this, ' + scheduleID + ')');
}
		
function unassign(scheduleID, objectID){
	var xhttp = new XMLHttpRequest();
	xhttp.open("GET", "update.php?removeAssignment&scheduleID=" + scheduleID, true);
		xhttp.send();
	document.getElementById(objectID).parentNode.removeChild(document.getElementById(objectID));
}
		
function saveData(e, scheduleID){
  var xhttp = new XMLHttpRequest();
  xhttp.open("GET", "update.php?notesUpdate&scheduleID=" + scheduleID + "&notes=" + encodeURIComponent( e.value ), true);
	xhttp.send();
}
</script>
		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</script>
<link rel="stylesheet" type="text/css" href="/assets/datepicker.css" /> 
<script type="text/javascript" src="../assets/datepicker.js"></script>
</head>

<body>
	<h1 onclick="return showDatePicker('scheduleDate')"> <a class="arrows" href="../index.php?date=<?php echo date('Y-m-d', strtotime($dateFormated->format('Y-m-d') . '-1 days')); ?>"><</a><a class="arrows" href="<?php echo '../calendar.php?date=' . $dateFormated->format("Y-m") ?>"> <?php echo $dateFormated->format("l, F jS, Y");?></a> <a class="arrows" href="../index.php?date=<?php echo date('Y-m-d', strtotime($dateFormated->format('Y-m-d') . '+1 days')); ?>">></a></h1>
	<div class="flexContainer">
		<div id="schedule">
		<table border="1" ondragover="allowDrop(event)" draggable="false" ondragstart="drag(event)" id="scheduleTable" style="text-align: center;">
		<tbody>
			<tr>
				<th scope="col" width="75px;"></th>
				<?php
				foreach($locations as $location){
					echo "<th scope='col' width='150px'>" . $location . "</th>";
				}
				?>
			</tr>
			<?php
			$alreadyScheduled = $connection->prepare("SELECT schedule.scheduleID, schedule.userID, users.firstName, users.lastName, users.branch, users.department FROM schedule, users WHERE users.userID = schedule.userID AND schedule.scheduleStartTime = ? AND schedule.scheduleStopTime = ? AND schedule.location = ?");
			
			foreach($times as $time){
				echo "<tr>";
					echo "<th scope='row'>" . $time[0]->format('g') . "-" . $time[1]->format('ga') . "</th>";
					foreach($locations as $location){
						echo "<td ondrop='drop(event, this)' startTime='" . $time[0]->format('Y-m-d H:i:s') . "' stopTime='" . $time[1]->format('Y-m-d H:i:s') . "' desk='" . $location . "'>";
						$scheduleStartTime = $time[0]->format('Y-m-d H:i:s');
						$scheduleStopTime = $time[1]->format('Y-m-d H:i:s');
						$desk = $location;
						$alreadyScheduled->bind_param("sss", $scheduleStartTime, $scheduleStopTime, $desk);
						$alreadyScheduled->execute();
						$scheduledAssociates = $alreadyScheduled->get_result()->fetch_all(MYSQLI_ASSOC);
						foreach($scheduledAssociates as $associate){
							$userID = $associate['userID'];
							$divID = $userID . rand(111, 999);
							$branch = $associate['branch'];
							$department = $associate['department'];
							$name = $associate['firstName'] . "<br>" . $associate['lastName'];
							$scheduleID = $associate['scheduleID'];
							echo "<div userid=\"$userID\" id=\"ID:$divID\" class=\"staffMember $branch $department\" draggable=\"false\" ondragstart=\"drag(event)\" onclick=\"staffPopup(this)\" scheduleID=\"$scheduleID\">$name</div>";
						}
						echo "</td>";
					}
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
		</div>
		<div id="staff">
			<?php
			while($staff = $staffMembers->fetch_assoc()){
				$userID = $staff['userID'];
				$name = $staff['firstName'] . "<br>" . $staff['lastName'];
				$branch = $staff['branch'];
				$department = $staff['department'];
				echo "<div userid=\"$userID\" id=\"ID:$userID\" class=\"staffMember $branch $department\" draggable=\"true\" ondragstart=\"drag(event)\">$name</div>";
			}
			?>
		</div>
	</div>
		
<!-- Modal -->
  <div class="modal fade" id="staffModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" id="staffModalHeader">Modal Header</h4>
        </div>
        <div class="modal-body">
					<textarea id="staffModalContent" style="width: 100%;" onchange>
					</textarea>
        </div>
        <div class="modal-footer">
					<button id="modalButton" type="button" class="btn btn-default" data-dismiss="modal" style="background: red; color: white;">Unschedule</button>
					<button id="modalButtonSave" type="button" class="btn btn-default" data-dismiss="modal" style="background: green; color: white;">Save</button>
        </div>
      </div>
      
    </div>
  </div>
		
</body>
</html>
