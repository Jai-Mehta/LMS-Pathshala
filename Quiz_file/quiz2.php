<!DOCTYPE html>
<html>
<head>
	<title>Quiz Retreival</title>
</head>
<?php  
	$code = 'code3';
	$db = mysqli_connect('localhost','root','','quiz');
	if (!$db) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	else {
		$query = "SELECT * FROM quiz_qanda WHERE quiz_code = '$code';";
		$result = mysqli_query($db,$query); 
		$row = "";
	    if ($result){
		$row = mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
	}
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$answers = array();
		for($k=1;$k<=count($row);$k++){
			array_push($answers, $_POST[$code.$k]);
		} 
		$correct = 0;
		$score = 0;
		for($n=0;$n<count($row);$n++){
			if($answers[$n]==$row[$n]["correct_answer"]){
				$correct = $correct + 1;
				$score = $score + $row[$n]["marks"];
			}
		}
		echo "Number of questions correct/Total number of questions: ".$correct."/".count($row)."<br>";
		echo "You scored: ".$score;
	}

?>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php 
			for($i=0;$i<count($row);$i++){
				$question_no = $i+1;
				echo $question_no.")";
				echo $row[$i]["question"]."(".$row[$i]["marks"]." M)"."<br>";
				for($j=1;$j<=6;$j++){
					if($row[$i]["a_".$j]!=NULL){

						?>
						<input type="radio" name="<?php echo $code.$question_no ?>" value="<?php echo $row[$i]["a_".$j]; ?>">
						<?php 
					}
					echo $row[$i]["a_".$j]."<br>";
				}
				
			}
		?>
		<input type="submit" name="submit">
	</form>

</body>
</html>