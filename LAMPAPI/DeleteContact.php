<?php


    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);


    $data = json_decode(file_get_contents('php://input'), true);


    $name = $data["name"];
    $phone = $data["phone"];
    $email = $data["email"];
    // $userID = $data["userID"];
    // $contactID = $data["contactID"];
    // $favorite = $data["favorite"];

    if (empty($data) || !isset($data["name"], $data["phone"], $data["email"])) {
        returnWithError("Invalid or missing input data");
        exit();
    }

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");


    if ($conn->connect_error) {

        returnWithError($conn->connect_error);

    } else {
        
        $stmt = $conn->prepare("DELETE FROM Contacts WHERE Name=? AND Email=? AND Phone=?");
                $stmt->bind_param("sss", $name, $email, $phone);
                $stmt->execute();

        $result = $stmt->get_result();

        if($stmt->affected_rows > 0){
                returnWithInfo();
        } else {
                returnWithError("No Records Found");
        }

        $stmt->close();
        $conn->close();

    }


    function sendResultInfoAsJson($obj) {
        header("Content-type: application/json");
        echo $obj;
    }

    function returnWithError($err) {
        $retValue = '{"deleted":"No","error":"' . $err . '"}';
        sendResultInfoAsJson($retValue);
    }

    function returnWithInfo() {
        $retValue = '{"deleted":"Yes","error":""}';
        sendResultInfoAsJson($retValue);
    }
?>
