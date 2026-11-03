

<?php
session_start();
$conn = new mysqli("sql300.infinityfree.com", "if0_43331032", "3feD82tq6vk", "if0_43331032_dormitory_db");

// ------------------Check connection------------
if (!$conn) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Unable to connect to the database.");
}
//---------------------data base connection above



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

            
            background: linear-gradient(-45deg, Blue, violet, cyan, purple);
            background-size: 400% 400%;
            animation: gradientMove 10s ease infinite;
        }


        
        .sidebar {
            width: 220px;
            background: #2f3542;
            color: white;
            height: 200vh;
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
            background: oklab(67.314% 0.07137 -0.09133);
            border-radius: 5px;
            padding: 6px;
            opacity: 80%;

        }

        h1,p {
            padding-left: 20px;
        }

        p1 {
            padding-left: 3%;
        }
        p3 {
            padding-left: 37%;
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
            background: linear-gradient(to right, #a6a634 12%, #848418 50%, #75750c 100%);
            color: black;
            padding: 15px;
            border-radius: 5px;
        }
        
        .status-inactive {
            background: linear-gradient(to right, #f4770a 12%, #da8235 50%, #e69a57 100%);
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
            padding: 12px;
            text-align: center;

        }
        
        th {
            background: linear-gradient(to right, #cde3f2 12%, cyan 50%, #6ab4e6 100%);
        }
        button:hover {
            cursor: pointer;
        }
        #rooms button {
            background: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            width: 100%;
            padding: 8px;
            margin: 5px 0;
        }
        @keyframes gradientMove {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
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

    <!-----------display sa right side menu bar  ---------------->

    <div class="sidebar">
        <h2>Admin</h2>
        <hr>
        <div class="menu-item active" onclick="showSection('client', this)">Clients</div>
        <div class="menu-item" onclick="showSection('tenants', this)">Tenants</div>
        <div class="menu-item" onclick="showSection('rooms', this)">Rooms</div>
        <div class="menu-item" onclick="showSection('records', this)">Records</div>
        <div class="menu-item" onclick="window.location.href='logout.php'">Logout</div>

        <div class="logo-container">
            <img src="logo_admin.png" alt="Dream Dormitory Logo" class="main-logo">
        </div>
    </div>


    

    <div class="content">


        <!---------------------admin dashboard  --------->


        <!--------- room capacity query --------------->
        <?php


        

            
            // ROOM 1
            $room_1query = "SELECT COUNT(*) AS occupied FROM users WHERE room_id = 'Room 1' AND activation = 'granted' ";
            $room_1 = mysqli_query($conn, $room_1query);
            $row1 = mysqli_fetch_assoc($room_1);
            
            $room1Occupied = $row1['occupied'];
            $room1Capacity = 5;

            // ROOM 2
            $room_2query = "SELECT COUNT(*) AS occupied FROM users WHERE room_id = 'Room 2' AND activation = 'granted' ";
            $room_2 = mysqli_query($conn, $room_2query);
            $row2 = mysqli_fetch_assoc($room_2);
            
            $room2Occupied = $row2['occupied'];
            $room2Capacity = 6;

            // ROOM 3
            $room_3query = "SELECT COUNT(*) AS occupied FROM users WHERE room_id = 'Room 3' AND activation = 'granted'";
            $room_3 = mysqli_query($conn, $room_3query);
            $row3 = mysqli_fetch_assoc($room_3);
            
            $room3Occupied = $row3['occupied'];
            $room3Capacity = 6;



            // ROOM 4
            $room_4query = "SELECT COUNT(*) AS occupied FROM users WHERE room_id = 'Room 4' AND activation = 'granted'";
            $room_4 = mysqli_query($conn, $room_4query);
            $row4 = mysqli_fetch_assoc($room_4);
            
            $room4Occupied = $row4['occupied'];
            $room4Capacity = 6;




            // ROOM 5
            $room_5query = "SELECT COUNT(*) AS occupied FROM users WHERE room_id = 'Room 5' AND activation = 'granted'";
            $room_5 = mysqli_query($conn, $room_5query);
            $row5 = mysqli_fetch_assoc($room_5);
            
            $room5Occupied = $row5['occupied'];
            $room5Capacity = 6;

            // TOTAL
            $totalOccupied = $room1Occupied + $room2Occupied + $room3Occupied + $room4Occupied + $room5Occupied;
            $totalCapacity = $room1Capacity + $room2Capacity + $room3Capacity + $room4Capacity + $room5Capacity;

            $remaining_rooms = $totalCapacity - $totalOccupied;

            $room1_remaining = $room1Capacity - $room1Occupied;
            $room2_remaining = $room2Capacity - $room2Occupied;
            $room3_remaining = $room3Capacity - $room3Occupied;
            $room4_remaining = $room4Capacity - $room4Occupied;
            $room5_remaining = $room5Capacity - $room5Occupied;



            // -------function para sa pag handle ng room alocation ng pending clients

            if (isset($_POST['assign'])) {
                $user_id = $_POST['pendingUser_id'];
                $room_id = $_POST['pendingRoom_id'];
                $month = date("m");
                $year = date("Y");
                $amount = 5000;


                

                // CHECK ROOM CAPACITY



                if ($room_id == 'Room 1'){

                    if ($room1_remaining === 0) {
                    echo "<script>alert('Room is already full!');</script>";
                } else {
                    

                        
                        mysqli_query($conn, "UPDATE users SET activation='granted', room_id = 'Room 1', status = 'Active' WHERE user_id='$user_id'");


                        // ------check if  record exists--------------
                        $check_records = mysqli_query($conn, "SELECT * FROM tenants_record WHERE tenant_id = '$user_id' AND month = '$month' AND year = '$year'");

                        if (mysqli_num_rows($check_records) > 0) {
                            
                            
                        } else {
                            // ----------if no records mag insert--------
                            $insert_query = mysqli_query($conn, "INSERT INTO tenants_record 
                                                                (tenant_id, month, year, amount, status)
                                                                VALUES 
                                                                ('$user_id', '$month', '$year', '$amount', 'unpaid')");
                        }


                        
                        
                    }

                }elseif ($room_id == 'Room 2'){

                    if ($room2_remaining === 0) {
                    echo "<script>alert('Room is already full!');</script>";
                } else {
                    

                        
                        mysqli_query($conn, "UPDATE users SET activation='granted', room_id = 'Room 2', status = 'Active' WHERE user_id='$user_id'");


                        // ------check if  record exists--------------
                        $check_records = mysqli_query($conn, "SELECT * FROM tenants_record WHERE tenant_id = '$user_id' AND month = '$month' AND year = '$year'");

                        if (mysqli_num_rows($check_records) > 0) {
                            
                            
                        } else {
                            // ----------if no records mag insert--------
                            $insert_query = mysqli_query($conn, "INSERT INTO tenants_record 
                                                                (tenant_id, month, year, amount, status)
                                                                VALUES 
                                                                ('$user_id', '$month', '$year', '$amount', 'unpaid')");
                        }


                        
                        
                    }

                }elseif ($room_id == 'Room 3'){

                    if ($room3_remaining === 0) {
                    echo "<script>alert('Room is already full!');</script>";
                } else {
                    

                        
                        mysqli_query($conn, "UPDATE users SET activation='granted', room_id = 'Room 3', status = 'Active' WHERE user_id='$user_id'");


                        // ------check if  record exists--------------
                        $check_records = mysqli_query($conn, "SELECT * FROM tenants_record WHERE tenant_id = '$user_id' AND month = '$month' AND year = '$year'");

                        if (mysqli_num_rows($check_records) > 0) {
                            
                            
                        } else {
                            // ----------if no records mag insert--------
                            $insert_query = mysqli_query($conn, "INSERT INTO tenants_record 
                                                                (tenant_id, month, year, amount, status)
                                                                VALUES 
                                                                ('$user_id', '$month', '$year', '$amount', 'unpaid')");
                        }


                        
                        
                    }

                }elseif ($room_id == 'Room 4'){

                    if ($room4_remaining === 0) {
                    echo "<script>alert('Room is already full!');</script>";
                } else {
                    

                        
                        mysqli_query($conn, "UPDATE users SET activation='granted', room_id = 'Room 4', status = 'Active' WHERE user_id='$user_id'");


                        // ------check if  record exists--------------
                        $check_records = mysqli_query($conn, "SELECT * FROM tenants_record WHERE tenant_id = '$user_id' AND month = '$month' AND year = '$year'");

                        if (mysqli_num_rows($check_records) > 0) {
                            
                            
                        } else {
                            // ----------if no records mag insert--------
                            $insert_query = mysqli_query($conn, "INSERT INTO tenants_record 
                                                                (tenant_id, month, year, amount, status)
                                                                VALUES 
                                                                ('$user_id', '$month', '$year', '$amount', 'unpaid')");
                        }


                        
                        
                    }

                }elseif ($room_id == 'Room 5'){

                    if ($room5_remaining === 0) {
                    echo "<script>alert('Room is already full!');</script>";
                } else {
                    

                        
                        mysqli_query($conn, "UPDATE users SET activation='granted', room_id = 'Room 5', status = 'Active' WHERE user_id='$user_id'");


                        // ------check if  record exists--------------
                        $check_records = mysqli_query($conn, "SELECT * FROM tenants_record WHERE tenant_id = '$user_id' AND month = '$month' AND year = '$year'");

                        if (mysqli_num_rows($check_records) > 0) {
                            
                            
                        } else {
                            // ----------if no records mag insert--------
                            $insert_query = mysqli_query($conn, "INSERT INTO tenants_record 
                                                                (tenant_id, month, year, amount, status)
                                                                VALUES 
                                                                ('$user_id', '$month', '$year', '$amount', 'unpaid')");
                        }


                        
                        
                    }

                }
                

                
            }


        ?>


    
            <!-- -----first section client approval section-------- -->

        <div id="client" class="section active">
            <h1>Welcome to Dream Dormitory System</h1>
            


            
        <p> <?php echo "Total Available rooms: " . $remaining_rooms ?> <p/>






            <p>Pending Client Approvals</p><hr>
            <button  type="button" onclick="location.reload()" style="margin-left: 20px; padding: 5px; border-radius: 5px; background: hsl(224, 64%, 39%);">Reload</button> 
            <p1>Note: Press Reload to see latest clients.</p1>

            <table>
                <tr>
                    
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Assign Room</th>
                    

                </tr>

                <!----------   query -- letter Ascending ------------>

                <?php

                // -----------Fetch users that are pending for approval
                $pending_users = mysqli_query($conn, "SELECT * FROM users WHERE activation='pending'");

                while($row = mysqli_fetch_assoc($pending_users)) {



                ?>


                <tr>
                    
                    <td><?php echo $row['firstname']." ".$row['middlename']. " ".$row['lastname']; ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= '0' .$row['contact'] ?></td>
                    <td>
                        <form method="POST">
                            <input type="hidden" name="pendingUser_id" value="<?php echo $row['user_id']; ?>">
                            <!-- Room selection -->
                            <select name="pendingRoom_id" required>
                                <option value="">Select Room</option>
                                <option value="Room 1" >Room 1</option>
                                <option value="Room 2" >Room 2</option>
                                <option value="Room 3" >Room 3</option>
                                <option value="Room 4" >Room 4</option>
                                <option value="Room 5" >Room 5</option>

                                
                            </select>

                            <button type="submit" name="assign">Assign</button>
                        </form>
                    </td>
                <?php }?>
                </tr>
                
            </table>











        </div>

        <!---------------------Tenantss   that existt  -->

        <div id="tenants" class="section">
            <h1>Tenants</h1>
            <?php

            // --------query filter for tenants that has been cleared/granted

            $usercount = "SELECT COUNT(*) AS total_users FROM users WHERE activation = 'granted'";
            $num = mysqli_query($conn, $usercount);

            // -----------display total registered tenants----------
            if ($row = mysqli_fetch_assoc($num)) {
                echo "<p>Total Registered Tenants: " . $row['total_users'] . "</p><hr>";
            }


            // ----------function to mark tenants as acrhive and vacant their room
            if (isset($_POST['activebutton'])) {
                // code...
                $Userid = $_POST['User_id'];

                mysqli_query($conn, "UPDATE users SET status='Archive', room_id = '' WHERE user_id='$Userid'");

                //--------- delete functionn---------

            }
            if (isset($_POST['Delete'])) {
                // code...
                $Userid = $_POST['User_id'];

                mysqli_query($conn, "DELETE FROM users WHERE user_id='$Userid'");
                mysqli_query($conn, "DELETE FROM tenants_record WHERE tenant_id='$Userid'");




            }
            //---------------- unarchived function return to pending 
            if (isset($_POST['Unarchived'])) {
                // code...
                $Userid = $_POST['User_id'];

                mysqli_query($conn, "UPDATE users SET activation='pending', room_id = '0',water_bill = '0', electricity_bill = '0', press_water = '0', prev_water = '0', press_electricity = '0', prev_electricity = '0' WHERE user_id='$Userid'");


            }



            

            ?>
            <!---------------Table display for tenants------------------- -->
            
            <table>
                <tr>
                    
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Contact</th>
                    <th>Room</th>
                    <th>Status</th>
                    <th>Email</th>

                    <th>Date of registration</th>
                </tr>

                <!---------- Mysqli display query -> letter Ascending ------------>

                <?php
                $result = $conn->query("SELECT * FROM users Where activation = 'granted' ORDER by firstname ASC");

                while ($row = $result->fetch_assoc()) {
                ?>


                <tr>
                    
                    <td><?= $row['firstname']." ".$row['middlename']. " ".$row['lastname'] ?></td>
                    <td><?= $row['gender'] ?></td>
                    <td><?= '0' .$row['contact'] ?></td>
                    <td><?= $row['room_id'] ?></td>
                    <td>
                        <?php if ($row['status'] == "Active") { ?>
                        <form method="POST">
                            <input type="hidden" name="User_id" value="<?= $row['user_id'] ?>">
                            <button class="status-active" type="submit" name="activebutton"  >Active</button>
                        </form>
                        
                        <?php } elseif($row['status'] == "Archive"){

                        ?>
                        <form method="POST">
                            <input type="hidden" name="User_id" value="<?= $row['user_id'] ?>">
                            <button class="status-inactive" 
                            type="submit" name="Unarchived" onclick="return confirm('Are you sure you want to Unarchived this user? This user will return to the client pending stage.')">Archived</button>
                            <button style="background: linear-gradient(to right, red 12%, #ea441a 50%, #eb7152 100%); color: black; padding: 5px; border-radius: 5px; text-align: center;"
                            type="submit" name="Delete" onclick="return confirm('Are you sure you want to delete this user? All payments history from this user will also be deleted.')">Delete</button>
                        </form>
                        <?php

                        } else{ ?>
                        <span class="status-inactive">Deactivated</span>
                        <?php } ?>
                    </td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['registration_date'] ?></td>
                </tr>
                <?php } ?>
                
            </table>
        </div>





        <!------------------Rooms section  -------------->


        

        <div id="rooms" class="section">
            <h1>Rooms</h1><hr>
             

            <!-- room capacity query ABOVE ------------------------>



            <!----------- rooms display section ------------------->


            <div style="display: flex; gap: 40px; flex-wrap: wrap; padding-left:20px; margin-top: 40px;">

                <div style="width: 150px; text-align: center;">
                    <canvas id="room1Chart"></canvas>
                    <p1>Room 1</p1>
                </div>

                <div style="width: 150px; text-align: center;">
                    <canvas id="room2Chart"></canvas>
                    <p1>Room 2</p1>
                </div>

                <div style="width: 150px; text-align: center;">
                    <canvas id="room3Chart"></canvas>
                    <p1>Room 3</p1>
                </div>

                <div style="width: 150px; text-align: center;">
                    <canvas id="room4Chart"></canvas>
                    <p1>Room 4</p1>
                </div>

                <div style="width: 150px; text-align: center;">
                    <canvas id="room5Chart"></canvas>
                    <p1>Room 5</p1>
                </div>

                <div style="width: 150px; text-align: center;">
                    <canvas id="dormChart"></canvas>
                    <p1>Total Dormitory</p1>
                </div>

            </div>


            <!------------------Occupants Diplay  ---------------->

            <div>
                
                <h2 style="padding-left: 30px; margin-top: 40px;">Occupants</h2><hr>

            </div>

<?php

// ---------query for occupants table------

    $room1_query = mysqli_query($conn, "SELECT * from users Where room_id = 'Room 1' AND activation = 'granted' ORDER by username ASC ");  
    $room2_query = mysqli_query($conn, "SELECT * from users Where room_id = 'Room 2' AND activation = 'granted' ORDER by username ASC ");
    $room3_query = mysqli_query($conn, "SELECT * from users Where room_id = 'Room 3' AND activation = 'granted' ORDER by username ASC ");
    $room4_query = mysqli_query($conn, "SELECT * from users Where room_id = 'Room 4' AND activation = 'granted' ORDER by username ASC ");  
    $room5_query = mysqli_query($conn, "SELECT * from users Where room_id = 'Room 5' AND activation = 'granted' ORDER by username ASC ");    

?>
            
            <!------------- Occupants Table ------------------- -->

            <div style="display: flex; gap: 70px; flex-wrap: wrap; padding-left:35px; margin-top: 40px;">
                <div>
                    <table style="width: 120px"> 

                        <tr>

                            <th>Room 1</th>
                        
                        </tr>

                        <?php  

                        while($result_room1 = mysqli_fetch_assoc($room1_query)){
                            ?>

                            <tr>
                                
                                <td><?php echo $result_room1['username']; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </table>
                </div>

                <div>

                    <table style="width: 120px"> 

                        <tr>

                            <th>Room 2</th>
                        
                        </tr>

                        <?php  

                        while($result_room2 = mysqli_fetch_assoc($room2_query)){
                            ?>

                            <tr>
                                
                                <td><?php echo $result_room2['username']; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </table>
                </div>


                <div>

                    <table style="width: 120px"> 

                        <tr>

                            <th>Room 3</th>
                        
                        </tr>

                        <?php  

                        while($result_room3 = mysqli_fetch_assoc($room3_query)){
                            ?>

                            <tr>
                                
                                <td><?php echo $result_room3['username']; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </table>
                </div>


                <div>

                    <table style="width: 120px"> 

                        <tr>

                            <th>Room 4</th>
                        
                        </tr>

                        <?php  

                        while($result_room4 = mysqli_fetch_assoc($room4_query)){
                            ?>

                            <tr>
                                
                                <td><?php echo $result_room4['username']; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </table>
                </div> 



                <div>

                    <table style="width: 120px"> 

                        <tr>

                            <th>Room 5</th>
                        
                        </tr>

                        <?php  

                        while($result_room5 = mysqli_fetch_assoc($room5_query)){
                            ?>

                            <tr>
                                
                                <td><?php echo $result_room5['username']; ?></td>

                            </tr>

                        <?php
                        }
                        ?>
                    </table>
                </div>

        

            </div>



            <!-----------BILLINGs of rooms  ----------- -->

            <div>
                
                <h2 style="padding-left: 30px; margin-top: 40px;">Utility Billings</h2><hr>

            </div>


            <?php


            $water_amount_room1 = 0;
            $electric_amount_room1 = 0;

            $water_amount_room2 = 0;
            $electric_amount_room2 = 0;

            $water_amount_room3 = 0;
            $electric_amount_room3 = 0;

            $water_amount_room4 = 0;
            $electric_amount_room4 = 0;

            $water_amount_room5 = 0;
            $electric_amount_room5 = 0;

            $water_price = 52.5;
            $maintenance_fee = 58;
            $Power_rate = 7.2657;






            if (isset($_POST['calculate_water_1'])){

                // water computation variable

                $previous_water = $_POST['water_amount_previous_1'];
                $present_water = $_POST['water_amount_present_1'];
               
                
                $water_consumption = $present_water - $previous_water;
                $waterbill = $water_consumption * $water_price;
                $taxless_bill = $waterbill + $maintenance_fee;
                $franchise_tax = $taxless_bill * 0.02;
                $total_bill = $taxless_bill + $franchise_tax;

                $water_amount_room1 = $total_bill;
                

                $Room_id = $_POST['Room_id_bill_1'];

                mysqli_query($conn, "UPDATE users SET prev_water = $previous_water, press_water = $present_water, water_bill = $water_amount_room1 WHERE room_id='$Room_id'");



            }

            if (isset($_POST['calculate_electric_1'])){



                // electric computation variables
                $previous_electric = $_POST['electric_amount_previous_1'];
                $present_electric = $_POST['electric_amount_present_1'];

                $electric_consumption = $present_electric - $previous_electric;
                $electric_bill = $electric_consumption * $Power_rate;
                $vat = $electric_bill * 0.12;
                $total_electric_bill = $electric_bill + $vat;
                $electric_amount_room1 = $total_electric_bill;

                $Room_id = $_POST['Room_id_bill_1'];

                mysqli_query($conn, "UPDATE users SET prev_electricity = $previous_electric, press_electricity = $present_electric, electricity_bill = $electric_amount_room1 WHERE room_id='$Room_id'");




            }

            if (isset($_POST['calculate_water_2'])){

                // water computation variable

                $previous_water = $_POST['water_amount_previous_2'];
                $present_water = $_POST['water_amount_present_2'];

                
                
                $water_consumption = $present_water - $previous_water;
                $waterbill = $water_consumption * $water_price;
                $taxless_bill = $waterbill + $maintenance_fee;
                $franchise_tax = $taxless_bill * 0.02;
                $total_bill = $taxless_bill + $franchise_tax;

                $water_amount_room2 = $total_bill;

                $Room_id = $_POST['Room_id_bill_2'];

                mysqli_query($conn, "UPDATE users SET prev_water = $previous_water, press_water = $present_water, water_bill = $water_amount_room2 WHERE room_id='$Room_id'");



            }

            if (isset($_POST['calculate_electric_2'])){



                // electric computation variables
                $previous_electric = $_POST['electric_amount_previous_2'];
                $present_electric = $_POST['electric_amount_present_2'];

                $electric_consumption = $present_electric - $previous_electric;
                $electric_bill = $electric_consumption * $Power_rate;
                $vat = $electric_bill * 0.12;
                $total_electric_bill = $electric_bill + $vat;
                $electric_amount_room2 = $total_electric_bill;
                $Room_id = $_POST['Room_id_bill_2'];

                mysqli_query($conn, "UPDATE users SET prev_electricity = $previous_electric, press_electricity = $present_electric, electricity_bill = $electric_amount_room2 WHERE room_id='$Room_id'");



            }


            if (isset($_POST['calculate_water_3'])){

                // water computation variable

                $previous_water = $_POST['water_amount_previous_3'];
                $present_water = $_POST['water_amount_present_3'];

                $water_consumption = $present_water - $previous_water;
                $waterbill = $water_consumption * $water_price;
                $taxless_bill = $waterbill + $maintenance_fee;
                $franchise_tax = $taxless_bill * 0.02;
                $total_bill = $taxless_bill + $franchise_tax;

                $water_amount_room3 = $total_bill;

                $Room_id = $_POST['Room_id_bill_3'];

                mysqli_query($conn, "UPDATE users SET prev_water = $previous_water, press_water = $present_water, water_bill = $water_amount_room3 WHERE room_id='$Room_id'");



            }

            if (isset($_POST['calculate_electric_3'])){



                // electric computation variables
                $previous_electric = $_POST['electric_amount_previous_3'];
                $present_electric = $_POST['electric_amount_present_3'];

                $electric_consumption = $present_electric - $previous_electric;
                $electric_bill = $electric_consumption * $Power_rate;
                $vat = $electric_bill * 0.12;
                $total_electric_bill = $electric_bill + $vat;
                $electric_amount_room3 = $total_electric_bill;
                $Room_id = $_POST['Room_id_bill_3'];

                mysqli_query($conn, "UPDATE users SET prev_electricity = $previous_electric, press_electricity = $present_electric, electricity_bill = $electric_amount_room3 WHERE room_id='$Room_id'");



            }


            if (isset($_POST['calculate_water_4'])){

                // water computation variable

                $previous_water = $_POST['water_amount_previous_4'];
                $present_water = $_POST['water_amount_present_4'];

                $water_consumption = $present_water - $previous_water;
                $waterbill = $water_consumption * $water_price;
                $taxless_bill = $waterbill + $maintenance_fee;
                $franchise_tax = $taxless_bill * 0.02;
                $total_bill = $taxless_bill + $franchise_tax;

                $water_amount_room4 = $total_bill;
                $Room_id = $_POST['Room_id_bill_4'];

                mysqli_query($conn, "UPDATE users SET prev_water = $previous_water, press_water = $present_water, water_bill = $water_amount_room4 WHERE room_id='$Room_id'");



            }

            if (isset($_POST['calculate_electric_4'])){



                // electric computation variables
                $previous_electric = $_POST['electric_amount_previous_4'];
                $present_electric = $_POST['electric_amount_present_4'];

                $electric_consumption = $present_electric - $previous_electric;
                $electric_bill = $electric_consumption * $Power_rate;
                $vat = $electric_bill * 0.12;
                $total_electric_bill = $electric_bill + $vat;
                $electric_amount_room5 = $total_electric_bill;
                $Room_id = $_POST['Room_id_bill_4'];

                mysqli_query($conn, "UPDATE users SET prev_electricity = $previous_electric, press_electricity = $present_electric, electricity_bill = $electric_amount_room4 WHERE room_id='$Room_id'");



            }


            if (isset($_POST['calculate_water_5'])){

                // water computation variable

                $previous_water = $_POST['water_amount_previous_5'];
                $present_water = $_POST['water_amount_present_5'];

                $water_consumption = $present_water - $previous_water;
                $waterbill = $water_consumption * $water_price;
                $taxless_bill = $waterbill + $maintenance_fee;
                $franchise_tax = $taxless_bill * 0.02;
                $total_bill = $taxless_bill + $franchise_tax;

                $water_amount_room5 = $total_bill;

                $Room_id = $_POST['Room_id_bill_5'];

                mysqli_query($conn, "UPDATE users SET prev_water = $previous_water, press_water = $present_water, water_bill = $water_amount_room5 WHERE room_id='$Room_id'");



            }

            if (isset($_POST['calculate_electric_5'])){



                // electric computation variables
                $previous_electric = $_POST['electric_amount_previous_5'];
                $present_electric = $_POST['electric_amount_present_5'];

                $electric_consumption = $present_electric - $previous_electric;
                $electric_bill = $electric_consumption * $Power_rate;
                $vat = $electric_bill * 0.12;
                $total_electric_bill = $electric_bill + $vat;
                $electric_amount_room5 = $total_electric_bill;

                $Room_id = $_POST['Room_id_bill_5'];

                mysqli_query($conn, "UPDATE users SET prev_electricity = $previous_electric, press_electricity = $present_electric, electricity_bill = $electric_amount_room5 WHERE room_id='$Room_id'");



            }







            ?>



            <div style="display: flex; gap: 50px; flex-wrap: wrap; padding-left:35px; margin-top: 40px;">
                <div>
                    <table style="width: 180px"> 

                        <tr>

                            <th>Room 1</th>
                        
                        </tr>
                            <tr>
                                
                                <td>

                                    <form method="POST">


                                        <input type="hidden" name="Room_id_bill_1" value="Room 1">


                                        <h4>Water Bill</h4>
                                        <input type="number"  name="water_amount_previous_1" placeholder="Previous Reading" required>
                                        <input type="number"  name="water_amount_present_1" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_water_1">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $water_amount_room1 ?> </p4><br><br><br>
                                    </form> 
                                    
                                    <form method="POST">  
                                        <input type="hidden" name="Room_id_bill_1" value="Room 1"> 

                                        <h4>Electricity Bill</h4>
                                        <input type="number"  name="electric_amount_previous_1" placeholder="Previous Reading" required>
                                        <input type="number"  name="electric_amount_present_1" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_electric_1">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $electric_amount_room1 ?> </p4>
                                    </form>



                                    

                                </td>


                            </tr>


                    </table>
                </div>

                <div>

                    <table style="width: 180px"> 

                        <tr>

                            <th>Room 2</th>
                        
                        </tr>

                        <tr>
                                
                            <td>
                                <form method="POST">


                                        <input type="hidden" name="Room_id_bill_2" value="Room 2">

                                        <h4>Water Bill</h4>
                                        <input type="number"  name="water_amount_previous_2" placeholder="Previous Reading" required>
                                        <input type="number"  name="water_amount_present_2" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_water_2">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $water_amount_room2 ?> </p4><br><br><br>
                                    </form> 
                                    
                                    <form method="POST">
                                        <input type="hidden" name="Room_id_bill_2" value="Room 2">

                                        <h4>Electricity Bill</h4>
                                        <input type="number"  name="electric_amount_previous_2" placeholder="Previous Reading" required>
                                        <input type="number"  name="electric_amount_present_2" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_electric_2">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $electric_amount_room2 ?> </p4>
                                    </form>
                            </td>

                        </tr>
                    </table>
                </div>


                <div>

                    <table style="width: 180px"> 

                        <tr>

                            <th>Room 3</th>
                        
                        </tr>
                        <tr>
                                
                            <td>
                                <form method="POST">


                                        <input type="hidden" name="Room_id_bill_3" value="Room 3">

                                        <h4>Water Bill</h4>
                                        <input type="number"  name="water_amount_previous_3" placeholder="Previous Reading" required>
                                        <input type="number"  name="water_amount_present_3" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_water_3">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $water_amount_room3 ?> </p4><br><br><br>
                                    </form> 
                                    
                                    <form method="POST">
                                        <input type="hidden" name="Room_id_bill_3" value="Room 3">

                                        <h4>Electricity Bill</h4>
                                        <input type="number"  name="electric_amount_previous_3" placeholder="Previous Reading" required>
                                        <input type="number"  name="electric_amount_present_3" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_electric_3">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $electric_amount_room3 ?> </p4>
                                    </form>
                            </td>

                        </tr>


                    </table>
                </div>


                <div>

                    <table style="width: 180px"> 

                        <tr>

                            <th>Room 4</th>
                        
                        </tr>

                        <tr>
                                
                            <td>
                                <form method="POST">


                                        <input type="hidden" name="Room_id_bill_4" value="Room 4">

                                        <h4>Water Bill</h4>
                                        <input type="number"  name="water_amount_previous_4" placeholder="Previous Reading" required>
                                        <input type="number"  name="water_amount_present_4" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_water_4">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $water_amount_room4 ?> </p4><br><br><br>
                                    </form> 
                                    
                                    <form method="POST">
                                        <input type="hidden" name="Room_id_bill_4" value="Room 4">

                                        <h4>Electricity Bill</h4>
                                        <input type="number"  name="electric_amount_previous_4" placeholder="Previous Reading" required>
                                        <input type="number"  name="electric_amount_present_4" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_electric_4">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $electric_amount_room4 ?> </p4>
                                    </form>
                            </td>

                        </tr>


                    </table>
                </div> 



                <div>

                    <table style="width: 180px"> 

                        <tr>

                            <th>Room 5</th>
                        
                        </tr>

                            <tr>
                                
                                <td>
                                    <form method="POST">


                                        <input type="hidden" name="Room_id_bill_5" value="Room 5">
                                        

                                        <h4>Water Bill</h4>
                                        <input type="number"  name="water_amount_previous_5" placeholder="Previous Reading" required>
                                        <input type="number"  name="water_amount_present_5" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_water_5">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $water_amount_room5 ?> </p4><br><br><br>
                                    </form> 
                                    
                                    <form method="POST">
                                        <input type="hidden" name="Room_id_bill_5" value="Room 5">

                                        <h4>Electricity Bill</h4>
                                        <input type="number"  name="electric_amount_previous_5" placeholder="Previous Reading" required>
                                        <input type="number"  name="electric_amount_present_5" placeholder="Present Reading" required>
                                        <button style="border-radius: 5px;" type="submit" name="calculate_electric_5">Calculate Bill</button><br>
                                        <p4 class="center-text">Amount: <?php echo $electric_amount_room5 ?> </p4>
                                    </form>
                                </td>

                            </tr>

                    </table>
                </div>

        

            </div>







        </div>



        <!---------------------records of tenantss rent payments history  -->




        <div id="records" class="section">
            <h1>Records</h1>
            
            <?php
            $records = mysqli_query($conn, "
                SELECT tenants_record .*, users.firstname 
                FROM tenants_record 
                JOIN users ON tenants_record .tenant_id = users.user_id
                
                ORDER BY users.firstname ASC
            ");


            if (isset($_POST['generate'])) {

                $current_month = date("m");
                $current_year = date("Y");


                // -------------active tenants queryy------

                $query = "SELECT * FROM users WHERE status='Active'";
                $result = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($result)) {

                    $tenant_id = $row['user_id'];
                    $rent_amount = 5000; 

                    //-------- null check of records-----
                    $check = "SELECT * FROM tenants_record 
                              WHERE tenant_id='$tenant_id' 
                              AND month='$current_month' 
                              AND year='$current_year'";

                    $check_result = mysqli_query($conn, $check);

                    if (mysqli_num_rows($check_result) == 0) {

                        
                        $insert = "INSERT INTO tenants_record  
                                   (tenant_id, month, year, amount, status)
                                   VALUES 
                                   ('$tenant_id', '$current_month', '$current_year', '$rent_amount', 'unpaid')";

                        mysqli_query($conn, $insert);
         
 
                    }

                } 


                
            }
            // ------------function to update tenants rent bill

            if (isset($_POST['paid'])) {

                $value = $_POST['tenant_id'];

                mysqli_query($conn, "UPDATE tenants_record SET status='paid' WHERE tenant_id='$value'");

            }
            ?>


            <h3 style="padding-left:20px;">Rent history Records </h3>
            <p>Note: Once you generate a rent or mark a table as paid you must also reload to see the changes.</p><hr>
            <form method="POST">
                <button  type="submit" name="generate" style="margin-left: 20px; padding: 5px; border-radius: 5px; background: hsl(224, 64%, 39%);">Generate Rent</button>
                <button type="button" onclick="location.reload()" style="margin-left: 20px; padding: 5px; border-radius: 5px; background: hsl(224, 64%, 39%);">Reload</button>
            </form>

            <table>

                <tr>
                    <th>Tenant Name</th>
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
                                <td><?=$row['status']; 

                                if ($row['status'] === 'unpaid') {
                                    // code...

                                    ?>
                                    <form method="POST">
                                        <input type="hidden" name="tenant_id" value="<?= $row['tenant_id'] ?>"><hr>
                                        <button type="submit" name="paid" style=" padding: 5px; border-radius: 5px; background: hsl(224, 43%, 47%);justify-self: center;" >Mark as paid</button>
                                    </form>


                                    <?php


                                }

                                

                                ?>

                                
                                </td>
                            </tr>
                    <?php
                    } ?>
                <?php
                } 
                  
                ?>

            </table>


        </div>

    </div>


    <!---------------------  display function switching sa menu ----------->

    <script>
        //-----room data values for doughnut grap ng occupancy-----------
        let room1Occupied = <?php echo $room1Occupied; ?>;
        let room1Capacity = <?php echo $room1Capacity; ?>;

        let room2Occupied = <?php echo $room2Occupied; ?>;
        let room2Capacity = <?php echo $room2Capacity; ?>;

        let room3Occupied = <?php echo $room3Occupied; ?>;
        let room3Capacity = <?php echo $room3Capacity; ?>;

        let room4Occupied = <?php echo $room4Occupied; ?>;
        let room4Capacity = <?php echo $room4Capacity; ?>;

        let room5Occupied = <?php echo $room5Occupied; ?>;
        let room5Capacity = <?php echo $room5Capacity; ?>;

        let totalOccupied = <?php echo $totalOccupied; ?>;
        let totalCapacity = <?php echo $totalCapacity; ?>;

        // ------doughnut chart function----- 
        function createChart(id, occupied, capacity) {
            new Chart(document.getElementById(id), {
                type: 'doughnut',
                data: {
                    labels: ['Occupied', 'Available'],
                    datasets: [{
                        data: [occupied, capacity - occupied],
                        backgroundColor: [ 'purple', 'violet']
                    }]
                },
                options: {
                    cutout: '70%',
                    plugins: {
                        legend: {  position: "bottom"  }
                    }
                }
            });
        }

        //---------- function to display yung doughnut graph/chart
        

        function loadCharts() {
            createChart('room1Chart', room1Occupied, room1Capacity);
            createChart('room2Chart', room2Occupied, room2Capacity);
            createChart('room3Chart', room3Occupied, room3Capacity);
            createChart('room4Chart', room4Occupied, room4Capacity);
            createChart('room5Chart', room5Occupied, room5Capacity);
            createChart('dormChart', totalOccupied, totalCapacity);
        }

        //-------------- function sa switch menuu
        function showSection(sectionId, element) {
            document.querySelectorAll('.section').forEach(sec => {
                sec.classList.remove('active');
            });

            document.querySelectorAll('.menu-item').forEach(item => {
                item.classList.remove('active');
            });

            document.getElementById(sectionId).classList.add('active');
            element.classList.add('active');

            // trigger ng menu pag na select ang rooms i loload din ang chart/graph
            if (sectionId === 'rooms') {
                loadCharts();
            }
        }
    </script>

</body>

</html>