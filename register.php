<?php
    $user = $_POST["user"];
    $pwd = $_POST["pwd"];
    $mail = $_POST["mail"];
    $nombre = $_POST["nombre"];
    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
    $conn = new mysqli('localhost', 'root', '', 'movietrack');
    $sql = "INSERT INTO usuario (user, pwd, mail, nombre)
            VALUES ('" . $user . "', '" . $pwd_hash . "', '" . $mail . "', '" . $nombre . "')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>