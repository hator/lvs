<?php

defined("STARTED") or die("<p>Unauthorized access.</p>");

class Config {

	public static $site = Array(
		"title" => "Nagradzani.pl",
		"keywords" => "Słowa kluczowe, oddzielone przecinkiem",
		"description" => "Opis witryny"
	);

	public static $db = Array(
		"host" => "localhost",
		"user" => "root",
		"password" => "",
		"dbname" => "liveshow",
		"prefix" => "lvs_"
	);
	
	public static $lottery = Array(
		"join_time" => 600
	);

}

?>
