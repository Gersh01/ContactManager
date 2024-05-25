<?php

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

    if ($conn->connect_error) {

        return returnWithError($conn->connect_error);

    } else {
        $stmt = null;

        if ($data["showFavorites"]) {
            $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (Name like ? OR Phone like ? OR Email like ?) AND UserID = ? AND Favorited = 1 ORDER BY Favorited DESC");
        } else {
            $stmt = $conn->prepare("SELECT * FROM Contacts WHERE (Name like ? OR Phone like ? OR Email like ?) AND UserID = ? ORDER BY Favorited DESC");
        }

        $search = "%" . $data["search"] . "%";
		$stmt->bind_param("ssss", $search, $search, $search, $data["UserID"]);
		$stmt->execute();
		
		$result = $stmt->get_result();
		
		$results = 0;
        $searchResults = "";

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
