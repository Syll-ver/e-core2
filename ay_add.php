<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Add New Academic Year</h4>
  <button type="button" class="close" onclick="resetForm();" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body"> 
  <form role="form" name="adday" id="adday" autocomplete="off" method="post" action="includeThis/ay_add.php">
        <div class="form-group col-md-12">
          <label for="coursecode">Academic Year</label>
          <input type="text" class="form-control" id="ay" name="ay" disabled />
        </div>

        <div class="col-md-12">
          <label>Reservation Date</label>
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">Start</label>
          <input type="date" class="form-control" id="start" name="start" placeholder="May 1, 2019" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">End</label>
          <input type="date" class="form-control" id="end" name="end" placeholder="May 7, 2019" required />
        </div>

        <div class="form-group col-md-12">
          <label for="coursename">Status</label> <span id="confirm-message"></span>
          <select class="form-control" name="status" id="status" onchange="activateWarning();" required>
            <option value="0">inactive</option>
            <option value="1">active</option>
          </select>
        </div>

<div class="modal-footer">
  <input type="button" class="btn btn-secondary" onclick="resetForm();" data-dismiss="modal" value="Cancel" />
  <input class="btn btn-primary" type="submit" value="Add" />
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

  function resetForm(){
    document.getElementById("adday").reset();
  }
</script>