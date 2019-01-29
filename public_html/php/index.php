<?php

	$User = [];
	$id = [];
	$Message = [];

	if (isset($_POST["submit"])) {

		$username = strtolower($_POST["username"]);

		if (filesize('chat1_users.txt') == 0) {

			$file = fopen("chat1_users.txt", "r+");

			fwrite($file, $username . ";");

			fclose($file);

			$User = explode(";", file_get_contents('chat1_users.txt'));

		} else {

			$User = explode(";", file_get_contents('chat1_users.txt'));

			if (in_array($username, $User)) {

				echo '<script type="text/javascript">alert("Username already exists!");</script>';

				echo '<script type="text/javascript">location.replace("https://ezchat.000webhostapp.com/pages/chatroom1.html")</script>';

			} else {

				$file = fopen("chat1_users.txt", "r+");

				$temp = file_get_contents("chat1_users.txt");

				fwrite($file, $temp . $username . ";");

				fclose($file);

				$User = explode(";", file_get_contents('chat1_users.txt'));

			}
		}

		for ($i = 0; $i < count($User); $i++) {

			$id[$i] = $i;
			$UserId = array_combine($id, $User);
		}

		if (in_array($username, $UserId)) {

			echo '<script type="text/javascript">alert("Logging in...");</script>';

		}

		foreach ($UserId as $id => $name) {

			if ($username == $name) {

				$key = $id;
			}
		}
	}

	if (isset($_POST["DATA_SENT"])) {

		$Message = $_POST["text"];
		$UserMessage = $_POST["username"];

		if (filesize('chat.txt') == 0) {

			$file = fopen("chat.txt", "r+");

			fwrite($file, $UserMessage . "<br>" . $Message . "<br>" . "<br>");

			fclose($file);
		} else {

			$file = fopen("chat.txt", "r+");

			$temp = file_get_contents("chat.txt");

			fwrite($file, $temp . $UserMessage . "<br>" . $Message . "<br>" . "<br>");

			fclose($file);

		}
	}

	$username = $_POST["username"];


	$Current = [];

	$file_open = fopen("chat1_users.txt", "r+");

	while (!feof($file_open)) {

		$text = fgets($file_open);
		$Current = explode(';', $text);

	}
	fclose($file_open);


	$file_open = fopen("chat.txt", "r+");

	while (!feof($file_open)) {

		$text = fgets($file_open);
		$Chat = explode(';', $text);

	}

	fclose($file_open);

	for($x = 0; $x < count($Chat); $x++){



	}

	if(isset($_POST["DATA_Logout"])){

		$logoutUser = $_POST["userLogout"];

		$file_open = fopen("chat1_users.txt", "r+");

		while (!feof($file_open)) {

			$text = fgets($file_open);
			$Current = explode(';', $text);

		}

		fclose($file_open);

		for($j = 0; $j < count($Current); $j++){

			if($Current[$j] == $logoutUser)	unset($Current[$j]);

		}

		echo $Current . "<br>";

		$Current = implode(";", $Current);

		echo $Current;

		file_put_contents("chat1_users.txt", $Current);

		echo '<script type="text/javascript">alert("Logged Out...");</script>';

		echo '<script type="text/javascript">location.replace("https://ezchat.000webhostapp.com/pages/chatroom1.html")</script>';

	}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Chatroom 1</title>
		<link rel="stylesheet" href="../style/style.css" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script>

			setTimeout("CallButton()",100);
			function CallButton()
			{
				document.getElementById("Content").innerHTML = "<?php include_once('chat.txt');?>";
			}

		</script>

	</head>
	<body>

		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<ul class="nav navbar-nav">
					<li><a href="../index.html">Chatroomprogram</a></li>
					<li><a class="active" href="../pages/chatroom1.html">Chatroom 1</a></li>
					<li><a href="../pages/chatroom2.html">Chatroom 2</a></li>
				</ul>
			</div>
		</nav>

		<section>
			<div id="guests">

				<p id="UsersArray">

					<?php
						echo "<pre>" . print_r($Current, true) . "</pre>";
					?>

				</p>

				<form method="post">

					<?php

						echo "<input hidden type='text' name='userLogout' value=" . $username . "><br>";
						echo "<input type='submit' name='DATA_Logout' value='Logout'>";

					?>

				</form>

			</div>
			<form method="post" action="./index.php">
				<div class="chat">
					<div id="chatContent">
						<div id="Content">

						</div>
						<div id="chatEnter">
							<input name="text" id="enterText" placeholder="Enter your message" type="text">
							<button type="submit" name="DATA_SENT">Send Message</button>
							<?php

								echo "<br><input hidden type='text' name='username' value=" . $username . ">"

							?>
						</div>
					</div>
				</div>
			</form>
		</section>

	</body>
</html>
