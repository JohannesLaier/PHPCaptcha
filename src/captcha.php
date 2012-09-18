<?php
	require_once 'lib/captcha.class.php';
	$_captcha = new captcha();
	$_captcha->create("img/captcha.png", "font/");
?>