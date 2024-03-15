<?php
 
    require_once 'conn.php';
     
    // mysqli_connect("servername","username","password","database_name")
  
    // Get all the categories from category table
    $sql = "SELECT * FROM `category`";
    $all_categories = mysqli_query($con,$sql);
    $sql1 = "SELECT * FROM `type`";
    $all_types = mysqli_query($con,$sql1);
  
    // The following code checks if the submit button is clicked 
    // and inserts the data in the database accordingly
    if(isset($_POST['submit']))
    {
     if(isset($_POST['q1'])){
      
        // Store the Product name in a "name" variable
        $name = mysqli_real_escape_string($con,$_POST['Product_name']);
         // Store the Product fam in a "fam" variable
       $fam = mysqli_real_escape_string($con,$_POST['Product_fam']);
        // Store the Category ID in a "id" variable
        $id = mysqli_real_escape_string($con,$_POST['Category']); 
        
        $id1 = mysqli_real_escape_string($con,$_POST['Type']); 
        $q1=$_POST['q1'];
        // Creating an insert query using SQL syntax and
        // storing it in a variable.
        $sql_insert = 
        "INSERT INTO `product`(`product_name`,`product_fam`,`living`, `category_id`,`type_id`)
            VALUES ('$name','$fam','$q1','$id','$id1')";
          
          // The following code attempts to execute the SQL query
          // if the query executes with no errors 
          // a javascript alert message is displayed
          // which says the data is inserted successfully
          if(mysqli_query($con,$sql_insert))
        {
            echo '<script>alert("Data added successfully")</script>';
        }
     }
    }
?>
