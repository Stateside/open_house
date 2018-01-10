<?php
header('Cache-Control: max-age=3600');
include("packages/controller.php");
/*
if(Controller::getInstance()->isMobileDevice()){
	$deviceText = Controller::getInstance()->mobile_user_agent_switch();
}else{
	 header('Location: https://donaciones.teletoncr.com/'); 
	 exit;
}*/
?><!DOCTYPE html>
<html>
<head>
	<title>Open House</title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ"
	crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="js/script.js"></script>
</head>

<body>
	<div class="container center-block">
		<div class="row">
			<div class="col-md-12 col-xs-12 text-center mt-4">
				<h1 class="btn-logo"></h1>
			</div>
			<div class="col-md-12 col-xs-12 text-center mt-4">
				<h3>PICK A WINNER</h3>
			</div>
		</div>
		<div class="row">
			<div class="col-md-4 col-xs-4 mt-5">
				<a href="sms:2034<?=$deviceText?>" class="btn-winner btn-winner3">WINNER 3</a>
			</div>
			<div class="col-md-4 col-xs-4 mt-5">
				<a href="sms:2033<?=$deviceText?>" class="btn-winner btn-winner2">WINNER 2</a>
			</div>
			<div class="col-md-4 col-xs-4 mt-5">
				<a href="sms:2031<?=$deviceText?>" class="btn-winner btn-winner1">WINNER 1</a>
			</div>
		</div>
	</div>
	<footer>
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-xs-12 text-center mt-5">
					<p>© Copyright 2018 Stateside</p>
				</div>
			</div>
		</div>
	</footer>
<script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script>
</body>
</html>