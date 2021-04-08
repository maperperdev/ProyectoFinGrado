<?php

	$element = $_POST["typeElement"];
	// $element = 'stock_name_symbol';
	$servername = "localhost";
	$username = "usuario";
	$password = "usuario";
	$myDB = "portfolio";
	$result = array();
	try {
		$conn = new PDO("mysql:host=$servername:3306;dbname=$myDB", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$stmt = $conn->prepare("SELECT * FROM $element");
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_NUM);
	} catch (PDOException $e) {
		echo "Connection failed: " . $e->getMessage();
	}

	$filterResult = array();

	foreach ($result as $element) {
		$filterResult[] = array("symbol" => $element[0], "name" => $element[1]);
	}

	
	echo json_encode($filterResult);