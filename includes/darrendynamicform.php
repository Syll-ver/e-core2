<?php
/*
Author: Javed Ur Rehman
Website: https://www.allphptricks.com
*/
$array_values="";
$array_valuess="";
if (isset($_POST["input_array_name"]) && is_array($_POST["input_array_name"]) || isset($_POST["input_array_names"]) && is_array($_POST["input_array_names"])){ 

	$input_array_name = array_filter($_POST["input_array_name"]);
    $input_array_names = array_filter($_POST["input_array_names"]); 

    while($field_value = each($_POST["input_array_name"]) && $field_values = each($_POST["input_array_names"])){
        $array_values .= $field_value.": ". $array_valuess .= $field_values."<br />";
    }





    /*
    for($i = 0; $i < $num; $i++){

        echo $array_values .= $field_value.": ". $array_valuess .= $field_values."<br />";
    }*/

    //foreach($input_array_name as $field_value & $input_array_names as $field_values){
    //    $array_values .= $field_value.": ". $array_valuess .= $field_values."<br />";
    //}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Demo Add Remove Input Fields Dynamically using jQuery - AllPHPTricks.com</title>
</head>
<body>
<h1>Demo Add Remove Input Fields Dynamically using jQuery</h1>
<?php echo $array_values;
echo $array_valuess;
?>
<form name="FormData" method="post" action="" >
<div class="wrapper">
<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" />
<input type="text" name="input_array_names[]" placeholder="Input Text Here" /></div>
</div>

<p><button class="add_fields">Add More Fields </button></p>
<input type="submit" value="Submit" />
</form>

<br /><br />
<a href="https://www.allphptricks.com/add-remove-input-fields-dynamically-using-jquery/">Tutorial Link</a> <br /><br />
For More Web Development Tutorials Visit: <a href="https://www.allphptricks.com/">AllPHPTricks.com</a>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
//Add Input Fields
$(document).ready(function() {
    var max_fields = 10; //Maximum allowed input fields 
    var wrapper    = $(".wrapper"); //Input fields wrapper
    var add_button = $(".add_fields"); //Add button class or ID
	var x = 1; //Initlal input field is set to 1
	
	//When user click on add input button
	$(add_button).click(function(e){
        e.preventDefault();
		//Check maximum allowed input fields
        if(x < max_fields){ 
            x++; //input field increment
			 //add input field
            $(wrapper).append('<div><input type="text" name="input_array_name[]" placeholder="Input Text Here" /> <input type="text" name="input_array_names[]" placeholder="Input Text Here" /> <a href="javascript:void(0);" class="remove_field">Remove</a></div>');
        }
    });
	
    //when user click on remove button
    $(wrapper).on("click",".remove_field", function(e){ 
        e.preventDefault();
		$(this).parent('div').remove(); //remove inout field
		x--; //inout field decrement
    })
});
</script>
</body>
</html>