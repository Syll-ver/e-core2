<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Add College</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
        
<div class="modal-body"> 
  <form role="form" name="addcollege" id="addcollege" autocomplete="off" method="post" action="includeThis/college_add.php">
        <div class="form-group col-md-6">
          <label for="coursecode">Code</label>
          <input type="text" class="form-control" id="code" name="code" placeholder="College Code" required />
        </div>

        <div class="form-group col-md-6">
          <label for="coursename">College Name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="College Name"  />
        </div>

        <div class="modal-footer">
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel" />
          <input class="btn btn-primary" type="submit" value="Add" />
        </div>  


  </form>
   
</div>
