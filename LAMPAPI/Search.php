<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

	echo "1";

    $data = json_decode(file_get_contents('php://input'), true);

	echo "2";

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

	echo "3";

    if ($conn->connect_error) {

		echo "if";
        returnWithError($conn->connect_error);

    } else {

		echo "else";
        $stmt = null;

        if ($data["showFavorites"]) {
            $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (Name like ? OR Phone like ? OR Email like ?) AND UserID = ? AND Favorited = 1 ORDER BY Favorited DESC");
        } else {
            $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (Name like ? OR Phone like ? OR Email like ?) AND UserID = ? ORDER BY Favorited DESC");
        }

		echo "4";

        $search = "%" . $data["search"] . "%";
		$stmt->bind_param("ssss", $search, $search, $search, $data["UserID"]);
		$stmt->execute();

		echo "5";
		
		$result = $stmt->get_result();
		
		echo "6";
		
		$results = 0;
        $searchResults = "";

		echo "7";

		while($row = $result->fetch_assoc()) {
			if ($results !== 0) {
				$searchResults .= ",";
			} else {
				$results++;
			}

			$parts = explode(" ", $row["Name"]);

			$searchResults .= '{"FirstName" : "' . $parts[0] . '", "LastName" : "' . $parts[1] . '", "Phone" : "' . $row["Phone"] . '", "Email" : "' . $row["Email"] . '", "Favorite" : "' . $row["Favorited"] . '"}';
		}

        if ($results == 0) {
            returnWithError("No Records Found");
        } else {
			echo $searchResults;
            returnWithInfo($searchResults);
        }

    }


    function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithError( $err )
	{
		$retValue = '{"error":"' . $err . '"}';
		sendResultInfoAsJson( $retValue );
	}
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"results":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
?>
