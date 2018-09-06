<?php
include_once("assets/scripts.php");

if(isset($_GET['scheduleManagement'])){
	?>
<h2>Scheduling Management Settings</h2>

<p>Turn on the columns you want to see on your scheduling screen.</p>
<h3>Circulation</h3>
<table>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementCirculationDesk" value='true' <?php if(checkSettingValue('scheduleManagementCirculationDesk') == 'true'){echo ' checked ';} ?> onchange="checkboxSetting('scheduleManagementCirculationDesk', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Desk
		</td>
	</tr>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementCirculationBackRoom" <?php if(checkSettingValue('scheduleManagementCirculationBackRoom') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementCirculationBackRoom', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		BackRoom
		</td>
	</tr>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementCirculationOther" <?php if(checkSettingValue('scheduleManagementCirculationOther') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementCirculationOther', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Other
		</td>
	</tr>
</table>

<h3>Adult Services</h3>
<table>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementAdultServicesDesk" <?php if(checkSettingValue('scheduleManagementAdultServicesDesk') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementAdultServicesDesk', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Desk
		</td>
	</tr>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementAdultServicesProgram" <?php if(checkSettingValue('scheduleManagementAdultServicesProgram') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementAdultServicesProgram', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Programs
		</td>
	</tr>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementAdultServicesMakerspace" <?php if(checkSettingValue('scheduleManagementAdultServicesMakerspace') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementAdultServicesMakerspace', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Makerspace
		</td>
	</tr>
</table>

<h3>Childrens</h3>
<table>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementChildrensDesk" <?php if(checkSettingValue('scheduleManagementChildrensDesk') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementChildrensDesk', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Desk
		</td>
	</tr>
	<tr>
		<td>
			<label class="switch">
				<input type="checkbox" id="scheduleManagementChildrensPrograms" <?php if(checkSettingValue('scheduleManagementChildrensPrograms') == 'true'){echo 'checked';} ?> onchange="checkboxSetting('scheduleManagementChildrensPrograms', this)">
				<span class="slider round"></span>
			</label>
		</td>
		<td>
		Programs
		</td>
	</tr>
</table>

	<?php
}
if(isset($_GET['hours'])){
	$settings[] = '';
	$getHoursSettingsSQL = "SELECT settingKey, settingValue FROM userSettings WHERE userID = 'COV'";
	$getHoursSettings = $connection->prepare($getHoursSettingsSQL);
	$getHoursSettings->execute();
	$getHoursSettings->bind_result($settingKey, $settingValue);
	while($getHoursSettings->fetch()){
		$settings[$settingKey] = $settingValue;
	}
	$getHoursSettings->close();
?>
<h2>Hours</h2>
Sunday: <select id="sundayOpenTime" name="sundayOpenTime" onChange="saveHours('sunday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['sunday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['sunday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['sunday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['sunday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['sunday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['sunday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['sunday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['sunday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['sunday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['sunday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['sunday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['sunday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['sunday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['sunday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['sunday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['sunday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['sunday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['sunday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['sunday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['sunday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['sunday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['sunday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['sunday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['sunday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="sundayCloseTime" name="sundayCloseTime" onChange="saveHours('sunday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['sunday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['sunday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['sunday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['sunday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['sunday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['sunday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['sunday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['sunday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['sunday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['sunday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['sunday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['sunday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['sunday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['sunday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['sunday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['sunday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['sunday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['sunday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['sunday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['sunday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['sunday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['sunday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['sunday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['sunday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Monday: <select id="mondayOpenTime" name="mondayOpenTime" onChange="saveHours('monday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['monday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['monday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['monday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['monday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['monday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['monday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['monday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['monday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['monday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['monday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['monday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['monday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['monday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['monday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['monday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['monday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['monday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['monday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['monday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['monday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['monday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['monday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['monday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['monday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="mondayCloseTime" name="mondayCloseTime" onChange="saveHours('monday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['monday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['monday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['monday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['monday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['monday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['monday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['monday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['monday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['monday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['monday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['monday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['monday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['monday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['monday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['monday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['monday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['monday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['monday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['monday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['monday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['monday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['monday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['monday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['monday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Tuesday: <select id="tuesdayOpenTime" name="tuesdayOpenTime" onChange="saveHours('tuesday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['tuesday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['tuesday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['tuesday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['tuesday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['tuesday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['tuesday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['tuesday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['tuesday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['tuesday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['tuesday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['tuesday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['tuesday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['tuesday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['tuesday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['tuesday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['tuesday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['tuesday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['tuesday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['tuesday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['tuesday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['tuesday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['tuesday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['tuesday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['tuesday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="tuesdayCloseTime" name="tuesdayCloseTime" onChange="saveHours('tuesday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['tuesday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['tuesday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['tuesday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['tuesday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['tuesday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['tuesday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['tuesday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['tuesday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['tuesday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['tuesday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['tuesday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['tuesday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['tuesday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['tuesday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['tuesday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['tuesday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['tuesday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['tuesday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['tuesday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['tuesday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['tuesday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['tuesday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['tuesday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['tuesday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Wednesday: <select id="wednesdayOpenTime" name="wednesdayOpenTime" onChange="saveHours('wednesday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['wednesday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['wednesday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['wednesday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['wednesday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['wednesday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['wednesday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['wednesday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['wednesday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['wednesday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['wednesday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['wednesday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['wednesday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['wednesday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['wednesday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['wednesday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['wednesday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['wednesday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['wednesday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['wednesday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['wednesday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['wednesday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['wednesday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['wednesday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['wednesday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="wednesdayCloseTime" name="wednesdayCloseTime" onChange="saveHours('wednesday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['wednesday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['wednesday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['wednesday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['wednesday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['wednesday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['wednesday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['wednesday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['wednesday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['wednesday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['wednesday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['wednesday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['wednesday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['wednesday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['wednesday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['wednesday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['wednesday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['wednesday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['wednesday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['wednesday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['wednesday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['wednesday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['wednesday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['wednesday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['wednesday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Thursday: <select id="thursdayOpenTime" name="thursdayOpenTime" onChange="saveHours('thursday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['thursday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['thursday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['thursday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['thursday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['thursday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['thursday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['thursday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['thursday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['thursday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['thursday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['thursday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['thursday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['thursday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['thursday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['thursday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['thursday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['thursday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['thursday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['thursday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['thursday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['thursday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['thursday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['thursday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['thursday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="thursdayCloseTime" name="thursdayCloseTime" onChange="saveHours('thursday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['thursday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['thursday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['thursday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['thursday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['thursday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['thursday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['thursday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['thursday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['thursday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['thursday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['thursday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['thursday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['thursday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['thursday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['thursday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['thursday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['thursday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['thursday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['thursday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['thursday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['thursday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['thursday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['thursday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['thursday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Friday: <select id="fridayOpenTime" name="fridayOpenTime" onChange="saveHours('friday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['friday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['friday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['friday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['friday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['friday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['friday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['friday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['friday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['friday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['friday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['friday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['friday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['friday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['friday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['friday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['friday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['friday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['friday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['friday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['friday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['friday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['friday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['friday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['friday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="fridayCloseTime" name="fridayCloseTime" onChange="saveHours('friday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['friday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['friday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['friday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['friday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['friday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['friday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['friday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['friday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['friday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['friday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['friday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['friday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['friday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['friday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['friday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['friday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['friday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['friday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['friday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['friday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['friday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['friday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['friday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['friday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<br>
Saturday: <select id="saturdayOpenTime" name="saturdayOpenTime" onChange="saveHours('saturday', 'open', this.value)">
	<option value="00:00:00" <?php if($settings['saturday-open'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['saturday-open'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['saturday-open'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['saturday-open'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['saturday-open'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['saturday-open'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['saturday-open'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['saturday-open'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['saturday-open'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['saturday-open'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['saturday-open'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['saturday-open'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['saturday-open'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['saturday-open'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['saturday-open'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['saturday-open'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['saturday-open'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['saturday-open'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['saturday-open'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['saturday-open'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['saturday-open'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['saturday-open'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['saturday-open'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['saturday-open'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select> -
<select id="saturdayCloseTime" name="saturdayCloseTime" onChange="saveHours('saturday', 'close', this.value)">
	<option value="00:00:00" <?php if($settings['saturday-close'] == '00:00:00') echo ' selected' ?>>12:00 AM</option>
	<option value="01:00:00" <?php if($settings['saturday-close'] == '01:00:00') echo ' selected' ?>>1:00 AM</option>
	<option value="02:00:00" <?php if($settings['saturday-close'] == '02:00:00') echo ' selected' ?>>2:00 AM</option>
	<option value="03:00:00" <?php if($settings['saturday-close'] == '03:00:00') echo ' selected' ?>>3:00 AM</option>
	<option value="04:00:00" <?php if($settings['saturday-close'] == '04:00:00') echo ' selected' ?>>4:00 AM</option>
	<option value="05:00:00" <?php if($settings['saturday-close'] == '05:00:00') echo ' selected' ?>>5:00 AM</option>
	<option value="06:00:00" <?php if($settings['saturday-close'] == '06:00:00') echo ' selected' ?>>6:00 AM</option>
	<option value="07:00:00" <?php if($settings['saturday-close'] == '07:00:00') echo ' selected' ?>>7:00 AM</option>
	<option value="08:00:00" <?php if($settings['saturday-close'] == '08:00:00') echo ' selected' ?>>8:00 AM</option>
	<option value="09:00:00" <?php if($settings['saturday-close'] == '09:00:00') echo ' selected' ?>>9:00 AM</option>
	<option value="10:00:00" <?php if($settings['saturday-close'] == '10:00:00') echo ' selected' ?>>10:00 AM</option>
	<option value="11:00:00" <?php if($settings['saturday-close'] == '11:00:00') echo ' selected' ?>>11:00 AM</option>
	<option value="12:00:00" <?php if($settings['saturday-close'] == '12:00:00') echo ' selected' ?>>12:00 PM</option>
	<option value="13:00:00" <?php if($settings['saturday-close'] == '13:00:00') echo ' selected' ?>>1:00 PM</option>
	<option value="14:00:00" <?php if($settings['saturday-close'] == '14:00:00') echo ' selected' ?>>2:00 PM</option>
	<option value="15:00:00" <?php if($settings['saturday-close'] == '15:00:00') echo ' selected' ?>>3:00 PM</option>
	<option value="16:00:00" <?php if($settings['saturday-close'] == '16:00:00') echo ' selected' ?>>4:00 PM</option>
	<option value="17:00:00" <?php if($settings['saturday-close'] == '17:00:00') echo ' selected' ?>>5:00 PM</option>
	<option value="18:00:00" <?php if($settings['saturday-close'] == '18:00:00') echo ' selected' ?>>6:00 PM</option>
	<option value="19:00:00" <?php if($settings['saturday-close'] == '19:00:00') echo ' selected' ?>>7:00 PM</option>
	<option value="20:00:00" <?php if($settings['saturday-close'] == '20:00:00') echo ' selected' ?>>8:00 PM</option>
	<option value="21:00:00" <?php if($settings['saturday-close'] == '21:00:00') echo ' selected' ?>>9:00 PM</option>
	<option value="22:00:00" <?php if($settings['saturday-close'] == '22:00:00') echo ' selected' ?>>10:00 PM</option>
	<option value="23:00:00" <?php if($settings['saturday-close'] == '23:00:00') echo ' selected' ?>>11:00 PM</option>
</select>
<?php
}
?>