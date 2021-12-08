<?php
	require_once("inc/config.php");


if (isset($_POST['import'])) {
	$fileName = $_FILES["file"]["tmp_name"];
	$actualName = $_FILES["file"]["name"];

	if ($_FILES["file"]["size"] > 0) {
		$file = fopen($fileName, "r");

		$success_msg = "";
		$error_msg = "";
		$error_report = array();
		$count_inserted = 0;
		$count_failed = 0;
		$count_already_inserted = 0;
		while(($column = fgetcsv($file,40000, ",")) !== FALSE){
			if ($column[0] == "BarcodeText") {
				continue;
			}
			$row = checkIfEntryExists($pdo, $column[0]);
			if ($row['barcode'] == $column[0]) {
				array_push($error_report, [$column[0], $column[1], $column[2], $column[3]]);
				$count_already_inserted += 1;
				continue;
			}
			$stmt = $pdo->prepare("INSERT INTO `product_dimens` ( `barcode`, `length`, `width`, `height`) VALUES ( :barcode, :length, :width, :height)");
			$stmt->bindParam(':barcode', $column[0]);
			$stmt->bindParam(':length', $column[1]);
			$stmt->bindParam(':width', $column[2]);
			$stmt->bindParam(':height', $column[3]);
			
			$result = $stmt->execute();

			if($result){
				$count_inserted += 1;
			}else{
				$count_failed += 1;
			}
		}
		$errorFile = "error_reports/ErrorFile_".$actualName;
		
		if ($error_report && $count_already_inserted > 0) {
			$error_msg = $count_already_inserted . " already exists! Check in -> ".$errorFile;
			$newFile = fopen($errorFile, "w");
			foreach ($error_report as $row) {
				fputcsv($newFile, $row);
			}
		}
		if ($count_inserted > 0) {
			$success_msg = $count_inserted. " items successfully inserted!";
		}
		if ($count_failed > 0) {
			$error_msg += "<br\>".$count_failed. "failed to insert!";
		}
	}
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>CSV File Import</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
<script src="js/bootstrap.bundle.min.js"></script>
</head>
	<body>
		<form class="container mt-5 align-middle container-sm " action="" method="post" name="uploadCsv" enctype="multipart/form-data">
			<div class="row mt-5 mb-5"></div>
			<div class="row mt-5">
				<div class="col-3"></div>
				<div class="col-6">
					
						<?php if (isset($success_msg) && $success_msg !=="") {
							echo "<div class='alert alert-success' role='alert'>";
							echo $success_msg;
							echo "</div>";
						} ?>
					
					
						<?php if (isset($error_msg) && $error_msg !=="") {
							echo "<div class='alert alert-danger' role='alert'>";
							echo $error_msg;
							echo "</div>";
						} ?>
					
					<div class="card">
						<div class="card-body">
						   	<label for="formFile" class="form-label ">
						   		<h5 class="card-title">Choose CSV File</h5>
						   	</label>
							<p class="card-text">
								<input type="file" class="form-control" id="formFile" name="file" accept=".csv" required>
								<div class="invalid-feedback">Example invalid form file feedback</div>
							</p>
							<button type="submit" class="btn btn-primary" name="import">Import</button>
						</div>
					</div>
					<div class="col-3"></div>
				</div>
			</div>
			
		</form>
	</body>
</html>



