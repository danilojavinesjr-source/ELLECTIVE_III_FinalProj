<?php
session_start();

// Database connection
$conn = new mysqli("sql300.infinityfree.com", "if0_43331032", "3feD82tq6vk", "if0_43331032_dormitory_db");

// ------------------Check connection------------
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Unable to connect to the database.");
}
//-------------------login-----------

if (isset($_POST['back'])) {
    // code...
    header("Location: start.html");

}



if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];



    // ---------------------- log in------------
    $result = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
    $user = mysqli_fetch_assoc($result);





    if($user && $user['status'] == 'Deactivated'){



        $warning =  "Account had been Deactivated due to Mutiple invalid log in.";

    }elseif($user && $user['status'] == 'Archive'){



        $warning =  "Your contract is no longer valid, Ask our dormitory desk for assistance.";

    }elseif($user && password_verify($password, $user['password'])) {

            

            if($user['activation'] == "pending") {

                $warning = "Account is still pending for admin approval.";

            }else{
                mysqli_query($conn, "UPDATE users SET attempt = 0 Where username = '$username'");
                $_SESSION['username'] = $user['username'];
                header("Location: user_dashboard.php");
            }
        }

        
    elseif ($user) {
        // ------------------------------------check attempt failure...........

        if(!password_verify($password, $user['password'])){

            
            $attemp_result = mysqli_query($conn,"SELECT * From users WHERE username = '$username' " );
            $attemp = mysqli_fetch_assoc($attemp_result);
            
            if($attemp['attempt'] >= 3){
                mysqli_query($conn, "UPDATE users SET status = 'Deactivated' Where username = '$username'");

            }elseif($attemp['attempt'] < 3){
                mysqli_query($conn, "UPDATE users SET attempt = attempt + 1 Where username = '$username'");
            }
            $attemp_warning_query = mysqli_query($conn,"SELECT * From users WHERE username = '$username' " );
            $attemp_query_w = mysqli_fetch_assoc($attemp_warning_query);
            $warning = "Remaining attempt ".$attemp_query_w['attempt']."/3";
        }
    }else {
        $warning = "Invalid username or password!";
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
            margin: 0;
            padding: 0;
            font-family: Arial;
            background: url('leaves.jpg') no-repeat center center fixed;
            background-size: cover;
        }

        .login-box {
            width: 300px;
            padding: 30px;
            position: absolute;
            top: 50%;
            left: 40%;
            transform: translate(-50%, -50%);
            background: url('cover.jpg') no-repeat center center fixed;
            background-size: cover;
            color: white;
            border-radius: 10px;
        }

        .login-box h2 {
            text-align: center;
        }

        .login-box input {
            width: 94%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 5px;
        }

        .login-box button {
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
            background: cyan;
            border-radius: 10px;
        }

        .design {
            width: 450px;
            height: 450px;
            padding: 30px;
            
            margin-left: 57%;
            margin-top: 8%;
            
            
            
            background: url('dormitory.jpg') ;
            background-size: cover;
            color: black;
            border-radius: 10px;
        }
    </style>
</head>
<body>

<div class="login-box">
    <h2>User Login</h2>

    <?php if (isset($warning)) echo "<p class='error'>$warning</p>"; ?>

    <form method="POST">
        <input type="text" name="username" placeholder="Username" >
        <input type="password" name="password" placeholder="Password" >
        <button type="submit" name="login">Login</button><hr>
        <button type="submit" name="back">Back</button>
    </form>
</div>

<div>

    <div class="design">
    


    </div>
    

</div>

</body>
</html>