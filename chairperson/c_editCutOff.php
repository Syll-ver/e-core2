
<?php
include('../config/config.php');	
$userr = urldecode($_GET['id']);


$sql = $pdo->query("SELECT \"courseCode\" FROM course JOIN chairperson ON chairperson.\"deptCode\" = course.\"deptCode\" WHERE username ='".$userr."';");
$userrr = $sql->fetch();

$query = $pdo->query("SELECT * FROM course_offered JOIN academic_year ON course_offered.\"acadYear\" = academic_year.\"acadYear\"
JOIN course ON course_offered.\"courseCode\" = course.\"courseCode\"
JOIN chairperson ON chairperson.\"deptCode\" = course.\"deptCode\"
WHERE username = '".$userr."' AND academic_year.status= 'true';");
$edit = $query->fetch(PDO::FETCH_ASSOC);
?>
<div class="modal-header">
          <h3 class="modal-title" id="myModalLabel">Set Cut-Off Scores and Slot</h3>
        </div>
        <div class="modal-body">
          <form name="myFormer" id="myFormer" method="post" action="includes/cutoffScores_edit.php">
     

<input type="hidden" name="courseCode" value="<?php echo $userrr['courseCode'];?>">


    
  <div class="col-md-12">
    <div class="form-group col-md-3" style="margin-left: -15px;">
      <label for="AP">AP</label>
      <input type="text" class="form-control" id="AP" name="AP" placeholder="00" value="<?php echo $edit['AP'] ?>"/>
    </div>

    <div class="form-group col-md-3">
      <label for="LU">LU</label>
      <input type="text" class="form-control" id="LU" name="LU" placeholder="00" value="<?php echo $edit['LU'] ?>" />
    </div>
  
    <div class="form-group col-md-3">
      <label for="MA">MA</label>
      <input type="text" class="form-control" id="MA" name="MA" placeholder="00" value="<?php echo $edit['MA'] ?>" />
    </div>

    <div class="form-group col-md-3">
      <label for="SC">SC</label>
      <input type="text" class="form-control" id="SC" name="SC" placeholder="36" value="<?php echo $edit['SC'] ?>" />
    </div>
  </div>  

    <div class="form-group col-md-3">
      <label for="Slot">Slot</label>
      <input type="text" class="form-control" id="Slot" name="Slot" placeholder="36" value="<?php echo $edit['slot'] ?>" />
    </div>

    <div class="form-group col-md-6">
      <label for="cutOff2">GR criteria</label>
      <input type="text" class="form-control" id="GRcriteria" name="GRcriteria" placeholder="00" value="<?php echo $edit['GR_criteria'] ?>" />
    </div>
    
    

</form>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" id="adds" value="Update" form="myFormer" />
        </div>