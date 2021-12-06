<?php
// Start the session
session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Animal Information</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="css/style.css" rel="stylesheet">
    </head>
    <body>

    <?php 
        // Declare varaibles for captcha
	    $randomno1=mt_rand(1,9);
	    $randomno2=mt_rand(1,9);
    ?>
        <div class="container">
            <div class="title">Register Animal Information</div>
            <form action="add_submission.php" method="post" enctype="multipart/form-data"> 
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Animal Name :</span>
                        <input type="text" name="a_name"  required>
                    </div>
                </div>
                
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Category :</span>
                        <select name="a_category" required>
                            <option value="Herbivores">Herbivores</option>
                            <option value="Carnivores">Carnivores</option>
                            <option value="Omnivores">Omnivores</option>
                        </select> 
                    </div>
                </div>
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Image</span>
                        <input type="file" name="a_image" required>
                    </div>
                </div>
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Description</span>
                        <textarea name="a_description" rows="" cols="" required></textarea>
                    </div>
                </div>
                
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Life Expectancy</span>
                        <select name="a_life" required>
                            <option value="0-1">0 - 1 year</option>
                            <option value="1-5">1 - 5 years</option>
                            <option value="5-10">5 - 10 years</option>
                            <option value="10+">10+ years</option>
                        </select> 
                    </div>
                </div>
                <div class="ani-details">
                    <div class="inputbox">
                        <span class="details">Enter Captcha Code <br> <?php echo $randomno1 . ' + ' . $randomno2 . ' = '  ?></span>
                        <input type="number" name="capResult" required>
                        <input type="hidden" name="random1" value="<?php echo $randomno1 ?>" >
			            <input type="hidden" name="random2" value="<?php echo $randomno2 ?>" >
                    </div>
                </div>
                <div class="btn-group">
                    <button type="reset" >Clear</button>
                    <button type="submit" name="btnSave">Save</button>
                    
                </div>

            </form>
        </div>
    </body>
</html>

