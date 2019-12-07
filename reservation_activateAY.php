<div class="modal-header">
  <h4 class="modal-title" id="exampleModalLabel">Settings</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body">
  <form>

            <!--confirmation-->
            <div class="panel-heading col-md-12" id="panelwarning" style="display: none">
          <h4 style="color: red"><strong>WARNING !!!</strong></h4>
          <p>Only one Academic Year can be active at a time. Activating the following Academic Year will automatically deactivate the previous. Would you like to continue?</p>
          <div class="form-group col-md-12"><br>
            <div class="form-group col-md-6"> <!--empty space filled by with div col-md-6--> </div>
            <div class="form-group col-md-3">
              <button data-dismiss="modal" name="cancel" class="btn btn-default col-md-12"><i class=" fa fa-close "></i> No</button>
            </div>
            <div class="form-group col-md-3">
              <button name="confirm" class="btn btn-success col-md-12" href="javascript:void(0);"><i class="fa fa-check"></i> Yes</button>
            </div>
          </div>
        </div>
        <!--#end confirmation-->

            <div class="form-group">
              <label for="acadYear" class="col-form-label">Academic Year</label>
              <input type="text" class="form-control" placeholder="2019-2020" id="acadYear">
            </div>
            <div class="form-group">
              <label for="reserveDate" class="control-label">Reservation Date</label>
              <div class="input-daterange input-group" id="bs_datepicker_range_container">
                <div class="form-line">
                    <input type="date" class="form-control" placeholder="Date start...">
                </div>
                <span class="input-group-addon">to</span>
                <div class="form-line">
                    <input type="date" class="form-control" placeholder="Date end...">
                </div>
              </div>
            </div>
            </form>
        </div>
        <div class="modal-footer" id="modalFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" id="btn-Add" data-type="confirm">Activate</button>
        </div>
    

        <!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
        <script type="text/javascript">
          $("#btnAdd").on("click", function(){
                document.getElementById('modalFooter').style.display = 'none';
                document.getElementById('panelwarning').style.display = 'block';
                document.getElementById('acadYear').disabled = 'true';
                document.getElementById('bs_datepicker_range_container').disabled = 'true';
    });
        </script>