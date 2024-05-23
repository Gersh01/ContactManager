<?php


    // ini_set('display_errors', 1);
    // ini_set('display_startup_errors', 1);
    // error_reporting(E_ALL);


    $data = json_decode(file_get_contents('php://input'), true);


    $name = $data["name"];
    $phone = $data["phone"];
    $email = $data["email"];
    $userID = $data["userID"];
    $favorite = $data["favorite"];

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");


    if ($conn->connect_error) {
        echo "Something went wrong\n";
        returnWithError($conn->connect_error);


    } else {
        $stmt = $conn->prepare("INSERT INTO Contacts (Name, Phone, Email, UserID, Favorited) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $phone, $email, $userID, $favorite);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        echo "New Contact Created\n";
        returnWithError("");
    }


    function sendResultInfoAsJson($obj) {
        header("Content-type: application/json");
        echo $obj;
    }

    function returnWithError( $err ) {
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
?>
