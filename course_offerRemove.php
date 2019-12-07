<div class="modal-header">

  <h4 class="modal-title">Offer Courses</h4>
</div>
<div class="modal-body" id="modalbody">

   <div class="box-icon" style="margin-bottom: 2%;" id="sel_col">
                    <?php include "includes/selection_college.php";?>
  </div>

  <form name="chngpwd" method="post" action="#">
      <div class="table-responsive table-bordered" id="table">
        <!--confirmation-->
        <div class="panel-heading col-md-12" id="panelwarning" style="display: none">
          <!--  <h3 style="color: red"><strong>WARNING !!!</strong></h3> -->
          <p style="color: red;">The selected courses will be removed from the offerings of Academic Year (<strong>acadYear</strong>) Would you like to continue?</p>
          <div class="form-group col-md-12"><br>
            <div class="form-group col-md-6"> <!--empty space filled by with div col-md-6--> </div>
            <div class="form-group col-md-3">
              <button data-dismiss="modal" name="cancel" class="btn btn-default col-md-12"><i class=" fa fa-close "></i> Cancel</button>
            </div>
            <div class="form-group col-md-3">
              <button name="confirm" class="btn btn-danger col-md-12" href="javascript:void(0);"><i class="fa fa-check "></i> Confirm</button>
            </div>
          </div>
        </div>
        <!--#end confirmation-->

        <table class="table" id="tablem">
            <thead>
              <tr>
                        <th>#</th>
                        <th>Course Code</th>
                        <th>Course Name</th>
                        <th>Department</th>
                        <th>Strand</th>
                        <th id="thcb">
                          <input id="checkboxheadm" type="checkbox" name="">
                        </th>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>code</td>
                        <td>BS Information Technology</td>
                        <td>IT/Physics</td>
                        <td>STEM</td>
                        <td>
                          <input name="checkbox[]" id=" " type="checkbox" value=" ">
                        </td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>code</td>
                        <td>BS Mathematics</td>
                        <td>Mathematics</td>
                        <td>STEM</td>
                        <td>
                          <input name="checkbox[]" id=" " type="checkbox" value=" ">
                        </td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>code</td>
                        <td>BS Biology</td>
                        <td>Science</td>
                        <td>STEM</td>
                        <td>
                          <input name="checkbox[]" id=" " type="checkbox" value=" ">
                        </td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>code</td>
                        <td>BS Agricultural & Biosystems Engineering</td>
                        <td>Agricultural Engineering</td>
                        <td>STEM</td>
                        <td>
                          <input name="checkbox[]" id=" " type="checkbox" value=" ">
                        </td>
                      </tr>

            </tbody>
        </table>
    </div>
  </form>
</div>
        <div class="modal-footer" id="modalFooter">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="button" id ="btnRemove" class="btn btn-danger" name="delete" >Remove</button>
        </div>
<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">

  $("#btnRemove").on("click", function(){
           $('#tablem tr td [type="checkbox"]').each(function(i, chk) {
            var tr = jQuery(this);  
            if (chk.checked) {
                tr.parent().parent().show();
                document.getElementById('sel_col').style.display = 'none';
                document.getElementById('modalFooter').style.display = 'none';
                document.getElementById('panelwarning').style.display = 'block';
                document.getElementById('thcb').style.display = 'none';
                tr.parent().hide();
            }
            else{
              tr.parent().parent().hide();
                /*butang siguro ug toast na function diri saying "check atleast one checkbox to delete" instead of this -> tr.parent().parent().show();*/
            }
       });
    });


  $('#checkboxheadm').click(function(e){
      var table= $(e.target).closest('table');
      $('td input:checkbox:visible',table).prop('checked',this.checked);
  });

</script>