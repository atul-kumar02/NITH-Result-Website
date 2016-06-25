<html>
<head>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
	<style type="text/css">
	p{
		text-align: center;
		font-size: 2.5em;
	}
	#getit
	{
		  background: rgb(229,76,16);
		  margin-top: 10px;
	}
	</style>
</head>

<?php
	$db_user="root";
	$db_pass="justgoogleit";
	$db_name="results";
	@ $db = new mysqli('localhost', 'root', 'justgoogleit', 'results');
	if (mysqli_connect_errno()) 
	{
		echo "Error: Could not connect to database. Please try again later.";
		exit;
	}
	$year = $_POST['year'];
	$branch = $_POST['branch'];
	if($year=="12")
	{
		if($branch=="7")
		{
			echo "<p>Does not exist</p>";
			exit;
		}
	}
	if($year=="11")
	{
		if($branch!="6")
		{
			echo "<p>Does not exist</p>";
			exit;
		}
	}
	$year1 = $year."MI";
	$year2 = "IIITU".$year;
	$year = $year.($branch);
	$year1 = $year1.$branch;
	$temp = $branch;
	if($temp=="5")
		$temp="1";
	else if($temp=="4")
		$temp="2";
	$year2 = $year2.$temp;
	$query = "select * from students where roll_no like '$year%' or roll_no like '$year1%' or roll_no like '$year2%' order by cgpi desc";
	$result = $db->query($query);
	$num_results = $result->num_rows;
	echo "<p>Number of Results found: ".$num_results."</p>";
	?>

	<table class="inventory" width="100%">
		<caption>
			
		</caption>
		<colgroup>
			<col id="Srno">
			<col id="Roll">
			<col id="Name">
			<col id="cgpi">
			<col id="college">
			<col id="year">
		</colgroup>
		<tr>
			<th scope="col">Sr. No.</th>
			<th scope="col">Roll Number</th>
			<th scope="col">Name</th>
			<th scope="col">CGPI</th>
			<th scope="col">College Rank</th>
			<th scope="col">Year Rank</th>
		</tr>
		<tr>
		
	<?php
	for ($i=0; $i <$num_results; $i++) 
	{
		$row = $result->fetch_assoc();
		?>
		<td><?php echo ($i+1) ?></td>
		<td><?php echo stripslashes($row['roll_no'])?></td>
		<td><?php echo htmlspecialchars(stripslashes($row['name']))?></td>
		<td><?php echo stripslashes($row['cgpi']) ?></td>
		<td><?php echo stripslashes($row['college_rank']) ?></td>
		<td><?php echo stripslashes($row['year_rank']) ?></td>
		<td>
			<form action="semester.php" method="post">
				<input type="submit" value="<?php echo $row['roll_no'] ?>" id="getit" name="Name">
			</form>
		</td>
	</tr>
		<?php
	}
	?>
	</tr>
	</table>
	<?php
	
?>
</html>