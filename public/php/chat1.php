<?php

//--Initializing Arrays--//

$User = [];
$id = [];
$Message = [];

//--Check if Username has been send--//

if (isset($_POST["submit"])) {

    $username = strtolower($_POST["username"]);

    $username = ucfirst($username);

    //--Check if there are already users--//

    if (filesize('chat1_users.txt') == 0) {

        $file = fopen("chat1_users.txt", "r+");

        fwrite($file, $username . ";");

        fclose($file);

        $User = explode(";", file_get_contents('chat1_users.txt'));

    } else {

        //--Check if Username already exists--//

        $User = explode(";", file_get_contents('chat1_users.txt'));

        if (in_array($username, $User)) {

            echo '<script type="text/javascript">alert("Username already exists!");</script>';

            echo '<script type="text/javascript">location.replace("http://localhost/public_html/index.php?page=index")</script>';

        } else {

            $file = fopen("chat1_users.txt", "r+");

            $temp = file_get_contents("chat1_users.txt");

            fwrite($file, $temp . $username . ";");

            fclose($file);

            $User = explode(";", file_get_contents('chat1_users.txt'));

        }
    }

    //Assigning ID to users//

    for ($i = 0; $i <= count($User); $i++) {

        $id[$i] = $i;
        $UserId = array_combine($id, $User);
        echo "<pre>" . print_r($UserId, true) . "</pre>";
    }

    //Log In Screen//

    if (in_array($username, $UserId)) {

        echo '<script type="text/javascript">alert("Logging in...");</script>';

    }

    //foreach ($UserId as $id => $name) {

        //if ($username == $name) {

            //$key = $id;
        //}
    //}
}

//--Check if Message has been sent--//

if (isset($_POST["DATA_SENT"])) {

    $Message = strip_tags($_POST["text"]);
    $UserMessage = $_POST["username"];
    $time = date('H:i:s');

    if (filesize('chat.txt') == 0) {

        $file = fopen("chat.txt", "r+");

        fwrite($file, "<div style='background-color: lightgray; opacity: 15%;margin-top: 2%; border-radius:20px'><b><div style='float: left; padding: 2%'>" . $UserMessage . "</div></b><div style='padding-top: 2%'>&nbsp;&nbsp;&nbsp;" . $time . "</div>" . "<br><div style='padding-left: 2%'>" . $Message . "</div><br></div>");

        fclose($file);
    } else {

        $file = fopen("chat.txt", "r+");

        $temp = file_get_contents("chat.txt");

        fwrite($file, $temp . "<div style='background-color: lightgray; opacity: 15%; margin-top: 2%; border-radius:20px'><b><div style='float: left; padding: 2%'>" . $UserMessage . "</div></b><div style='padding-top: 2%'>&nbsp;&nbsp;&nbsp;" . $time . "</div>" . "<br><div style='padding-left: 2%'>" . $Message . "</div><br></div>");

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

if (isset($_POST["DATA_Logout"])) {

    $logoutUser = $_POST["userLogout"];

    $file_open = fopen("chat1_users.txt", "r+");

    while (!feof($file_open)) {

        $text = fgets($file_open);
        $Current = explode(';', $text);

    }

    fclose($file_open);

    for ($j = 0; $j < count($Current); $j++) {

        if ($Current[$j] == $logoutUser) unset($Current[$j]);

    }

    echo $Current . "<br>";

    $Current = implode(";", $Current);

    echo $Current;

    file_put_contents("chat1_users.txt", $Current);

    echo '<script type="text/javascript">alert("Logged Out...");</script>';

    echo '<script type="text/javascript">location.replace("http://ezchat.ml/pages/chatroom1.php")</script>';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Chatroom 1</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/Responsive.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<script>
    setTimeout("callButton()", 100);

    function callButton() {
        document.getElementById("content").innerHTML = "<?php include_once('chat.txt');?>";
    }
</script>

<div class="row">
    <?php include_once("../pages/nav.php") ?>
    <div id="header">
        <h1>EzChat LU | Chatroom 1</h1>
    </div>
</div>

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

    <form method="post" action="chat1.php">
        <div class="chat">
            <div id="chatContent">

                <div id="content">

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
