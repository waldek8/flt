<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>FL Technics</title>

		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	</head>


	<?php
		$servername = "localhost";
		$username = "dfbalt_flt";
		$password = "LiubijimaiPametiniai";
		$dbname = "dfbalt_flt";

		$conn = new mysqli($servername, $username, $password, $dbname);
	?>
	
	<body>
		<?php
			if ($conn->connect_error) {
			    die("Connection failed: " . $conn->connect_error);
			} 
		?>

		<div class="container">

			<h2>Query 1</h2>
			<p>Padaryti Microsoft Access‘e užklausą, kuri prie kiekvieno „pn“ sąraše rodytų Qty_oh vidurkį pagal „pn“.</p>

			<code>SELECT PN, ROUND(AVG(QTY_OH), 3) AS 'QTY_OH Vidurkis' FROM `FLT` GROUP BY PN</code>

			<br><br>

			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  			<div class="panel panel-default">
	    			<div class="panel-heading" role="tab" id="headingOne">
	      				<h4 class="panel-title">
	        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#resultOne" aria-expanded="true" aria-controls="collapseOne"> Rezultatas </a>
	        			</h4>
	        		</div>

	        		<div id="resultOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      				<div class="panel-body">

						<table class="table table-striped">
							<tr>
							    <th>#</th>
							    <th>PN</th> 
							    <th>QTY_OH Vidurkis</th>
							</tr>

	        				<?php
								$sql = "SELECT PN, ROUND(AVG(QTY_OH), 3) AS 'QTY_OH Vidurkis' FROM FLT GROUP BY PN";
								$result = $conn->query($sql);

								if ($result->num_rows > 0) {
					    			$i = 1;
					    			while($row = $result->fetch_assoc()) {
					    				echo '<tr>';
					    				echo '<td>'. $i++ .'</td>';
						        		echo '<td>' .$row["PN"]. "</td><td>" . $row["QTY_OH Vidurkis"]. "</td>";
						        		echo '</tr>';

					    			}
								} else {
					    			echo "No results";
								}
							?>

							</table>
	      				</div>
	    			</div>
	  			</div>
	  		</div>


			<h2>Query 2 (v. 1)</h2>
			<p>Padaryti Microsoft Access‘e užklausą, kuri prie kiekvieno „pn“ sąraše rodytų kiekį, kiek sąraše yra tokių pat „pn“ su vienoda kondicija (kondicija Excel nurodoma dviem simboliais).</p>

			<code>SELECT COUNT(PN) as 'Kiekis', PN, CONDITION_CODE FROM `FLT` GROUP BY PN, CONDITION_CODE</code>

			<br><br>

			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
	  			<div class="panel panel-default">
	    			<div class="panel-heading" role="tab" id="headingOne">
	      				<h4 class="panel-title">
	        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#resultTwo" aria-expanded="true" aria-controls="collapseOne"> Rezultatas </a>
	        			</h4>
	        		</div>

	        		<div id="resultTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	      				<div class="panel-body">

		      				<table class="table table-striped">
								<tr>
								    <th>#</th>
								    <th>Įrašų (eilučių) kiekis</th>
								    <th>PN</th> 
								    <th>CONDITION_CODE</th>
								</tr>				

		        				<?php
									$sql = "SELECT COUNT(PN) as 'Kiekis', PN, CONDITION_CODE FROM FLT GROUP BY PN, CONDITION_CODE";
									$result = $conn->query($sql);

									if ($result->num_rows > 0) {
						    			$i = 1;
						    			while($row = $result->fetch_assoc()) {
						    				echo '<tr>';
					    					echo '<td>'. $i++ .'</td>';
						        			echo '<td>'.$row["Kiekis"]. "</td><td>" .$row["PN"]. "</td><td>" . $row["CONDITION_CODE"]. "</td>";
						        			echo '</tr>';
						    			}
									} else {
						    			echo "No results";
									}
								?>

							</table>
	      				</div>
	    			</div>
	  			</div>
	  		</div>			

		

			<h2>Query 2 (v. 2)</h2>
				<p>Padaryti Microsoft Access‘e užklausą, kuri prie kiekvieno „pn“ sąraše rodytų kiekį, kiek sąraše yra tokių pat „pn“ su vienoda kondicija (kondicija Excel nurodoma dviem simboliais).</p>

				<code>SELECT SUM(QTY_OH) as 'Kiekis', PN, CONDITION_CODE FROM `FLT` GROUP BY PN, CONDITION_CODE</code>

				<br><br>

				<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
		  			<div class="panel panel-default">
		    			<div class="panel-heading" role="tab" id="headingOne">
		      				<h4 class="panel-title">
		        				<a role="button" data-toggle="collapse" data-parent="#accordion" href="#resultThree" aria-expanded="true" aria-controls="collapseOne"> Rezultatas </a>
		        			</h4>
		        		</div>

		        		<div id="resultThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
		      				<div class="panel-body">

			      				<table class="table table-striped">
									<tr>
									    <th>#</th>
									    <th>Detalių kiekis</th>
									    <th>PN</th> 
									    <th>CONDITION_CODE</th>
									</tr>				

			        				<?php
										$sql = "SELECT SUM(QTY_OH) as 'Kiekis', PN, CONDITION_CODE FROM FLT GROUP BY PN, CONDITION_CODE";
										$result = $conn->query($sql);

										if ($result->num_rows > 0) {
							    			$i = 1;
							    			while($row = $result->fetch_assoc()) {
							    				echo '<tr>';
						    					echo '<td>'. $i++ .'</td>';
							        			echo '<td>'.$row["Kiekis"]. "</td><td>" .$row["PN"]. "</td><td>" . $row["CONDITION_CODE"]. "</td>";
							        			echo '</tr>';
							    			}
										} else {
							    			echo "No results";
										}
									?>

								</table>
		      				</div>
		    			</div>
		  			</div>
		  		</div>			

				<a target="_blank" href="https://github.com/waldek8/flt.git">Source on GitHub</a>	

			</div>

		<?php
			$conn->close();
		?>
	</body>
</html>