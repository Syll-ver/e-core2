<div class="modal-header">
  <h4 class="modal-title" id="exampleModalLabel">Add Course</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body">

  <form name="courseAdding" method="post" action="includeThis/course_add.php">

    <div class="form-group col-md-4">
      <label for="coursecode">Course Code  </label>
      <input type="text" class="form-control" id="coursecode" name="coursecode" placeholder="Course Code" required />
    </div>

    <div class="form-group col-md-8">
      <label for="coursename">Course Name  </label>
      <input type="text" class="form-control" id="coursename" name="coursename" placeholder="Course Name" required />
    </div>

    <div class="form-group col-md-4">
      <label for="strand">Strand</label>
      <input type="text" class="form-control" id="strand" name="strand" placeholder="Strand" required />
    </div> 

    <div class="form-group col-md-8">
      <label for="Department">Department  </label>
      <select class="form-control" name="dept" required="required" id="deptval">
        <?php
        include('config/config.php');   
          $result = $pdo->prepare("SELECT \"deptCode\", \"deptName\" FROM department");
          $result->execute();
          for($i=0; $row = $result->fetch(); $i++){
          echo '<option value="'.$row['deptCode'].'">'.$row['deptName'].'</option>';
          }
        ?>
      </select> 
    </div>
    
    <div class="modal-footer">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
    <input class="btn btn-primary" type="submit" value="Add" />
    </div>  

  </form>




