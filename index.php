<?php
    $connection = mysqli_connect("localhost", "root", "", "chatterbox");

    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_errno();
    }

    $query = mysqli_query($connection, "INSERT INTO test VALUES ('2', 'Mike Webb')");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Demo</title>
</head>
<body>
    <h1>Hello, World!!</h1>
</body>
</html>