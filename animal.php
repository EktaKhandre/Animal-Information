<?php 
session_start();
include 'connection.php';

//Display view counter
function view(){
    if(isset($_SESSION['views']))
        $_SESSION['views'] = $_SESSION['views']+1;
    else
        $_SESSION['views']=1;

    echo $_SESSION['views'];
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Display Animal Information </title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>

    <body>
    <div class="search">
        <form action="" method = "GET">
            <div class="title">Animal Information</div><br><br>
  <!-- Filters of Category and Life Expectency -->
    
            <span class="details"><b>Category : </b></span>
            <select name="a_category"  >
                <option>Select Category</option>
                <option value="Herbivores">Herbivores</option>
                <option value="Carnivores">Carnivores</option>
                <option value="Omnivores">Omnivores</option></select><br><br>
   
            <span class="details"> <b>Life Expectancy :</b></span>
            <select name="a_life"  >
                <option>Select Life Expectancy</option>
                <option value="0-1">0 - 1 year</option>
                <option value="1-5">1 - 5 years</option>
                <option value="5-10">5 - 10 years</option>
                <option value="10+">10 + years</option></select><br><br>

            <button type="submit" class="buttonbg">Search</button> 

</div>

</form>
         <div class="header_fixed">
        <span class="vc">View Counter : <?php echo view(); ?></span>
             <table>
                 <thead>
                 <tr>
                     <th>Image</th>
                     <th>Name</th>
                     <th>Category</th>
                     <th>Description</th>
                     <th>Life Expectancy</th>
                 </tr>
                 </thead>
                 
                    <?php  //Filtering content according to the life exixtency and category
                        if(isset($_GET['a_category']) && isset($_GET['a_life']) )
                        {
                            $select1=$_GET['a_category'];   
                            $select2=$_GET['a_life']; 
                            $query1 =mysqli_query($con,"select * from animal where category = '$select1' and life = '$select2' ORDER BY date,name ASC ") ; // Filter data as per selected
                            if(mysqli_num_rows($query1)>0)
                            {
                                foreach($query1 as $row1){
                    ?>

                 <tbody>
                 <tr>
                        <!-- Display List of Animal Information after applying filters-->
                        <td><img src='<?php echo "upload/".$row1['image']; ?>'></td>
                        <td><?php echo $row1['name']; ?></td>
                        <td><?php echo $row1['category']; ?></td>
                        <td><?php echo $row1['description']; ?></td>
                        <td><?php echo $row1['life']; ?></td>
                </tr>

                <?php     
                            }
                        }
                        else{echo "No Record Found";}
                        }
                        else{
                                $query2 =mysqli_query($con,"select * from animal ORDER BY name,date ASC") ; // Display data alphabetically
                                if(mysqli_num_rows($query2)>0)
                                {
                                    foreach($query2 as $row2){
                ?>
                
                <tr>
                    <!-- Display List of Animal Information without filters-->
                        <td><img src='<?php echo "upload/".$row2['image']; ?>' ></td>      
                        <td><?php echo $row2['name']; ?></td>
                        <td><?php echo $row2['category']; ?></td>
                        <td><?php echo $row2['description']; ?></td>
                        <td><?php echo $row2['life']; ?></td>
                        </tr>
                <?php     
                                    }
                                }
                                else{echo "No Record Found for animals";}
                            }
                ?>
                 </tbody>
             </table>
             
         </div>
    </body>
</html>
