<?php
$target_dir = "../controller/img/";
$target_file = $target_dir . basename($_FILES["file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Connection details 
require_once '../controller/conexao/conexao.php';

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["file"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// ... validating file (same as previous code) 

// if everything is ok, try to upload file 
if ($uploadOk == 1) { 
  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
    // Insert URL and image in database
    $sql = "INSERT INTO imagens (url1, url2, url3, url4, imagem) 
            VALUES (:url1, :url2, :url3, :url4, :imagem)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
      ':url1' => $_POST['url1'],
      ':url2' => $_POST['url2'],
      ':url3' => $_POST['url3'],
      ':url4' => $_POST['url4'],
      ':imagem' => $target_file
    ]);
    echo "The file ". basename($_FILES["file"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  } 
}
?>
