<?php
session_start();
$conn = new mysqli("sql300.infinityfree.com", "if0_43331032", "3feD82tq6vk", "if0_43331032_dormitory_db");

// ------------------Check connection------------
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Unable to connect to the database.");
}

//---------------------data base connection above


$water_amount = 0;
$electric_amount = 0;




if (isset($_POST['calculate_water'])){

    // water computation variable

    $previous_water = $_POST['water_amount_previous'];
    $present_water = $_POST['water_amount_present'];

    
    $water_price = 52.5;
    $maintenance_fee = 58;
    $water_consumption = $present_water - $previous_water;
    $waterbill = $water_consumption * $water_price;
    $taxless_bill = $waterbill + $maintenance_fee;
    $franchise_tax = $taxless_bill * 0.02;
    $total_bill = $taxless_bill + $franchise_tax;

    $water_amount = $total_bill;



}

if (isset($_POST['calculate_electric'])){



    // electric computation variables
    $previous_electric = $_POST['electric_amount_previous'];
    $present_electric = $_POST['electric_amount_present'];

    $electric_consumption = $present_electric - $previous_electric;
    $Power_rate = 7.2657;
    $electric_bill = $electric_consumption * $Power_rate;
    $vat = $electric_bill * 0.12;
    $total_electric_bill = $electric_bill + $vat;
    $electric_amount = $total_electric_bill;



}



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dream Dormitory Dashboard</title>
    <link rel="icon" type="image/png" href="logo.png">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            margin: 0;
            font-family: Arial;
            display: flex;
            background-image: url('leaves.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
        
        .sidebar {
            width: 220px;
            background: darkblue;
            color: white;
            height: 100vh;
            padding: 10px;
        }
        
        .sidebar h2 {
            text-align: center;
        }
        
        .menu-item {
            padding: 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        
        .menu-item:hover {
            background: #57606f;
        }
        
        .active {
            background: silver;
            border-radius: 5px;
            padding: 6px;
            opacity: 80%;
            

        }

        h1,p {
            padding-left: 20px;
        }

        

        .content {
            flex: 1;
            padding: 20px;
        }
        
        .section {
            display: none;
        }
        
        .section.active {
            display: block;
        }

        .status-active {
            background: green;
            color: black;
            padding: 15px;
            border-radius: 5px;
        }
        
        .status-inactive {
            background: orange;
            color: black;
            padding: 5px;
            border-radius: 5px;
            text-align: center;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        
        th,
        td {
            border: 1px solid #ccc;
            padding: 3px;
            text-align: center;
        }
        
        th {
            background: #f1f2f6;
        }
        table, th, td {
            border: 1px solid black;
        }
        p5 {
            border: 1px solid black;
            padding: 5px;
            border-radius: 5px;


        }


        p1 {
            
            padding-left: 43%;
            font-size: 12px;
            padding-top: -10px;

        }
        .center-text {
            display: block;
            text-align: center;
            margin-top: 15px;
        }

        .dash_row2 {

            background: white;
            opacity: 100%;
        }
        h2 {
            text-align: center;
        }
        h4 {
            
            text-align: center;
        }
        input{
            width: 100%;
            padding: 2px;
            margin: 5px 0;
        }
        button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        button:hover {
            cursor: pointer;
        }

        .logo-container {
            margin-top: 45vh; 
        }
        .main-logo {
            width: 220px; 
            height: auto;
            display: block;
            filter: drop-shadow(0 0 10px rgba(0, 255, 255, 0.3)); 
            
            border-radius: 30%;
        }
                
    </style>
</head>

<body>

    <div class="sidebar">
        <h2><?php echo $_SESSION['username'];  ?></h2>
        <p1>User</p1><hr>
        <div class="menu-item active" onclick="showSection('Utility')">Utility Bills</div>
        <div class="menu-item" onclick="showSection('roomates')">Roomates</div>
        <!-- <div class="menu-item" onclick="showSection('rooms')">Rooms</div> -->
        <div class="menu-item" onclick="showSection('reports')">Reports</div>
        <div class="menu-item" onclick="window.location.href='logout.php'">Logout</div>
        <div class="logo-container">
            <img src="logo.png" alt="Dream Dormitory Logo" class="main-logo">
        </div>
    </div>


    <!-----------display sa left side  -->

    <div class="content">


        <!---------------------admin dashboard  -->

        <div id="Utility" class="section active">
            <h1>Utility Bills</h1>
            <p>Welcome to Dream Dormitory System</p>
            <p>Note: The Utilities Bill Amount Changes every month, </p>
            <p>The Amount bellow is the entire bill of your Room designation.</p><hr>




            <div style="display: flex; justify-content: center; align-items: center; height: 50vh;gap: 50px;">


                <!------------- Water Bill Form-------------------->
                <div style="background: white; padding: 20px; width: 250px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2);text-align: center;">
                    <h4>Water Bill</h4><br>

                    <!--------- Utility bill query--------- -->

                    <?php
                    $username = $_SESSION['username'];

                    $user_Bill = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
                    $user_bill_fetch = mysqli_fetch_assoc($user_Bill);
                    $water_bill_prev = $user_bill_fetch['prev_water'];
                    $water_bill_press = $user_bill_fetch['press_water'];
                    $water_bill_amount = $user_bill_fetch['water_bill'];
                    $electricity_bill_amount = $user_bill_fetch['electricity_bill'];
                    $electricity_bill_prev = $user_bill_fetch['prev_electricity'];
                    $electricity_bill_press = $user_bill_fetch['press_electricity'];



                    ?>

                    <form method="POST">
                        <p5> Previous Reading: <?php echo $water_bill_prev ." " ?>CUM </p5><br><br>
                        <p5> Present Reading: <?php echo $water_bill_press ." " ?>CUM </p5><br><br><hr>
                        
                        
                        <p4 class="center-text">Amount: <?php echo $water_bill_amount  ?> </p4>
                    </form>
                </div>

                <!-- --------Electricity Bill Form ------------------>
                <div style="background: white; padding: 20px; width: 250px; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.2); text-align: center;">
                    <h4>Electricity Bill</h4><br>
                    <form method="POST">
                        <p5> Previous Reading: <?php echo $electricity_bill_prev ." " ?>KWH </p5><br><br>
                        <p5> Present Reading: <?php echo $electricity_bill_press ." " ?>KWH </p5><br><br><hr>
                        
                        <p4 class="center-text">Amount: <?php echo $electricity_bill_amount  ?> </p4>

                    </form>
                </div>
            </div>

            
            </div>





        <!---------------------Roomates section  -->

        <div id="roomates" class="section">
            <h1>Roomates</h1>
            <?php

            $username = $_SESSION['username'];
            // --------------Fetch users room number
            $room_number = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username'");
            $room_fetch = mysqli_fetch_assoc($room_number);
            $room = $room_fetch['room_id'];

            $usercount = "SELECT COUNT(*) AS total_users FROM users WHERE room_id = '$room'";
            $num = mysqli_query($conn, $usercount);

            $row = mysqli_fetch_assoc($num);


            // --------------tenants that exist ---------------

            ?>

            <p>Existing roommates: <?php echo $row['total_users']; ?></p><hr>



            <p></p>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>Email</th>

                    
                </tr>

                <?php

                $result = mysqli_query($conn,"SELECT * FROM users WHERE room_id = '$room'");

                while ($row = $result->fetch_assoc()) {
                ?>


                <tr>
                    <td><?= $row['firstname']." ".$row['middlename']. " ".$row['lastname'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= '0' .$row['contact'] ?></td>
                    <td><?= $row['room_id'] ?></td>
                    <td>
                        <?php if ($row['status'] == "Active") { ?>
                        <p class="status-active">Active</p>
                        <?php } else { ?>
                        <span class="status-inactive">Deactivated</span>
                        <?php } ?>
                    </td>
                    <td><?= $row['email'] ?></td>
                    
                </tr>
                <?php } ?>
                
            </table>
        </div>




        


        <!---------------------Reports of tenantss payments,  -->

        <div id="reports" class="section">
            <h1>Reports</h1>
            <p>Rent payments history</p><hr>

            <?php
            $username = $_SESSION['username'];

            $records = mysqli_query($conn, "
                SELECT tenants_record.*, users.firstname 
                FROM tenants_record 
                JOIN users ON tenants_record.tenant_id = users.user_id
                WHERE users.username = '$username'
                ORDER BY tenants_record.month ASC
            ");
            ?>


            
            <table>

                <tr>
                    <th>Name</th>
                    <th>Month</th>
                    <th>Year</th>
                    <th>Amount</th>
                    <th>Status</th>
                </tr>

                <?php
                if (mysqli_num_rows($records) > 0) {
                    while ($row = mysqli_fetch_assoc($records)) {

                        ?>
                            

                            <tr>
                                <td><?=$row['firstname']?></td>
                                <td><?=$row['month']?></td>
                                <td><?=$row['year']?></td>
                                <td><?=$row['amount']?></td>
                                <td><?=$row['status']?></td>
                            </tr>
                    <?php
                    } ?>
                <?php
                } 
                  
                ?>

            </table>



        </div>






    </div>


    <!-------  switching display function   -->

    <script>
        
        // ---------function to switch between menu------------
        function showSection(sectionId, element) {
            document.querySelectorAll('.section').forEach(sec => {
                sec.classList.remove('active');
            });

            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });

            document.getElementById(sectionId).classList.add('active');
            element.classList.add('active');

            
        }
    </script>

</body>

</html>