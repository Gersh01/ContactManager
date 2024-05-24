<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $cursor = isset($data["cursor"]) ? $data["cursor"] : 0; 
    $next = isset($data["next"]) ? $data["next"] : 1; 
    $userID = $data["userID"];

    if (empty($data) || !isset($data["userID"])) {
        returnWithError("Invalid input data");
        exit();
    }


    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");

    if ($conn->connect_error) {
        echo "Something went wrong\n";
        returnWithError($conn->connect_error);
    } else {
        if($next == 1){
            $stmt = $conn->prepare("SELECT ID, Name, Phone, Email, UserID, Favorited FROM Contacts WHERE ID > ? AND UserID = ? ORDER BY ID LIMIT 10");
        }else if($next == 0){
            $stmt = $conn->prepare("SELECT ID, Name, Phone, Email, UserID, Favorited FROM Contacts WHERE ID < ? AND ID >= ? AND UserID = ? ORDER BY DESCID LIMIT 10");
        }else{
            returnWithError("");
            exit();
        }

        $stmt->bind_param("is", $cursor, $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        $stmt->close();
        $conn->close();


        // if ($next == 0) {
        //     $contacts = array_reverse($contacts);
        // }

        sendResultInfoAsJson(json_encode(array("contacts" => $contacts)));


    }

    function sendResultInfoAsJson($obj) {
        header("Content-type: application/json");
        echo $obj;
    }

    function returnWithError($err) {
        $retValue = '{"error":"' . $err . '"}';
        sendResultInfoAsJson($retValue);
    }
?>
