<?php
	function itexmo($number,$message){
		$url = 'https://www.itexmo.com/php_api/api.php';
		$itexmo = array('1' => $number, '2' => $message, '3' => 'TR-JCADV651294_M3P3B');
			$param = array(
			'http' => array(
				'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
				'method'  => 'POST',
				'content' => http_build_query($itexmo),
			)
		);
		$context  = stream_context_create($param);
		return file_get_contents($url, false, $context);
	}

	if(isset($_POST['send'])){
		if(!is_numeric($_POST['sendto'])){
			echo '<script>alert("please enter valid 11 digits cp number");</script>';
		}else{
			$number = $_POST['sendto'];
			$message = $_POST['message'];
			$response = itexmo($number, $message);

			if($response == 0){
				echo '<script>alert("Your message successfully sent");</script>';
			}else{
				echo '<script>alert("ERROR: '.$response.'");</script>';
			}
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	<title>Basic SMS</title>
</head>
<body>
	<div id="smsbox">
		<h1>Simple PHP SMS</h1>
		<form method="post">
			<p>Send to</p>
			<input type="text" name='sendto'>
			<p>Message</p>
			<textarea rows="4" cols="35" maxlength="180" name="message"></textarea>
			<input type="submit" id='send' name='send' value="Send">
			<input type="reset" id='clear' value="Clear">
		</form>
	</div>
</body>
</html>