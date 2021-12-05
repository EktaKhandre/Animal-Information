<!doctype html>
<html lang="en">
<head>
	<title>Animal Information</title>
<?php 
session_start();
// Create database connections
$dbHost     = "sql307.epizy.com";
$dbUsername = "epiz_30516472";
$dbPassword = "gWXWJPDpJo0iK";
$dbName     = "epiz_30516472_animal_database";
$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if(!$con){
  die("Connection failed: " .mysqli_connect_error());
}
?>

<style>
.buttonbg
{
	
	border-radius:2px;
	width:100px;
	height:40px;
	font-family:Cambria;
	border-radius: 10px 10px 10px 10px;
	font-size:20px;
	
}
.buttonbg:hover
{
	background-color:#ADD8E6;
	color:#000000;
}

.f1{
	padding: 50px 20px 50px 400px;
	background-color:#d0e9f1;
}

<?php 
// Declare varaibles for captcha
	$randomno1=mt_rand(1,9);
	$randomno2=mt_rand(1,9);
?>

</style>
</head>
<body>
	<!-- Input form for animal information -->
<div class='f1'>
	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post" enctype="multipart/form-data">   
		<h2 style="font-family:Cambria;"><left> ANIMAL INFORMATION </left></h2>
		<table style="border: 2px solid ; font-family:Cambria; font-size:20px; margin-top: 20px; padding: 80px; background-color:#FFFAFA">
		<tr>
		 	<td style="padding: 10px 20px 15px 20px;"><b> NAME:</b></td>
		      	<td style="padding: 10px 20px 15px 20px;"><input type="text" name="a_name" placeholder="" style="height:30px; width:400px; font-family:Cambria;" required/>					</td>
		</tr>
		<tr>
			<td style="padding: 10px 20px 15px 20px;"><b> CATEGORY :</b></td>
			<td style="padding: 10px 20px 15px 20px;"><select name="a_category" style="height:30px; width:400px; font-family:Cambria;" required>
							<option value="Herbivores">Herbivores</option>
                                                        <option value="Carnivores">Carnivores</option>
                                                        <option value="Omnivores">Omnivores</option>
			                                </select>	
		        </td>
		</tr>
        	<tr>
			<td style="padding: 10px 20px 15px 20px;"><b> IMAGE :</b></td>
			<td style="padding: 10px 20px 15px 20px;"><input type="file" name="a_image" style="height:30px; width:400px; font-family:Cambria;" required></td>
		</tr>
		<tr>
			<td style="padding: 10px 20px 15px 20px;"><b> DESCRIPTION :</b></td>
			<td style="padding: 10px 20px 15px 20px;"><textarea name="a_description" placeholder="" style="height:50px; width:400px; font-family:Cambria;" required></textarea></td>
		</tr>
		<tr>
			<td style="padding: 10px 20px 15px 20px;"><b> LIFE EXPECTANCY :</b></td>
			<td style="padding: 10px 20px 15px 20px;"><select name="a_life" style="height:40px; width:400px; font-family:Cambria;" required>
								  <option value="0-1">0 - 1 year</option>
                                                                  <option value="1-5">1 - 5 years</option>
                                                                  <option value="5-10">5 - 10 years</option>
                                                                  <option value="10+">10 + years</option>
				                                  </select>	
			</td>
		</tr>			
		<tr>			
			<td style="padding: 10px 20px 15px 180px;"><?php echo $randomno1 . ' + ' . $randomno2 . ' = ' ?></td>
			<td style="padding: 10px 10px 15px 20px;"> <input type="number" name="capResult"></td>
                        <input type="hidden" name="random1" value="<?php echo $randomno1 ?>" >
			<input type="hidden" name="random2" value="<?php echo $randomno2 ?>" >
			
		<tr>
			<td height="49" colspan="" style="padding-left:150px ; padding-top:10px;">
			<input type="reset" name="btnClear" value="Clear" class="buttonbg"/></td>
			<td height="49" colspan="2" style="padding-left: 160px; padding-top:10px;">
			<input type="submit" name="btnSave" value="Save" class="buttonbg"/>  </td>
		</tr>		
		<div>	
	</table>
</form> 
</div>
</body>
<?php
    $statusMsg = '';
    $checkcap= $randomno1+$randomno2;
    // Saves data into databas
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
			$discription= $_POST['a_description'];
			$life= $_POST['a_life'];
		
			$query="insert into animal(name,category,image,description,life,date)values('$name','$category','$image','$discription','$life',CURDATE())";
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
		}
	}
?>
