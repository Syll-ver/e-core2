<!DOCTYPE html>
<html>
<head>
	<title>PHP: Get Values of Multiple Checked Checkboxes</title>
</head>
<body>

	<div class="container">
		<div class="main">
			<h2>PHP: Get Values of Multiple Checked Checkboxes</h2>

			<form action="php_checkboxes.php" method="post">
				<label class="heading">
					Select Your Technical Exposure:
				</label>
				<table>
					<thead>
						<tr>
							<td>checkbox</td>
							<td>Labels</td>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td><input type="checkbox" name="check_list[]" value="Java"></td>
							<td><label>Java</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="check_list[]" value="PHP"></td>
							<td><label>PHP</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="check_list[]" value="C++"></td>
							<td><label>C++</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="check_list[]" value="HTML/CSS"></td>
							<td><label>HTML/CSS</label></td>
						</tr>
						<tr>
							<td><input type="checkbox" name="check_list[]" value="UNIX"></td>
							<td><label>UNIX</label></td>
						</tr>
					</tbody>
				</table>
				<input type="submit" name="submit" value="Submit">
				<!-- <input type="checkbox" name="check_list[]" value="Java"> <label>Java</label>
				<input type="checkbox" name="check_list[]" value="PHP"> <label>PHP</label>
				<input type="checkbox" name="check_list[]" value="C++"> <label>C++</label>
				<input type="checkbox" name="check_list[]" value="HTML/CSS"> <label>HTML/CSS</label>
				<input type="checkbox" name="check_list[]" value="UNIX"> <label>UNIX</label>
				<input type="submit" name="submit" value="Submit"> -->

			</form>
		</div>
	</div>

</body>
</html>
