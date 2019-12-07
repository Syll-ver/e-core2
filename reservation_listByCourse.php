<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal">&times;</button>
  <h4 class="modal-title">Reservation List per Course <strong>(courseName)</strong></h4>
</div>
<div class="modal-body">
  <form name="chngpwd" method="post" action="#">
    <input type="text" name="coursename" value="<?php echo $courseName; ?>" hidden>
    <div class="panel panel-default">
        <div class="panel-heading col-md-12">
            <div class="col-md-6">
              Reserved Students                              
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Student Name</th>
                    <th>Reg No </th>
                    <th>Strand</th>
                    <th>Department</th>   
                    <th>Reservation Date</th>
                    <!-- <th> status </th>-->
                </tr>
            </thead>
            <tbody>
            
            </tbody>
        </table>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading col-md-12">
            <div class="col-md-6">
              Waitlisters                              
            </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Strand</th>  
                </tr>
            </thead>
            <tbody>
            

                
            </tbody>
        </table>
    </div>
    <div class="form-group col-md-10"></div>
    <div class="form-group col-md-2"><br>
      <button name="print" id="print" class="btn btn-primary col-md-12"><i class="fa fa-print"></i> Print</button>
    </div>
  </form>
</div>
<span style="color: white">Ender</span>
<!-- CONTENT-WRAPPER SECTION END-->
<!-- FOOTER SECTION END-->
<!-- JAVASCRIPT AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
<!-- CORE JQUERY SCRIPTS -->
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>