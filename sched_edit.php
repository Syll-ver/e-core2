<?php
  include('config/config.php');

  $id=urldecode($_GET['id']);
  $result = $pdo->prepare('SELECT * FROM score_schedule
                            WHERE id = :id');
  $result->bindParam(':id', $id);
  $result->execute();
  for($i=0; $rows = $result->fetch(); $i++){

?>

<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Edit Schedule</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body"> 
  <form role="form" name="adday" id="adday" autocomplete="off" method="post" action="includeThis/sched_edit.php">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <input type="hidden" class="form-control" id="ay" name="ay" value="<?php echo $rows['acadYear']; ?>" required />

        <div class="form-group col-md-12">
          <label for="coursename">Reservation Schedule</label>
          <input type="date" class="form-control" id="sched" name="sched" value="<?php echo $rows['schedule']; ?>" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">Starting Score</label>
          <input type="number" class="form-control" id="beg" name="beg" value="<?php echo $rows['scoreStart']; ?>" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">Ending Score</label>
          <input type="number" class="form-control" id="end" name="end" value="<?php echo $rows['scoreEnd']; ?>" required />
        </div>

<div class="modal-footer">
  <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
  <input class="btn btn-primary" type="submit" value="Update" />
</div> 

  </form>

<?php } ?>
   
</div>



<script>
  function activateWarning(){
    var select = document.getElementById('status');
    var message = document.getElementById('confirm-message');
    var bad_color  = "#ff6666";

    if(select.value == "true"){
      message.style.color     = bad_color;
      message.innerHTML       = '<label>you are activating this acad year</label>';
    } else if(select.value == "false"){
      message.innerHTML       = '';
    }
  } 
</script>