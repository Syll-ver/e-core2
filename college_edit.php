<?php
  include('config/config.php');

  $input = urldecode($_GET['oldcode']);
  $ari = parse_url(urldecode($input));
  $from_arr = implode(' ', $ari);
  $to_arr = explode('&', $from_arr);
?>


<div class="modal-header">
  <h4 class="modal-title" id="exampleModalLabel">Edit College</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
        <div class="modal-body">

          <?php
    for($i = 0; $i < count($to_arr); $i++){
      echo urldecode($to_arr[$i])."<br />";
    }
  ?>

          <form name="dept" method="post" action="includeThis/college_edit.php">

            <input type="hidden" name="oldcollegecode" value="<?php echo substr(urldecode($to_arr[0]), 12); ?>" />

    <div class="form-group col-md-4">
      <label for="coursecode">Code</label>
      <input type="text" class="form-control" id="CollegeCode" name="collegeCode" value="<?php echo substr(urldecode($to_arr[0]), 12); ?>" />
    </div>

    <div class="form-group col-md-8">
      <label for="coursename">College Name</label>
      <input type="text" class="form-control" id="collegeName" name="collegeName" value="<?php echo substr(urldecode($to_arr[2]), 12); ?>" />
    </div>

    <div class="modal-footer col-md-12">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />  
      <input type="submit" class="btn btn-primary" value="Update" />
    </div>


  </form>

<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">
  $("#update").click(function(){
        var oldcode = $("#oldcollegecode").val();
        var name = $("#collegeCode").val();
        var code = $("#collegeName").val();

        if(oldcode == '' || name == '' || code == ''){
            swal("Oops!!", "Looks like you missed some fields. Please check and try again!", "error");
        }else{
            $.ajax({
                type:'post',
                url:'includeThis/college_edit.php',
                data: {name:name,code:code, oldcode:oldcode},
                success:function(result){
                  $('#submit').prop('disabled', true);
                  swal({
                     title: "Success!",
                     //position: 'top-center',
                     text: "You have successfully added " + code + ": " + name,
                     type: "success",
                     confirmButtonText: "Ok",
                     }).then((result) => {
                         if(result.value){
                                //this is your success swal, after clicking the yes button, it will reload or go to the other page.
                                location.reload(); // this is your location reload.
                                window.location.href='college.php'; // this is your relocate to other page.
                         }
                    })
               },
                error:function(xhr, thrownError, ajaxOptions){

                },
            });
        }
    });
</script>