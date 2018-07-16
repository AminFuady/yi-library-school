<?php

class Lib {
	
	public static function rupiah($value)
	{
		return number_format($value,0,',','.');
	}

	public static function spaceToDas($text){
			return str_replace(' ', '-', $text);
	}

	public static function dasToSpace($text){
			return str_replace('-', ' ', $text);
	}

	public static function getNumber($string) {
		return preg_replace('/\D/', '', $string);
	}

	public static function indoDate($date) {
		if($date=='0000-00-00') return '00-00-0000';
		return date('d-m-Y', strtotime($date));
	}

	public static function date($date) {
		if($date=='0000-00-00') return '00 00 0000';
		return date('d M Y', strtotime($date));
	}

	public static function dateTime($datetime) {
		if($datetime=='0000-00-00 00:00:00') return '00-00-0000 00:00:00';
		return date('d M Y H:i:s', strtotime($datetime));
	}

	public static function indoDateTime($datetime) {
		if($datetime=='0000-00-00 00:00:00') return '00-00-0000 00:00:00';
		return date('d-m-Y H:i:s', strtotime($datetime));
	}

	public static function arrayMonth($index=0) {
		$month = array(
			1=>'Januari',
			2=>'Februari',
			3=>'Maret',
			4=>'April',
			5=>'Mei',
			6=>'Juni',
			7=>'Juli',
			8=>'Agustus',
			9=>'September',
			10=>'Oktober',
			11=>'November',
			12=>'Desember',
		);

		if($index > 0){
			return $month[$index];
		}
		return $month;
	}
}

