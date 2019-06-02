<?php
$con = mysqli_connect("localhost", "root", "", "social");
$query = "INSERT INTO test VALUES('', 'Devon')";

if(mysqli_connect_errno()) {
    echo "Failed to connect" . mysqli_errno();
}

$query = mysqli_query($con, $query);
?>
<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Feed</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <p>TEst</p>
    </body>
</html>