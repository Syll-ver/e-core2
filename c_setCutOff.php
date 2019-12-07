<?php
include('config/config.php');
$username = urldecode($_GET['id']);

  $result = $pdo->prepare('SELECT "courseCode", "courseName"
                            FROM course_offered
                            JOIN course USING ("courseCode")
                            WHERE "courseCode" NOT IN
                                (SELECT "courseCode" FROM course_offered)');
  $result->execute();


  //for($i=0; $rows = $result->fetch(); $i++){
?>

<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Set Cut-Off Scores and Slot</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body">
  <form name="setCutOff" method="post" action="includeThis/cutoff_set.php">

    <input type="hidden" name="username" value="<?php echo $username; ?>">

    <div class="form-group col-md-12">
      <label for="course">Course</label>
      <select class="form-control" name="course" id="course" required >
        <?php
        for($i = 0; $row = $result->fetch(); $i++){
          echo '<option value="'.$row['courseCode'].'">'.$row['courseName'].'</option>';
        }
         ?>
      </select>
    </div>

    <div class="form-group col-md-4">
      <label for="GR">Cut-Off score</label>
      <input type="number" class="form-control" name="GR" id="GR" placeholder="0" required />
    </div>

    <div class="form-group col-md-4">
      <label for="AP">Aptitude</label>
      <input type="number" class="form-control" id="AP" name="AP" placeholder="0" required />
    </div>

    <div class="form-group col-md-4">
      <label for="LU">Language</label>
      <input type="text" class="form-control" id="LU" name="LU" placeholder="0" required />
    </div>

    <div class="form-group col-md-4">
      <label for="MA">Mathematics</label>
      <input type="text" class="form-control" id="MA" name="MA" placeholder="0" required />
    </div>

    <div class="form-group col-md-4">
      <label for="SC">Science</label>
      <input type="text" class="form-control" id="SC" name="SC" placeholder="0" required />
    </div>

    <div class="form-group col-md-4">
      <label for="slot">Slots</label>
      <input type="text" class="form-control" id="slot" name="slot" placeholder="0" required />
    </div>

    <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-success" data-type="confirm">Set</button>
        </div>

</form>
</div>


        