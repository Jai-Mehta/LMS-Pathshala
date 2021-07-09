<!DOCTYPE html>
<html>
<head>
	<title>Quiz Questions Number</title>
</head>
<?php  
	$number_of_questions = 1;
	$number_of_options = 2;
	$subject = "Subject";
	$code = "code3";
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		for($i=1;$i<=$number_of_questions;$i++){
	  		$question = $_POST[$code.$i];
	  		$marks_per_question = $_POST[$code.$i.'marks'];
	  		$options = array();
	  		for($j=1;$j<=$number_of_options+1;$j++){
	  			array_push($options,$_POST[$code.$i.$j]);
			}
			$db = mysqli_connect('localhost','root','','quiz');
			if (!$db) {
				die("Connection failed: " . mysqli_connect_error());
			}
			else {
				if($number_of_options==2){
					$sql = "INSERT INTO quiz_qanda (quiz_code,question,a_1,a_2,correct_answer,subject,marks) VALUES ('$code','$question','$options[0]','$options[1]','$options[2]','$subject','$marks_per_question')";
				}
				if($number_of_options==3){
					$sql = "INSERT INTO quiz_qanda (quiz_code,question,a_1,a_2,a_3,correct_answer,subject,marks) VALUES ('$code','$question','$options[0]','$options[1]','$options[2]','$options[3]','$subject','$marks_per_question')";
				}
				if($number_of_options==4){
					$sql = "INSERT INTO quiz_qanda (quiz_code,question,a_1,a_2,a_3,a_4,correct_answer,subject,marks) VALUES ('$code','$question','$options[0]','$options[1]','$options[2]','$options[3]','$options[4]','$subject','$marks_per_question')";
				}

				if($number_of_options==5){
					$sql = "INSERT INTO quiz_qanda (quiz_code,question,a_1,a_2,a_3,a_4,a_5,correct_answer,subject,marks) VALUES ('$code','$question','$options[0]','$options[1]','$options[2]','$options[3]','$options[4]','$options[5]','$subject','$marks_per_question')";
				}
				if($number_of_options==6){
					$sql = "INSERT INTO quiz_qanda (quiz_code,question,a_1,a_2,a_3,a_4,a_5,a_6,correct_answer,subject,marks) VALUES ('$code','$question','$options[0]','$options[1]','$options[2]','$options[3]','$options[4]','$options[5]','$options[6]','$subject','$marks_per_question')";
				}
				
				
				if (mysqli_query($db, $sql)) {
					mysqli_close($db);
				}
		  	}
	  	}
	  	header("location:http://localhost/success.html");
	}

?>
<body>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<?php 
			for($q = 1; $q <= $number_of_questions; $q++) {
			  echo "Question ".$q."<br>";
			  ?><input type="text" name="<?php echo $code.$q; ?>" required="True"><br>
			  <?php
			  for($o = 1; $o <= $number_of_options+1; $o++){
			  	if($o <= $number_of_options){
			  		echo "Option ".$o."<br>";
			  		?><input type="text" name="<?php echo $code.$q.$o; ?>" required="True"><br>
			  		<?php
			  	}
			  	else{
			  		echo "Enter the correct answer choice here:"."<br>";
			  		?><input type="text" name="<?php echo $code.$q.$o; ?>" required="True"><br>
			  		<?php
			  	}
			  	
			  }
			  echo "Enter the marks for the above question"."<br>";
			  ?><input type="text" name="<?php echo $code.$q.'marks'; ?>" required="True"><br><br><br><?php
			}
		?>
		<input type="submit" name="submit">
	</form>
</body>
</html>