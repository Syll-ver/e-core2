
<?php
include('../config/config.php');	
$userr = urldecode($_GET['id']);
$sql = $pdo->query("SELECT \"courseCode\" FROM course JOIN chairperson ON chairperson.\"deptCode\" = course.\"deptCode\" WHERE username ='".$userr."';");
$userrr = $sql->fetch();

$result = $pdo->prepare("SELECT  \"acadYear\" FROM academic_year WHERE status = true");
          $result->execute();
$ay = $result->fetch();
?>
<div class="modal-header">
  <h3 class="modal-title" id="myModalLabel">Set Cut-Off Scores and Slot</h3>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
<form name="myFormer" id="myFormer" method="post" action="includes/add_Scores.php">
  
  <input type="hidden" name="courseCode" value="<?php echo $userrr['courseCode'];?>">
  <input type="hidden" name="ay" value="<?php echo $ay['acadYear']; ?>">

    <div class="form-group col-md-4">
      <label for="cutOff2">GR criteria</label>
      <input type="text" class="form-control" id="GRcriteria" name="GRcriteria" placeholder="00" />
    </div>


    <div class="form-group col-md-4">
      <label for="AP">AP</label>
      <input type="text" class="form-control" id="AP" name="AP" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="LU">LU</label>
      <input type="text" class="form-control" id="LU" name="LU" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="MA">MA</label>
      <input type="text" class="form-control" id="MA" name="MA" placeholder="00" />
    </div>

    <div class="form-group col-md-4">
      <label for="SC">SC</label>
      <input type="text" class="form-control" id="SC" name="SC" placeholder="36" />
    </div>

    <div class="form-group col-md-4">
      <label for="Slot">Slot</label>
      <input type="text" class="form-control" id="Slot" name="Slot" placeholder="36" />
    </div>

</form>
</div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <input class="btn btn-primary" type="submit" id="adds" value="Set" form="myFormer" />
        </div>