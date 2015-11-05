<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<style type="text/css">
#header {
	border: 1px solid #555;
	height: 100px;
	background-color:#908886;
}
#content {
	border: 1px solid #555;
	height:3000px;
	background-color:#FFFFFF;
}
#footer {
	border: 1px solid #555;
	clear:both;
	height:100px;
	background-color:#555555;
}
</style>
<title>드래그 레이서 운영 툴</title>
</head>
<body>
	<header id="header">
		<h5>
		<?php
		if (@$this->session->userdata('logged_in') == TRUE)
		{
		?>
		계정 : <?php echo $this->session->userdata('username')?>
		<br>
		<a href="/auth/logout" class="btn">로그아웃</a>
		<?php
		}
		else
		{
		?>
		<a href="/auth/login" class="btn btn-primary">로그인</a>
		<?php
		}
		?>
		</h5>
	</header>
	