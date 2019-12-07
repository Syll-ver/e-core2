<?php
include('config/config.php');

$input = urldecode($_GET['code']);
$ari = parse_url(urldecode($input));
$from_arr = implode(' ', $ari);
$to_arr = explode('&', $from_arr);

// $code = urldecode($_GET['code']);

// $cutoff = $pdo->query("SELECT * FROM course_offered
//                         JOIN academic_year USING (\"acadYear\")
//                         JOIN course USING (\"courseCode\")
//                         WHERE status = true AND \"courseCode\" = '".$code."'");
// $cutoff-> execute();
// $cut = $cutoff->fetch(PDO::FETCH_ASSOC);

  $result = $pdo->prepare('SELECT "courseCode", "courseName"
                            FROM course_offered
                            JOIN course USING ("courseCode")
                            JOIN academic_year USING ("acadYear")
                            WHERE status = true');
  $result->execute();

?>

<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Edit Offered Course</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">

  <!-- <?php
    for($i = 0; $i < count($to_arr); $i++){
      echo $i.": ".urldecode($to_arr[$i])."<br />";
    }
  ?> -->

  <form name="setCutOff" id="setCutOff" method="post" action="includeThis/cutoff_Edit.php">

    <div class="form-group col-md-12">
      <label for="course">Course</label>
      <select class="form-control" name="course" id="course" required >
        <?php

        for($i = 0; $row = $result->fetch(); $i++){
          if(substr(urldecode($to_arr[3]), 2) == $row['courseCode']){
            echo '<option value="'.$row['courseCode'].'" selected="selected">'.$row['courseName'].'</option>';
          } else {
            echo '<option value="'.$row['courseCode'].'">'.$row['courseName'].'</option>';
          }
        }
         ?>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="GR">Cut-Off score</label>
      <input type="number" class="form-control" name="GR" id="GR" value="<?php echo substr(urldecode($to_arr[13]), 2); ?>" required />
    </div>

    <div class="form-group col-md-4">
      <label for="AP">Aptitude</label>
      <input type="number" class="form-control" id="AP" name="AP" value="<?php echo substr(urldecode($to_arr[15]), 2); ?>" required />
    </div>

    <div class="form-group col-md-4">
      <label for="LU">Language</label>
      <input type="number" class="form-control" id="LU" name="LU" value="<?php echo substr(urldecode($to_arr[17]), 2); ?>" required />
    </div>

    <div class="form-group col-md-4">
      <label for="MA">Mathematics</label>
      <input type="number" class="form-control" id="MA" name="MA" value="<?php echo substr(urldecode($to_arr[19]), 2); ?>" required />
    </div>

    <div class="form-group col-md-4">
      <label for="SC">Science</label>
      <input type="number" class="form-control" id="SC" name="SC" value="<?php echo substr(urldecode($to_arr[21]), 3); ?>" required />
    </div>

    <div class="form-group col-md-4">
      <label for="slot">Slots</label>
      <input type="number" class="form-control" id="slot" name="slot" value="<?php echo substr(urldecode($to_arr[23]), 3); ?>" slot required />
    </div>

    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success" data-type="confirm">Update</button>
        </div>

</form>
</div>


<script>
  $('#setCutOff').on('hidden.bs.modal', function () {
    $('#setCutOff form')[0].reset();
    });
  // function resetForm(){
  //   document.getElementById("setCutOff").reset();
  // }
</script>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
