<?php
  include('config/config.php');
  $result = $pdo->prepare("SELECT * FROM academic_year
                            WHERE status = 'true' ");
  $result->execute();
  $rows = $result->fetch();
?>

<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Add Schedule</h4>
  <button type="button" class="close" onclick="resetForm();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body"> 
  <form role="form" name="adday" id="adday" autocomplete="off" method="post" action="includeThis/sched_add.php" onsubmit="event.preventDefault(); validateMyForm();">

        <input type="hidden" class="form-control" id="ay" name="ay" value="<?php echo $rows['acadYear'];?>" required />

        <div class="form-group col-md-12">
          <label for="coursename">Schedule</label>
          <input type="date" class="form-control" id="sched" name="sched" placeholder="May 1, 2019" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">Starting Score</label>
          <input type="number" class="form-control" id="beg" name="beg" placeholder="90" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">Ending Score</label>
          <input type="number" class="form-control" id="end" name="end" placeholder="95" required />
        </div>

        <div class="form-group col-md-12">
          <span id="conf"></span>
        </div>

<div class="modal-footer">
  <input type="button" class="btn btn-secondary" onclick="resetForm();" data-dismiss="modal" value="Cancel" />
  <input class="btn btn-primary" onclick="checkSched();" type="submit" value="Add" />
</div> 

  </form>
   
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

  function checkSched(){

    <?php 
    $result = $pdo->prepare("SELECT * FROM academic_year
                            WHERE status = 'true' ");
    $result->execute();
    $rows = $result->fetch();
    ?>

    var start = <?php echo $rows['reservationStart']; ?>;
    var end = <?php echo $rows['reservationEnd']; ?>;
    var sched = document.getElementById("sched");
    var msg = "Schedule should not be earlier or later than Reservation Date.";
    var conf = document.getElementById("conf");

    conf.innerHTML = "Start: <b>" + start.value + "</b> <br> End: <b>" + end.value + "</b> <br/> SCHED: " + sched.value; 

    // if(start.value <= sched.value <= end.value){
    //   alert("validation passed!");
    //   return true;
    // } else {
    //   alert(msg);
    //   window.history.back();
    //   return false;
    //   modal.style.display = "none";
    // }


  }

  function resetForm(){
    document.getElementById("adday").reset();
  }
</script>