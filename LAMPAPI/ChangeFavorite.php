<?php

    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

    if ($conn->connect_error) {

        return returnWithError($conn->connect_error);

    } else {
        $stmt = $conn->prepare("UPDATE Contacts SET Favorited=? WHERE ID=?;");
        $stmt->bind_param("ss", $data["updatedFavorite"], $data["ID"]);
        $stmt->execute();
        $nrows = $stmt->affected_rows;

        if ($nrows > 0) {
            returnWithVerdict("");
        } else {
            returnWithVerdict("Something went wrong");
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
