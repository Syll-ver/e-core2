<?php
require_once 'db.php';
$db = new Database();

if(isset($_POST["submit"])){

  $file = $_FILES['file']['tmp_name'];
  $handle = fopen($file, "r");
  $i = 0;
  while(($filesop = fgetcsv($handle, 1000, ",")) !== false){
    $fname = $filesop[0];
    $lname = $filesop[1];
    $result = $db->importFile($fname,$lname);

    //$c = $c + 1;
    $i++;
  }

  if($result){
   echo "sucess";
 } 
 else
 {
  echo "Sorry! Unable to impo.";
}

}
?>
<!DOCTYPE html>
<html>
<body>
<form enctype="multipart/form-data" method="post" role="form">
    <div class="form-group">
        <label for="exampleInputFile">File Upload</label>
        <input type="file" name="file" id="file" size="150">
        <p class="help-block">Only Excel/CSV File Import.</p>
    </div>
    <button type="submit" class="btn btn-default" name="submit" value="submit">Upload</button>
</form>
</body>
</html>