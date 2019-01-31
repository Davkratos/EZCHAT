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


<div class="row">

    <?php include_once("./nav.php") ?>

</div>

<section>

    <form action="/php/chat1.php" method="post">

        <label><input type="text" name="username"></label>
        <label><input type="number" hidden name="id"></label>

        <button type="submit" name="submit">LOGIN with Username</button>

    </form>

</section>

<footer>

    <?php include_once("./footer.php")?>

</footer>

</body>
</html>