<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $cursor = isset($data["cursor"]) ? $data["cursor"] : 0; 


    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331", "COP4331");

    if ($conn->connect_error) {
        echo "Something went wrong\n";
        returnWithError($conn->connect_error);
    } else {
        $stmt = $conn->prepare("SELECT ID, Name, Phone, Email, UserID, Favorited FROM Contacts WHERE ID > ? ORDER BY ID ASC LIMIT 10");
                    echo $cursor
                $stmt->bind_param("i", $cursor);
                $stmt->execute();
        $result = $stmt->get_result();

        $contacts = array();
        while ($row = $result->fetch_assoc()) {
            $contacts[] = $row;
        }

        $stmt->close();
        $conn->close();

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
