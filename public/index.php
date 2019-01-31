<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EzChat</title>
    <link rel="stylesheet" href="style/Responsive.css" type="text/css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class="row">

    <?php include_once("./pages/nav.php") ?>

</div>

<?php

$currentPage = "";

if(isset($_GET['page'])){

$currentPage = $_GET['page'];

}

if($currentPage === 'Chat1'){

include_once "./pages/chatroom1.php";

}elseif ($currentPage === 'Chat2'){

include_once "./pages/chatroom2.php";

}else{

include_once "index.php";

}
include_once "./pages/footer.php";

?>

<script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
</script>

</body>
</html>