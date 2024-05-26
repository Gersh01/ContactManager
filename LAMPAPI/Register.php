<?php

    echo "123";

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

    if ($conn->connect_error) {

        return returnWithError($conn->connect_error);

    } else {

        $unique = true;

        $stmt = $conn->prepare("SELECT Login FROM Users WHERE Login=?");
        $stmt->bind_param("s", $data["login"]);
        $stmt->execute();
        $result = $stmt->get_result();
        

        while ($row = $result->fetch_assoc()) {

            // someone has same name as user trying to register
            if (strcmp($row["Login"], $data["login"]) == 0) {
                $unique = false;
            }
        }

        if ($unique) {

            # add user if username is unique
            $res = $conn->query("INSERT INTO Users (FirstName, LastName, Login, Password) VALUES ('{$data['firstName']}', '{$data['lastName']}','{$data['login']}', '{$data['password']}')");
    
            if ($res) {
                
                returnWithVerdict("new user created");

            } else {
                returnWithVerdict($conn->error);
            }

        } else {
            returnWithVerdict("login was taken");
        }

    }


    function sendResultInfoAsJson($obj) {
        header("Content-type: application/json");
        echo $obj;
    }

    function returnWithVerdict($verdict) {
        $retValue = '{"verdict":"' . $verdict . '"}';
        sendResultInfoAsJson($retValue);
    }
?>
