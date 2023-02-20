<?php

use thiagoalessio\TesseractOCR\TesseractOCR;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['submit'])) {
        $file_name = $_FILES['file']['name'];
        $tmp_file = $_FILES['file']['tmp_name'];


        if (!session_id()) {
            session_start();
            $unq = session_id();
        }

        $file_name = $unq . '_' . time() . '_' . str_replace(array('!', "@", '#', '$', '%', '^', '&', ' ', '*', '(', ')', ':', ';', ',', '?', '/' . '\\', '~', '`', '-'), '_', strtolower($file_name));

        if (move_uploaded_file($tmp_file, 'uploads/' . $file_name)) {
            try {
    
                $fileRead = (new TesseractOCR('uploads/' . $file_name))
                    ->setLanguage('eng')
                    ->run();
					
					$sam = explode(" ",$fileRead);
					
					//var_dump($sam); // shows the array of string
					//echo $sam[0];
					
					//$sam =  $fileRead;
					//echo $sam;
					
					//$sam = "Successfully Sent R A ** H \ /1* *K* *T B. 0969 587 6883 Amount PHP 100,000.00";
						//$sam = "Welcome to the 0045 and the 456 arena";

//preg_match_all('/[0-9]+(?:\.[0-9]*)?/', $sam, $matches);
	//print_r($matches);

//echo "<br>";
//preg_match('/(\d{2})\.(\D{0}) (\d{4})\.(\d{2}):(\d{2}):(\d{2})/',$sam,$matches);
//preg_match_all('\d{0,2}\/\d{2,10}\/\d{2,4}', $sam, $matches);
	//print_r($matches);
	echo "<br>";
	
    //preg_match_all("/\d{2}\s\w\s\d{4}[ ]\d{2}:\d{2}:\d{2}/",$sam,$matches);
	
	//preg_match_all("/\d{2}:\d{2}:\d{2} (AM|PM)/",$sam,$matches); //time ok!
    //print_r($matches[0]);  //time result ok!

	//preg_match('/\d{1,2}\s\w+\s\d{1,4}/', $sam, $res);

	//preg_match('#(?<=,\s)\d{1,2}\s\w+\s\d{1,4}(?=\sat)#', $sam, $res); // correct dapat eto pero once nirarun nag eerror unless ireremove ung ref num.
	
			//print_r($res);	

//preg_match("#(\d+)\s(\w+)\s(\d+)#", $str, $date);
//print_r($date);			
					
					
				/*	
					echo "Amount PHP ";
					echo preg_replace("/[^0-9\.]/", '', $sam[14]);
					
					echo "<br>";
					echo "Ref. No. ";
					echo preg_replace("/[^0-9\.]/", '', $sam[18]);
					echo preg_replace("/[^0-9\.]/ ", ' ', $sam[19]);
					echo preg_replace("/[^0-9\.]/ ", ' ', $sam[20]);
				*/
            } catch (Exception $e) {
    
                echo $e->getMessage();
    
            }
        } else {
            echo "<p class='alert alert-danger'>File failed to upload.</p>";
        }

    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Reader</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row mt-5">
            <div class="col-sm-8 mx-auto">
                <div class="jumbotron">
                    <h1 class="display-4">TESTING</h1>
                    <p class="lead">


                        <?php if ($_POST) : ?>
                            <pre>
                                <?= $fileRead ?>
                            </pre>
                        <?php endif; ?>


                </p>
                <hr class="my-4">
                </div>
            </div>
        </div>
        <div class="row col-sm-8 mx-auto">
            <div class="card mt-5">
                <div class="card-body">


                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">

                            <label for="filechoose">Choose File</label>

                            <input type="file" name="file" class="form-control-file" id="filechoose">

                            <button class="btn btn-success mt-3" type="submit" name="submit">Open</button>

                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
</body>
</html>