<?php
include 'connection.php';
    $statusMsg = '';
	// Saves data into database
	if(isset($_POST['btnSave'])){
        
        $r1=$_POST['random1'];
		$r2=$_POST['random2'];
		$checkcap= $r1+$r2;
		$res=$_POST['capResult'];
	    if(  $res == $checkcap)      //comparing captcha
		{
			$name= $_POST['a_name'];
			$category= $_POST['a_category'];
			$image= $_FILES['a_image']['name'];
			$description= $_POST['a_description'];
			$life= $_POST['a_life'];
		
			$query="insert into animal(name,category,image,description,life,Date)values('$name','$category','$image','$description','$life',CURDATE())";
			$res=mysqli_query($con, $query);
			if($res)
			{
				move_uploaded_file($_FILES["a_image"]["tmp_name"], "upload/".$_FILES["a_image"]["name"]);
				  $statusMsg = "Record Added";
			}
			else{
				 $statusMsg = "Something went wrong, Please try again";
			}
	// Display status message
	echo "<script type='text/javascript'>alert('{$statusMsg}');document.location='animal.php';</script>";
		}
		else
		{
			echo '<script>alert("You entered an incorrect Captcha")</script>' ;
            echo "<script type='text/javascript'>document.location='submission.php';</script>";
		}

		
	}
?>
