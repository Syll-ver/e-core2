<?php
	include_once('includeThis/connect.php');

	$database = new Connection();
	$db = $database->open();

	try{	
	    $sql = 'SELECT * FROM college';
	    foreach ($db->query($sql) as $row) {
	    	?>
	    	<tr>
	    		<td><?php echo $row['collegeCode']; ?></td>
	    		<td><?php echo $row['collegeName']; ?></td>
	    		<td>
	    			<button class="btn btn-success btn-sm edit" data-id="<?php echo urlencode(http_build_query($row)); ?>"><span class="glyphicon glyphicon-edit"></span> Edit</button>
	    			<button class="btn btn-danger btn-sm delete" data-id="<?php echo $row['collegeCode']; ?>"><span class="glyphicon glyphicon-trash"></span> Delete</button>
	    		</td>
	    	</tr>
	    	<?php 
	    }
	}
	catch(PDOException $e){
		echo "There is some problem in connection: " . $e->getMessage();
	}

	//close connection
	$database->close();
	
?>