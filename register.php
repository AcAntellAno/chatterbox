<?php
    $connection = mysqli_connect("localhost", "root", "", "chatterbox");

    if(mysqli_connect_errno()){
        echo "Failed to connect: " . mysqli_connect_errno();
    }

   //variables for the registration form
    $fname = ""; 
    $lname = "";
    $email = "";
    $confirm_email = "";
    $password = "";
    $confirm_password= "";
    $date = ""; //data user signs up
    $error_array = ""; //holds error message if passwords dont match, or emails

    if(isset($_POST['reg_button'])){
        //handle registration form data
        $fname = cleanData('reg_fname');
        $lname = cleanData('reg_lname');
        $email = cleanData('reg_email');
        $confirm_email = cleanData('reg_confirm_email');
        $password = strip_tags($_POST['reg_password']);
        $confirm_password = strip_tags($_POST['reg_confirm_password']);
        $date = date("Y-m-d"); //gets current date
    }
    //check if emails match up
        if($email == $confirm_email){
            //check for email valid format
            if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                //if valid, set email equal to the offically validated email
                $email = filter_var($email, FILTER_VALIDATE_EMAIL);

                //check if email exists in our db
                $email_check = mysqli_query($connection, "SELECT email FROM users WHERE email='$email'");

                //count number of rows returned
                $num_rows = mysqli_num_rows($email_check);

                if($num_rows > 0) {
                    echo "An account is already registered with that email.";
                }

            } else{
                echo "Invalid format";
            }
       } else{
           echo "Emails do not match";
       }
  


    function cleanData($data){
        //clean up data
        //prevent cross site scripting
        $data = strip_tags($_POST[$data]); //strip tags => cleans data (html data)
        $data = str_replace(' ', '', $data); //=> gets rid of spaces
        $data = ucfirst(strtolower($data)); //convert letters to lowercase, and capatlize first 
        return $data;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Welcome to ChatterBox</title>
</head>
<body>
 <form action="register.php" method="POST">
    <input type="text" name="reg_fname" placeholder="First Name" required>
    <br>
    <input type="text" name="reg_lname" placeholder="Last Name" required>
    <br>
    <input type="email" name="reg_email" placeholder="Email" required>
    <br>
    <input type="email" name="reg_confirm_email" placeholder="Confirm Email" required>
    <br>
    <input type="password" name="reg_password" placeholder="Password" required>
    <br>
    <input type="password" name="reg_confirm_password" placeholder="Confirm Password" required>
    <br>
    <input type="submit" name="reg_button" value="Sign Me Up" required>
    <br>
 </form>   
</body>
</html>