<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Edit Course</h3>
</div>
        
        <div class="modal-body">

          <form name="dept" method="post" action="addcoursefunction.php">

    <div class="form-group col-md-12">
      <label for="coursename">Course Name  </label>
      <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" disabled="" />
    </div>
    
    <div class="form-group col-md-4">
      <label for="cutOff1">Course Cut-Off </label>
      <input type="text" class="form-control" id="cutOff_Score" name="cutOff1" placeholder="80" required/>
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff2">Aptitude</label>
      <input type="text" class="form-control" id="cutOff_AP" name="cutOff2" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff3">Language</label>
      <input type="text" class="form-control" id="cutOff_LU" name="cutOff3" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff4">Mathematics</label>
      <input type="text" class="form-control" id="cutOff_MA" name="cutOff4" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff5">Science</label>
      <input type="text" class="form-control" id="cutOff_SC" name="cutOff5" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="slot">Slots</label>
      <input type="text" class="form-control" id="seatLimit" name="slot" placeholder="36" />
    </div>

    </div>  

    

  </form>




        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" data-type="confirm">Save</button>
        </div>



        <span style="color: white">Ender</span>
<!-- CONTENT-WRAPPER SECTION END-->
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
