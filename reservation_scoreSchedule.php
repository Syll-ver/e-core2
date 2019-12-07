<div class="modal-header">

  <h4 class="modal-title">Set Score Schedule</h4>
</div>
<div class="modal-body" id="modalbody">

  <form name="chngpwd" method="post" action="#">
      <div class="table-responsive table-bordered" id="table">
        <!--confirmation-->
        <div class="panel-heading col-md-12" id="panelwarning" style="display: none">
          <h3 style="color: red"><strong>WARNING !!!</strong></h3>
          <p>The selected admin accounts will be permanently erased. Would you like to continue?</p>
          <div class="form-group col-md-12"><br>
            <div class="form-group col-md-6"></div>
            <div class="form-group col-md-3">
              <button data-dismiss="modal" name="cancel" class="btn btn-default col-md-12"><i class=" fa fa-close "></i> Cancel</button>
            </div>
            <div class="form-group col-md-3">
              <button name="confirm" class="btn btn-danger col-md-12"><i class="fa fa-check "></i> Confirm</button>
            </div>
          </div>
        </div>
        <!--#end confirmation-->

        <table class="table" id="tablem">
            <thead>
                <tr>
                  <th>#</th>
                  <th>Username</th>
                  <th>Date Created </th>
                  <th id="thcb">
                      <input id="checkboxheadm" type="checkbox" name="">
                  </th>
                </tr>
            </thead>
            <tbody>
                      <tr>
                          <td> - </td>
                          <td> first User</td>
                          <td> date created</td>
                          <td>
                            <input name="checkbox[]" id=" " type="checkbox" value=" ">
                          </td>
                      </tr>
                      <tr>
                          <td> - </td>
                          <td> second User</td>
                          <td> date created</td>
                          <td>
                            <input name="checkbox[]" id=" " type="checkbox" value=" ">
                          </td>
                      </tr>

            </tbody>
        </table>
    </div>
  </form>
</div>
        <div class="modal-footer" id="panelheading">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id ="btnDelete" class="btn btn-danger" name="delete" >Delete</button>
        </div>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">

  $("#btnDelete").on("click", function(){
           $('#tablem tr td [type="checkbox"]').each(function(i, chk) {
            var tr = jQuery(this);  
            if (chk.checked) {
                tr.parent().parent().show();
                document.getElementById('panelheading').style.display = 'none';
                document.getElementById('panelwarning').style.display = 'block';
                document.getElementById('thcb').style.display = 'none';
                tr.parent().hide();
            }
            else{
              tr.parent().parent().hide();
                /*butang siguro ug toast na function diri saying "check atleast one checkbox to delete" instead of this -> tr.parent().parent().hide();*/
            }
       });
    });


  $('#checkboxheadm').click(function(e){
      var table= $(e.target).closest('table');
      $('td input:checkbox:visible',table).prop('checked',this.checked);
  });

</script>