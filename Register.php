<?php


$conn = new mysqli("sql300.infinityfree.com", "if0_43331032", "3feD82tq6vk", "if0_43331032_dormitory_db");

// ------------------Check connection------------
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Unable to connect to the database.");
}

//---------------------data base connection above



if(isset($_POST['create'])){
    

    $username =  $_POST['username'];



    $result = mysqli_query($conn, "SELECT * From users Where username = '$username'");
    $user = mysqli_fetch_assoc($result);

    if(!$user){

        $username =  $_POST['username'];
        $firstname = $_POST['firstname'];
        $lastname =  $_POST['lastname'];
        $middlename =  $_POST['middlename'];
        $contact =  $_POST['contact'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $pass = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $status = 'Active';
        $registration_date = date("Y-m-d H:i:s");
        $attempt = 0;
        $activation = 'pending';


        mysqli_query($conn, "INSERT INTO users(username, firstname, lastname, middlename, contact, gender, email, password, status, registration_date, attempt, activation ) VALUES ('$username', '$firstname', '$lastname','$middlename','$contact', '$gender', '$email', '$pass','$status', '$registration_date', '$attempt', '$activation')");

            header("Location: start.html");

    }else{
        $warning = "Input Username is already in use!!";
    }

    


}




?>


<!DOCTYPE html>
<html>
<head>
    <title>Dream Dormitory Login</title>
    <link rel="icon" type="image/png" href="logo.png">
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-image: url('leaves.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .infoBox{
            width: 400px;
            height: 450px;
            padding: 30px;
            
            margin-left: 50%;
            margin-top: 1%;
            
            
            
            background: linear-gradient(-45deg, Blue, violet, cyan, purple);
            color: black;
            border-radius: 10px;
        }

        .Register_box {
            width: 350px;
            padding: 30px;
            position: absolute;
            top: 50%;
            left: 30%;
            transform: translate(-50%, -50%);
            background: rgba(0,0,0,0.7);
            color: white;
            border-radius: 10px;
        }

        .Register_box h2 {
            text-align: center;
        }

        .Register_box input {
            width: 100%;
            padding: 5px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .Register_box button {
            width: 100%;
            padding: 10px;
            background: #00aaff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

 <div class="Register_box">
     <h2>Register</h2> 

     <?php if (isset($warning)) { ?>
        <p class="error"><?= $warning ?></p>
     <?php } ?> 

    <form method = "post">

    <input type = "text" placeholder = "First name" name = "firstname" required><br>
    <input type = "text" placeholder = "Last name" name = "lastname" required><br>
    <input type = "text" placeholder = "Middle name" name = "middlename" ><br>
    <input type = "text" placeholder = "Contact" name = "contact" required><br>
    

    <select name="gender" required style="width: 103%; height: 30px;border-radius:5px ; margin-top: 10px;margin-bottom: 10px;">
                                <option value="">Sex</option>
                                <option value="Male" >Male</option>
                                <option value="Female" >Female</option>
                            </select><br>
    <input type = "text" placeholder = "Email address" name = "email" required><br>
    <input type = "text" placeholder = "Username" name = "username" required><br>
    <input type = "password" placeholder = "Password" name = "password" required><br>
    <button name="create">Create data</button><br><hr>
    <button type="button" onclick="window.location.href='start.html'">Back</button>

    
    




    </form>

</div> 


<div>

    <div class="infoBox">
        <h1>Note:</h1>


        <p>Once your account has been created you will be redirected automatically to the login page.</p>
        <p>• If an Indication that user is already in use means that there is already an existing account with the same input try using a different user input.</p>
        <p>• If an Indication that your account is Pending for Approval means that the Dormitory Administrator has not yet Approved of your Registration you can try logging in with your account after 8 hours or so or once your registraton had been approved or you can try asking for approval of the dormitory management onsite.</p>
        

    </div>
    

    
</div>





</body>
</html>