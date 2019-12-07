<?php
  include_once('config/config.php');
  $username = 'admin';//urldecode($_GET['username']);

  $result = $pdo->prepare("SELECT *
                            FROM department");
  $result->execute();
  
?>

<div class="modal-header">
  <h4 class="modal-title" id="myModalLabel">Create Notification</h4>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
</div>

<div class="modal-body">
  <form action="includeThis/notifyme.php" method="post">

    <input type="hidden" name="username" value="<?php echo $username ?>">

    <div class="form-group">
    <label>Notification Title</label>
    <input type="text" name="title" class="form-control" placeholder="Notification Title">
  </div>

  <div class="form-group">
    <label>Notification Body</label>
      <textarea name="editor" class="form-control" placeholder="Notification Body"></textarea>
  </div>


    <!-- <div class="form-group">
      <label>Receiver</label>
      <input type="search" class="form-control" placeholder="Whom to notify">
      <div class="form-group container" style="height: 200px; margin-top: 3%; overflow: auto; ">

            <table class="table table-hover">
              <thead>
                <tr>
                  <th></th>
                  <th>Department Name</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  $result = $pdo->prepare("SELECT * FROM department");
                  $result->execute();
                  for($i=0; $row = $result->fetch(); $i++){
                    echo "<tr>";
                    echo '<td><input type="checkbox" name="check_list[]" value="'.$row['deptCode'].'"></td>';
                    echo "<td>".$row['deptName']."<br></td>";
                    echo "</tr>";
                  }
                ?>
              </tbody>
            </table>
      </div> 
    </div> -->

    <div class="form-group">
        <label>Typeahed</label>
        <input type="text" id="tagstype" name="tags" style="width:400px;">
    </div>

    <button onclick="checkPass();">CLICK ME</button>
    

    <div class="form-group col-md-6">
        <p id="confirm-message"></p>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal" onclick="">Close</button>
      <button type="submit" class="btn btn-primary">Notify</button>
    </div>


  </form>

</div>

