<?php

	$name = $_POST['name'];
	$tel = $_POST['tel'];
	$mess = $_POST['mess'];
	
	$token = "5394604359:AAGVF7vbccMsN6Uvl_op5RWBQDk44Qyvqos";
	$chat_id = "632528489"; // 632528489 my chat_id // 1288593587 nasty chat_id // -1001542647634 group chat_id


	$txt = '<b>Повідомлення з Courier MAKEUP</b>%0A
		<b>Від:</b> ' . $name . '%0A
		<b>Телефон:</b> ' . $tel . '%0A
		<b>Повідомлення:</b> ' . $mess;

	$sendToTelegram = fopen(
		"https://api.telegram.org/bot" . $token . "/sendMessage?chat_id=" . $chat_id . "&parse_mode=html&text=" . $txt . "", "r"
	);