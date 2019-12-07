<?php

if(isset($_POST['submit'])){
	if(!empty($_POST['check_list'])){
		//counting number of checked checkboxes
		$checked_count = count($_POST['check_list']);
		echo "You have selected the following ".$checked_count." option(s):<br />";
		//loop to store and display values of individual checked checkbox.
		foreach($_POST['check_list'] as $selected) {
			echo "<p>".$selected."</p>";
		}
		echo "<br /><b>Note: </b> <span>Similarly, You Can Also Perform Crud Operations using These Selected Values.</span>";
	} else {
		echo "<b> Please Select Atleast One Option</b>";
	}
}

?>