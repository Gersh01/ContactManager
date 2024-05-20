<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

    if ($conn->connect_error) {

        return returnWithError($conn->connect_error);

    } else {

        $res = $conn->query("INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('{$data['firstName']}', '{$data['lastName']}','{$data['login']}', '{$data['password']}')");

        if ($res) {
            echo "New User created";
        } else {
            echo "uh oh" . $conn->error;
        }

                $conn->close();
    }
?>
