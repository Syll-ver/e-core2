<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel2">Add Department</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body">

  <form role="form" id="form2" idautocomplete="off" method="post" action="includeThis/dept_add.php">

    <div class="form-group col-md-12">
      <label for="Level">College</label>
      <select class="form-control" name="college" id="college" required>
        <?php
        include('includeThis/adFunction.php');
        $college = selectCollege();
        ?>
      </select>
    </div> 
          
    <div class="form-group col-md-6">
      <label for="deptcode">Department Code</label>
      <input type="text" class="form-control" id="deptcode"  name="code" placeholder="Department Code" required />
    </div>

    <div class="form-group col-md-6"> 
      <label for="deptname">Department Name</label>
      <input type="text" class="form-control" id="deptname" name="name" placeholder="Department Name" required />
    </div>

    <div class="modal-footer">
      <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
      <input class="btn btn-primary" type="submit" value="Add" />
    </div>

  </form> 
 
</div>