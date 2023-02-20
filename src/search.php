<?php
	require 'db.php';

	$sql = "SELECT * FROM tbl_transaction WHERE refnum LIKE'%".$_GET['refnum']."%'";
	$result = $conn->query($sql);
	
	$data = [];

	if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
			$data[] = [
				'refnum' => $row['refnum'],
				'amount' => 1000
			];
		}

	}

	echo json_encode($data);

	$conn->close();
?>