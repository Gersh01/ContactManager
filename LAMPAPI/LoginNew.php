<?php

    echo "123";

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $id = 0;
    $firstName = "";
    $lastName = "";

    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

    if ($conn->connect_error) {

        return returnWithError($conn->connect_error);

    } else {

        $stmt = $conn->prepare("SELECT ID,firstName,lastName,Login,Password FROM Users WHERE Login=? AND Password =?");
                $stmt->bind_param("ss", $data["login"], $data["password"]);
                $stmt->execute();
                $result = $stmt->get_result();

                if($row = $result->fetch_assoc()){
                        returnWithInfo( $row['firstName'], $row['lastName'], $row["ID"];                                                                                                                                                w['ID'] );
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
        $retValue = '{"id":0,"firstName":"","lastName":"","error":"' . $err . '"}';
        sendResultInfoAsJson($retValue);
    }

    function returnWithInfo($firstName, $lastName, $id) {
        $retValue = '{"id":' . $id . ',"firstName":"' . $firstName . '","lastName":"' . $lastName . '","error":""}';
        sendResultInfoAsJson($retValue);
    }
?>