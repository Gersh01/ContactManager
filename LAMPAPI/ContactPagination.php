<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $cursor = isset($data["cursor"]) ? $data["cursor"] : ""; 
    $next = isset($data["next"]) ? $data["next"] : 1; 
    $userID = isset($data["userID"]) ? $data["userID"] : "";

    if (empty($data) || !isset($data["userID"])) {
        returnWithError("Missing or invalid input data");
        exit();
    }


    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");

    if ($conn->connect_error) {
        echo "Something went wrong\n";
        returnWithError($conn->connect_error);
    } else {
        if($next == 1){
            $stmt = $conn->prepare("SELECT ID, SUBSTRING_INDEX(Name, ' ', 1) AS FirstName, SUBSTRING_INDEX(Name, ' ', -1) AS LastName, Phone, Email, UserID, Favorited FROM Contacts WHERE Name > ? AND UserID = ? ORDER BY Name ASC LIMIT 10");
        }else if($next == -1){
            $stmt = $conn->prepare("SELECT ID, SUBSTRING_INDEX(Name, ' ', 1) AS FirstName, SUBSTRING_INDEX(Name, ' ', -1) AS LastName, Phone, Email, UserID, Favorited FROM Contacts WHERE Name < ? AND UserID = ? ORDER BY Name DESC LIMIT 10");
        }else{
            returnWithError(' "next" has to be 1 or -1');
            exit();
        }

        $stmt->bind_param("ss", $cursor, $userID);
        $stmt->execute();
        $result = $stmt->get_result();

        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        $stmt->close();
        $conn->close();


        if ($next == -1) {
            $contacts = array_reverse($contacts);
        }

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
