<?php
include("config/config.php");
$results = $pdo->prepare('SELECT * FROM students WHERE "student_id" NOT IN (SELECT "student_id" FROM reservation) ');
$results->execute();
$id = $results->fetchAll();

$academicYear = $pdo->prepare("SELECT  \"acadYear\" FROM academic_year WHERE status='true';" );
$academicYear->execute();
$rows = $academicYear->fetch(); 

$course = $pdo->prepare("SELECT * FROM course_offered JOIN academic_year USING (\"acadYear\") WHERE status=true AND \"GR_criteria\" != null AND \"AP\" != null AND \"LU\" != null AND\"MA\" != null AND \"SC\" != null;" );
$course->execute();
$rows = $course->fetch(); 

?>

<style type="text/css">
    
    /* Formatting search box */
    .search-box input[type="text"]{
      height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }

    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
   
    }

    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
        background: white;
      }

    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 2px solid #CCCCCC;
        border-top: none;
        cursor: pointer;

    }
    .result p:hover{
            background: #e9e9e9;
    }
</style>
<script src="jquery-1.12.4.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('.search-box input[type="text"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("search.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>



<div class="modal-header">
  <h3 class="modal-title" id="exampleModalLabel">Reserve Student</h3>
</div>
        
<div class="modal-body">
  <form name="dept" method="post">
    <div class="form-group col-md-12">
      <label for="search" style="font-size: 13px;">Search:</label>
        <div class="search-box">
          <form class="hidden-form" method="post">
            <input class="form-control rounded" style="font-size: 12px;" onblur="showDiv('hidden_div', this)" id="search" name="search" type="text" autocomplete="off" placeholder="Search Last Name..." />
            <div class="result"></div>
          </form>
        </div>
    </div>

    <p>
      <?php
      echo "<script>document.write(document.getElementById('search').value)</script>";
      ?>
    </p>



    <div id="hidden_div" style="display: none">
    <p id="demo">
     
    </p>

    </div>
                      







  </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button class="btn btn-primary" data-type="confirm">Save</button>
        </div>



<script>
  function showDiv(divId, element){
    document.getElementById(divId).style.display = element.value != null  ? 'block' : 'none';


    <?php 
    
    
    foreach($id as $i){
      if($i['student_id'] ==)
    }
    ?>

    // <?php 
    // $academicYear = $pdo->prepare("SELECT  listcourses('".."')");
    // $academicYear->execute();
    // $rows = $academicYear->fetch(); 
    //  ?>

    // document.getElementById("search").value;
  }

  // var timer = null;
  // $('#search').blur(function(){
  //        clearTimeout(timer); 
  //        timer = setTimeout(doStuff, 1000);
  // });

  function himo(divId, element){
    var timer = null;
    clearTimeout(timer); 
    timer = setTimeout(doStuff, 3000);
  }

  function doStuff(divId, element) {
      alert('do stuff');

  }

</script>
<script src="script_filterSearch.js"></script>
