<html>
<head>
  <title>Display Animal Information </title>
</head>
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
/* Styling the table */
#tab{
	padding-left:70px;
	margin-top:0px;
	margin-bottom: 90px;
        margin-left: 20px;
	border-collapse:collapse;
	font-family:Cambria;
	font-size: 17px;
	
}
#tab th{
	padding:10px 10px 10px 10px;
	border: 2px solid black;
}
#tab td {
	padding:10px 10px 10px 10px;
	border: 2px solid black;
}
</style>
	
<body style="background-color:#d0e9f1;">
<h2 style="font-family:Cambria;"><left> ANIMAL INFORMATION </left></h2>

<?php 
      //Display view counter
      if(isset($_SESSION['views']))
           $_SESSION['views'] = $_SESSION['views']+1;
      else
           $_SESSION['views']=1;
?>
<p style="font-family:Cambria; font-size: 17px;">View Counter: <?php echo $_SESSION['views']; ?></p>
<form action="" method = "GET">
	<!-- Filters of Category and Life Expectency -->
	<table style="font-family:Cambria; font-size:20px; margin-top: 20px;" >
    	<tr>                                            
    		<td>
    		<select name="a_category" style="height:30px; width:400px; font-family:Cambria;" >
    		<option>Select Category</option>
    		<option value="Herbivores">Herbivores</option>
    		<option value="Carnivores">Carnivores</option>
    		<option value="Omnivores">Omnivores</option></select>
    		</td>
    		<td>
    		<select name="a_life" style="height:30px; width:400px; font-family:Cambria;" >
    		<option>Select Life Expectancy</option>
    		<option value="0-1">0 - 1 year</option>
    		<option value="1-5">1 - 5 years</option>
    		<option value="5-10">5 - 10 years</option>
    		<option value="10+">10 + years</option></select>
    		</td>
    		<td> <button type="submit">Search</button> </td>
	</tr>
  	</table>
</form>
<?php 
    
?>
<!-- Display List of Animal Information -->
<table  id ="tab" style="border: 2px solid ; font-family:Cambria; font-size:20px; margin-top: 20px; padding: 80px; background-color:#FFFAFA">
<tr>
     
      <th>Name</th>
      <th>Category</th>
      <th>Image</th>
      <th>Description</th>
      <th>Life Expectancy</th>
</tr>
<?php 
    
    if(isset($_GET['a_category']) && isset($_GET['a_life']) )

    {
      $select1=$_GET['a_category'];   
      $select2=$_GET['a_life']; 
      $query1 =mysqli_query($con,"select * from animal where category = '$select1' and life = '$select2' ORDER BY date,name ASC ") ; // Filter data as per selected
      if(mysqli_num_rows($query1)>0)
      {
         foreach($query1 as $row1){
    
?>
<tr>
     
      <td><?php echo $row1['name']; ?></td>
      <td><?php echo $row1['category']; ?></td>
      <td><img src='<?php echo "upload/".$row1['image']; ?>'  width="230" height="200"></td>
      <td><?php echo $row1['description']; ?></td>
      <td><?php echo $row1['life']; ?></td>
</tr>
<?php     
      }
    }
    else{
      echo "No Record Found";
    }
  }
  else{
    $query2 =mysqli_query($con,"select * from animal ORDER BY name,date ASC") ; // Display data alphabetically
    if(mysqli_num_rows($query2)>0)
    {
      foreach($query2 as $row2){
    
?>
<tr>
      <td><?php echo $row2['name']; ?></td>
      <td><?php echo $row2['category']; ?></td>
      <td><img src='<?php echo "upload/".$row2['image']; ?>'  width="230" height="200"></td>
      <td><?php echo $row2['description']; ?></td>
      <td><?php echo $row2['life']; ?></td>
</tr>
<?php     
      }
    }
    else{
      echo "No Record Found for animals";
    }
  } 
?>
</table>
</div>
</body>
</html>
