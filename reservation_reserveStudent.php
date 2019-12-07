<div class="modal-header">

  <h4 class="modal-title">Reserve Slot</h4>
</div>
<div class="modal-body" id="modalbody">

  <form name="chngpwd" method="post" action="#">
      <div class="table-responsive table-bordered" id="table">
        <!--confirmation-->
        <div class="panel-heading col-md-12" id="panelwarning" style="display: none">
          <!--  <h3 style="color: red"><strong>WARNING !!!</strong></h3> -->
          <p>The SASE Passer with the following details will be reserved a slot in (<strong>course</strong>) Would you like to continue?</p>
          <div class="form-group col-md-12"><br>
            <div class="form-group col-md-6"> <!--empty space filled by with div col-md-6--> </div>
            <div class="form-group col-md-3">
              <button data-dismiss="modal" name="cancel" class="btn btn-default col-md-12"><i class=" fa fa-close "></i> No</button>
            </div>
            <div class="form-group col-md-3">
              <button name="confirm" class="btn btn-success col-md-12" href="javascript:void(0);"><i class="fa fa-check "></i> Yes</button>
            </div>
          </div>
        </div>
        <!--#end confirmation-->

        <!--form for slot reservation -->
        <form>
            <div class="form-group col-md-12">
      <label for="cutOff1">Name </label>
      <input type="text" class="form-control" id="passerName" name="cutOff1" placeholder="Maria Labo" required/>
    </div>

    <div class="form-group col-md-6">
      <label for="slot">Strand</label>
      <input type="text" class="form-control" id="strand" name="slot" placeholder="36" disabled="" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff2">Aptitude</label>
      <input type="text" class="form-control" id="cutOff_AP" name="cutOff2" placeholder="00" disabled=""/>
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff3">Language</label>
      <input type="text" class="form-control" id="cutOff_LU" name="cutOff3" placeholder="00" disabled="" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff4">Mathematics</label>
      <input type="text" class="form-control" id="cutOff_MA" name="cutOff4" placeholder="00" disabled="" />
    </div>

    <div class="form-group col-md-4">
      <label for="cutOff5">Science</label>
      <input type="text" class="form-control" id="cutOff_SC" name="cutOff5" placeholder="00" disabled="" />
    </div>

    <div class="form-group col-md-12">
      <label for="slot">Course</label>
      <select class="form-control" onchange="changeoptions()" name="courses" id="courses">
  <option default>Select Course</option>
    <option>course1</option>
    <option>course2</option>
    <option>course3</option>
    <option>course4</option>
    <option>course5</option>
    <option>course6</option>
    <option>course7</option>
</select>
    </div>

</form>
    <!--#end form for slot reservation -->

        
    </div>
  </form>
</div>
        <div class="modal-footer" id="modalFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id ="btnRes" class="btn btn-success" name="reserve" >Reserve</button>
        </div>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">

  $("#btnRes").on("click", function(){
                document.getElementById('modalFooter').style.display = 'none';
                document.getElementById('panelwarning').style.display = 'block';
                document.getElementById('passerName').disabled="true";
                document.getElementById('courses').disabled="true";
    });

</script>