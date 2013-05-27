<?php

function clean_date($str_format="d M y", $time)
{		
	$date = strtotime($time);
	$date = date($str_format , $date);
	return $date;
}

function pretty_date($date,$compareTo = NULL)
{

	$date = new DateTime($date);

	if(is_null($compareTo)) {
		$compareTo = new DateTime();
	}else{
		$compareTo = new DateTime($compareTo);
	}

	$diff = $compareTo->format('U') - $date->format('U');
	$dayDiff = floor($diff / 86400);

	if(is_nan($dayDiff) || $dayDiff < 0) {
		return '';
	}

	if($dayDiff == 0) {
		if($diff < 60) {
			return 'Just now';
		} elseif($diff < 120) {
			return '1 minute ago';
		} elseif($diff < 3600) {
			return floor($diff/60) . ' minutes ago';
		} elseif($diff < 7200) {
			return '1 hour ago';
		} elseif($diff < 86400) {
			return floor($diff/3600) . ' hours ago';
		}
	} elseif($dayDiff == 1) {
		return 'Yesterday';
	} elseif($dayDiff < 7) {
		return $dayDiff . ' days ago';
	} elseif($dayDiff == 7) {
		return '1 week ago';
	} elseif($dayDiff < (7*6)) { // Modifications Start Here
		// 6 weeks at most
		return floor($dayDiff/7) . ' weeks ago';
	} elseif($dayDiff < 365) {
		return floor($dayDiff/(365/12)) . ' months ago';
	} else {
		$years = round($dayDiff/365);
		return $years . ' year' . ($years != 1 ? 's' : '') . ' ago';
	}
}