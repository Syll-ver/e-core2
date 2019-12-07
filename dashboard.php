<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chairperson | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/styles.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
  <style>
.button{
  background-color: #cc6666;
  font-size: 13px;
  color: white;
  padding: 5px 18px;
 
}
</style>
 </head>
  <body>

    <!--navbar-->
    <header class="navbar navbar-expand flex-column flex-md-row bd-navbar" style="border-radius: 0; font-size: 13px;">
  <a class="navbar-brand mr-0 mr-md-2" href="index.php" aria-label="Bootstrap" style="padding-top: 15px;"><h3>MSU-General Santos e-CORE</h3></a>

  <ul class="navbar-nav flex-row ml-md-auto d-none d-md-flex">
    <li class="nav-item dropdown">
      <a class="nav-item nav-link dropdown-toggle mr-md-2" href="#" id="bd-versions" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="glyphicon glyphicon-user"></span>
      </a>
      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="bd-versions">
        <a class="dropdown-item active" href="/docs/4.3/">Latest (4.3.x)</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/4.2/">v4.2.1</a>
        <a class="dropdown-item" href="https://getbootstrap.com/docs/4.0/">v4.0.0</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="login.php">Logout</a>
      </div>
    </li>
  </ul>
</header>
    <!-- #end navbar-->

    <section id="main">
      <div class="container">
        <div class="row">
          
          <div class="col-md-10 col-md-offset-1">
            <!-- Reservation Overview -->
            <div class="panel panel-default">
              <div class="panel-heading" style="background-color: #cc6666; border-color: #cc6666">
                <h3 class="panel-title" style="color: white;">Reservation Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> 23</h2>
                    <h4>Reserved</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> 6</h2>
                    <h4>Waitlist</h4>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> 33</h2>
                    <h4>Slots</h4>
                  </div>
                </div>
              </div>
              </div>
              <!--#end Reservation overview-->

              

              <!-- Latest Users -->
              <div class="panel panel-default">
                <div class="panel-heading col-md-12" style="margin-bottom: 1%">
                  <div class="col-md-11">
                    <h3 class="panel-title">LIST</h3>
                  </div>
                  <div class="col-md-1">
                    <a href="c_printList.php" class="btn btn-primary glyphicon glyphicon-print btn-sm" type="button" title="Print Reservation List"></a>
                  </div>
                </div>
                <div class="panel-body">
                  <table class="table table-hover">
                      <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Strand</th>
                        <th>SASE</th>
                        <th>Status</th>
                        <th></th>
                         
                      </tr>
                      <tr>
                        <td>5</td>
                        <td>Jill Smith</td>
                        <td>STEM</td>
                        <td>79</td>
                        <td>reserved</td>
                        <td><button class="btn button" type="submit" name="theButton">Enroll</button></td>
                      </tr>
                      <tr>
                        <td>4</td>
                        <td>Eve Jackson</td>
                        <td>STEM</td>
                        <td>81</td>
                        <td>reserved</td>
                        <td><button class="btn button" type="submit" name="theButton">Enroll</button></td>
                      </tr>
                      <tr>
                        <td>3</td>
                        <td>John Doe</td>
                        <td>ABM</td>
                        <td>83</td>
                        <td>reserved</td>
                        <td><button class="btn button" type="submit" name="theButton">Enroll</button></td>
                      </tr>
                      <tr>
                        <td>2</td>
                        <td>Stephanie Landon</td>
                        <td>STEM</td>
                        <td>92</td>
                        <td>reserved</td>
                        <td><button class="btn button" type="submit" name="theButton">Enroll</button></td>
                      </tr>
                      <tr>
                        <td>1</td>
                        <td>Mike Johnson</td>
                        <td>ABM</td>
                        <td>80</td>
                        <td>reserved</td>
                        <td><button class="btn button" type="submit" name="theButton">Enroll</button></td>
                      </tr>
                    </table>
                </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <!--Footer-->
    <?php include "includes/c_footer.php";?>
    <!--#end Footer-->

    <!-- Modals -->
    <div class="modal fade" id="setCutOff" role="dialog">
      <div class="modal-dialog modal-md">
        <div class="modal-content">
           <!-- c_setCutOff.php -->
        </div>
      </div>
    </div>

    <!-- Add Page -->
    <div class="modal fade" id="addPage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form>
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Page</h4>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <label>Page Title</label>
          <input type="text" class="form-control" placeholder="Page Title">
        </div>
        <div class="form-group">
          <label>Page Body</label>
          <textarea name="editor1" class="form-control" placeholder="Page Body"></textarea>
        </div>
        <div class="checkbox">
          <label>
            <input type="checkbox"> Published
          </label>
        </div>
        <div class="form-group">
          <label>Meta Tags</label>
          <input type="text" class="form-control" placeholder="Add Some Tags...">
        </div>
        <div class="form-group">
          <label>Meta Description</label>
          <input type="text" class="form-control" placeholder="Add Meta Description...">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </form>
    </div>
  </div>
</div>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
        <!-- CORE JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="../assets/js/bootstrap.js"></script>
  </body>
</html>
