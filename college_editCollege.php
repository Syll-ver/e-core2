<!-- <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css"> -->

<?php
  //include('config/config.php');

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

          <form id="college" name="college">

            <input type="hidden" name="oldcode" id="oldcode" value="<?php echo substr(urldecode($to_arr[0]), 12); ?>" />

    <div class="form-group col-md-4">
      <label for="coursecode">Code</label>
      <input type="text" class="form-control" id="code" name="code" value="<?php echo substr(urldecode($to_arr[0]), 12); ?>" />
    </div>

    <div class="form-group col-md-8">
      <label for="coursename">College Name</label>
      <input type="text" class="form-control" id="name" name="name" value="<?php echo substr(urldecode($to_arr[2]), 12); ?>" />
    </div>

<div class="modal-footer col-md-12">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />  
      <input type="submit" class="btn btn-primary" value="Update" name="update" id="update"/>
 </div>
    
  </form>




</div>

<script src="assets/js/jquery-1.11.1.js"></script>
<!-- BOOTSTRAP SCRIPTS  -->
<script src="assets/js/bootstrap.js"></script>
<script type="text/javascript">


  $('#update').click(function(e){
    $('#college').submit(function(e){
      e.preventDefault();
      var editform = $(this).serialize();

    if(editform[0] == '' || editform[1] == ''){
      swal("Oops!!", "Looks like you missed some fields. Please check and try again!", "error", "Ok");
    } else {
      $.ajax({
        method: 'POST',
        url: 'includeThis/college_edit.php',
        data: editform,
        dataType: 'json',
        success: function(response){
          if(response['status'] == 'success'){
            $('#submit').prop('disabled', true);
          swal({
            title: "Success!",
            text: "You have successfully updated " + editform,
            type: "success",
            confirmButtonText: "Ok",
          }).then((result) => {
            if(result.value == true){
            //this is your success swal, after clicking the yes button, it will reload or go to the other page.
              location.reload(); // this is your location reload.
              window.location.href='college.php'; // this is your relocate to other page.
            }
          })
        } else {
          $('#submit').prop('disabled', true);
          swal({
            title: "Success!",
            text: "You have successfully updated " + editform,
            type: "success",
            confirmButtonText: "Ok",
          }).then((result) => {
            if(result.value == true){
            //this is your success swal, after clicking the yes button, it will reload or go to the other page.
              location.reload(); // this is your location reload.
              window.location.href='college.php'; // this is your relocate to other page.
            }
          })
        }
        },
        error:function(xhr, thrownError, ajaxOptions){

        },
      });
    }
  });
  });




  // $("#update").click(function(){
  //       var oldcode = document.getElementById("oldcode").value; //$("#oldcode").val();
  //       var code = document.getElementById("code").value; //$("#code").val();
  //       var name = document.getElementById("name").value; //$("#name").val();

  //       if(oldcode == '' || name == '' || code == ''){
  //           swal("Oops!!", "Looks like you missed some fields. Please check and try again!", "error");
  //       }else{
  //           $.ajax({
  //               type:'post',
  //               url:'includeThis/college_edit.php',
  //               data: {oldcode:oldcode,code:code,name:name},
  //               success:function(result){
  //                 $('#submit').prop('disabled', true);
  //                 swal({
  //                    title: "Success!",
  //                    text: "You have successfully updated " + result,
  //                    type: "success",
  //                    confirmButtonText: "Ok",
  //                    }).then((result) => {
  //                        if(result.value){
  //                               //this is your success swal, after clicking the yes button, it will reload or go to the other page.
  //                               location.reload(); // this is your location reload.
  //                               window.location.href='college.php'; // this is your relocate to other page.
  //                        }
  //                   })
  //              },
  //               error:function(xhr, thrownError, ajaxOptions){

  //               },
  //           });
  //       }
  //   });
</script>