<script type="text/javascript">
    function toggle(source) {
    checkboxes = document.getElementsByName('check_list[]');
  for(var i=0, n=checkboxes.length;i<n;i++) {
    checkboxes[i].checked = source.checked;
  }
}
</script>

<div class="modal-header">

  <h4 class="modal-title">Offer Courses</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>
<div class="modal-body" id="modalbody">

 

  <form name="offer" method="post" action="includeThis/offer_add.php">
        <table class="table table-hover">
              <thead>
                <tr>
                  <th><?php echo '<input type="checkbox" onClick="toggle(this)">'?></th>
                  <th>Department Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include('config/config.php');
                  $result = $pdo->prepare("SELECT * FROM course WHERE \"courseCode\" NOT IN (SELECT \"courseCode\" FROM course_offered
                    JOIN academic_year using (\"acadYear\")
                    WHERE status = true)");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                    echo "<tr>";
                    echo '<td><input type="checkbox" name="check_list[]" value="'.$row['courseCode'].'"></td>';
                    echo "<td>".$row['courseName']."<br></td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>

            <div class="modal-footer">
          <input type="button" class="btn btn-secondary" data-dismiss="modal" value="Cancel">
          <input  class="btn btn-success" type="submit" value="Offer" >
        </div>
  </form>
</div>