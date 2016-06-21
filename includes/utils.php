<?php
function hasDateExpired($startDate){

		$date = date('Y-m-d H:i:s');
		$currentDate = strtotime($date);
		$lock_time = $currentDate+(60*10);

		$start_time = strtotime($startDate);

		return $start_time >= $lock_time;
}
?>