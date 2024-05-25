<?php


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);


    $data = json_decode(file_get_contents('php://input'), true);

    $conn = new mysqli("localhost", "TheBeast", "WeLoveCOP4331" ,"COP4331");

	$result = null;
    if ($conn->connect_error) {

        returnWithError($conn->connect_error);

    } else {

		$stmt = null;

		// load first page for new query
		if ($data["cursor"]["firstName"] == "") {
			$stmt = $conn->prepare("SELECT * FROM Contacts WHERE Favorited >= ? AND (Name like ? OR Phone like ? OR Email like ?) AND UserID = ? ORDER BY Favorited DESC, Name ASC, ID ASC LIMIT 10");

			$search = "%" . $data["search"] . "%";
			$stmt->bind_param("sssss", $data["showFavorites"], $search, $search, $search, $data["UserID"]);
			
		} else {
			// not loading the first page
			$name = $data["cursor"]["firstName"] . ' ' . $data["cursor"]["lastName"];
			$search = "%" . $data["search"] . "%";
			
			// going onto next page
			if ($data["next"]) {
				$stmt = $conn->prepare("SELECT * FROM Contacts WHERE Favorited >= ? AND (Name like ? OR Phone like ? OR Email like ?) AND ((Favorited < ?) or (Favorited = ? and Name > ?) or (Favorited = ? and Name = ? and ID > ?)) AND UserID = ? ORDER BY Favorited DESC, Name ASC, ID ASC LIMIT 10");
				
			} else {
				// going to previous page
				$stmt = $conn->prepare("SELECT * FROM Contacts WHERE Favorited >= ? AND (Name like ? OR Phone like ? OR Email like ?) AND ((Favorited > ?) or (Favorited = ? and Name < ?) or (Favorited = ? and Name = ? and ID < ?)) AND UserID = ? ORDER BY Favorited DESC, Name ASC, ID ASC LIMIT 10");
			}

			
			$stmt->bind_param("sssssssssss", $data["showFavorites"], $search, $search, $search, $data["cursor"]["favorite"], $data["cursor"]["favorite"], $name, $data["cursor"]["favorite"], $name, $data["cursor"]["ID"], $data["UserID"]);
		}


		$stmt->execute();
		
		$result = $stmt->get_result();
		
		$results = 0;
        $searchResults = "";

		while($row = $result->fetch_assoc()) {
			if ($results > 0) {
				$searchResults .= ",";
			}
			
			$results++;

			$parts = explode(" ", $row["Name"]);

			$searchResults .= '{' . '"ID": "' . $row["ID"] .  '", "FirstName" : "' . $parts[0] . '", "LastName" : "' . $parts[1] . '", "Phone" : "' . $row["Phone"] . '", "Email" : "' . $row["Email"] . '","UserID" : "' . $row["UserID"] . '", "Favorite" : "' . $row["Favorited"] . '"}';
		}

        if ($results == 0) {
			echo "No Records Found";
        } else {
            returnWithInfo($searchResults);
        }

    }


    function sendResultInfoAsJson( $obj )
	{
		header('Content-type: application/json');
		echo $obj;
	}
	
	function returnWithInfo( $searchResults )
	{
		$retValue = '{"contacts":[' . $searchResults . '],"error":""}';
		sendResultInfoAsJson( $retValue );
	}
?>
