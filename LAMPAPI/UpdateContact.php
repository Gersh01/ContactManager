<?php


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $data = json_decode(file_get_contents('php://input'), true);


    $name = $data["name"];
    $phone = $data["phone"];
    $email = $data["email"];
    $userID = $data["userID"];
    $favorite = $data["favorite"];

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");
    echo "1";

    if ($conn->connect_error) {

        returnWithError($conn->connect_error);

    } else {
        
        $stmt1 = $conn->prepare("SELECT ID FROM Contacts WHERE Name=? AND Phone=? AND Email=?");
        $stmt1->bind_param("sss", $name, $phone, $email);
        $stmt1->execute();
        $result = $stmt1->get_result();c

        if($row = $result->fetch_assoc()){
                $stmt = $conn->prepare("UPDATE Contacts SET Name=?, Phone=?, Email=?, Favorited=? WHERE ID=?;");
                $stmt->bind_param("sssss", $name, $phone, $email, $favorite, $row['ID']);
                $stmt->execute();
                returnWithInfo();
        } else {
                returnWithError("No Records Found");
        }


        $stmt1->close();
        $stmt->close();
        $conn->close();

    }


    function sendResultInfoAsJson($obj) {
        header("Content-type: application/json");
        echo $obj;
    }

    function returnWithError($err) {
        $retValue = '{"updated":"No","error":"' . $err . '"}';
        sendResultInfoAsJson($retValue);
    }

    function returnWithInfo() {
        $retValue = '{"updated":"Yes","error":""}';
        sendResultInfoAsJson($retValue);
    }
?>
