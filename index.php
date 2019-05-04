<?php

session_start();

//set session variables for date
date_default_timezone_set("Africa/Johannesburg");

?>

<?php

require_once 'connect.php';

?>

<?php

// sql to create table bookings

	$sqlQuery = "CREATE TABLE IF NOT EXISTS bookings (
					id INT(6) NOT NULL AUTO_INCREMENT,
					firstname VARCHAR(40) NOT NULL,
					surname VARCHAR(40) NOT NULL,
                    hotelname VARCHAR(40) NOT NULL,
                    indate VARCHAR(40) NOT NULL,
                    outdate VARCHAR(40) NOT NULL,
					booked VARCHAR(4),
                    datetime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                    primary key (id)
                  );";

	$returnResult = $conn->query($sqlQuery);

	if($returnResult)
	{
		echo "<p>Table created successfully.</p>";
	}
	else 
	{
		echo "<p>Error occurred while creating the table.</p>" .mysqli_error($conn);
		echo "<p>Exiting...</p>";
     	exit();
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hotel Booking App</title>
    <link rel="icon" href="#">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.css" />
    <link href="https://fonts.googleapis.com/css?family=Poppins|Roboto" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div class="container">
   
   <h1 class="brand"> <span>Hotel</span> Booking App</h1>
   
   <div class="wrapper animated pulse">
       <div class="company-info">
       <h3>  Your Dream Vacation Awaits</h3>
       </div>
       <div class="contact">
       
       <h3> Booking Form</h3> 
       
       
<!-- create and display the form -->


<form name = "checkBooking" role="form" action = "<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method = "POST"> 
      
    <p>
    <i class="fas fa-user-circle"></i>
     <label> First Name </label>
     <input type = "text" name = "firstName" placeholder = "Enter your Firstname" required autofocus/>
   </p>
   <p>
    <i class="fas fa-user-circle"></i>
     <label>Surname</label>
     <input type = "text" name = "surName" placeholder = "Enter your Surname" required/>
   </p>
   <p>
   <i class="fas fa-calendar-day"></i>
   <label>Check-In Date</label>
    <input type = "date" name = "inDate" value = <?php echo date('Y-m-d');  ?> min = <?php echo date('Y-m-d'); ?>  required/>
   </p>
   <p>
      <i class="fas fa-calendar-day"></i>
       <label>Check-Out Date</label>
       <input type = "date" name = "outDate" value = <?php echo date('Y-m-d');  ?> min = <?php echo date('Y-m-d'); ?> required/>
   </p>

   <p class="full" >
     <i class="fas fa-hotel"></i>
      <label>Select a Hotel</label> 
             
<select name="hotelname" required>
  <option value="Taj Cape Town">Taj Cape Town</option>
  <option value="Twelve Apostles Hotel and Spa">Twelve Apostles Hotel and Spa</option>
  <option value="Cape Grace">Cape Grace</option></option>
  <option value="The Table Bay Hotel">The Table Bay Hotel</option>
</select>
   </p>

      <p class="full" >
        <button type="submit" name = "check" value = "Check">Check Availbility </button>
    </p>


    
       </form>
    
<?php
   
//set session variables 
echo '<div class="info">'; // info Div to Confim booking
    
 if (!empty($_POST['check'])){
     
   
            
        $_SESSION['firstName'] = $_POST['firstName']; 
        $_SESSION['surName'] = $_POST['surName']; 
        $_SESSION['inDate'] = $_POST['inDate']; 
        $_SESSION['outDate'] = $_POST['outDate']; 
        $_SESSION['hotelname'] = $_POST['hotelname']; 
        
    
        
     // PRG method to prevent data from the previous post populating the list on refresh / reload
     
       header('location:'.$_SERVER['PHP_SELF']);
       return;
     
 
 }
     
    if (isset($_SESSION['firstName'])){
    
            $in =  date_create($_SESSION['inDate']);
            $out = date_create($_SESSION['outDate']);
            $duration = date_diff($in, $out);

            $daysBooked = $duration->format('%d');

        
        // Check for Duplicate Bookings - Validation 
             
     $checkName = $_SESSION['firstName'];
     
         // Check for duplicate booking - using firstname as Key
        
                $query = "SELECT * from bookings where firstname = '$checkName'";
                        $result = mysqli_query($conn, $query);

                        if(mysqli_num_rows($result) > 0)
                        {
                            echo "<span> There is an existing booking for </span> <br>";
                            // Associative array
                              while($row = mysqli_fetch_assoc($result))
    {
                            echo  $row['firstname'] ." ". $row['surname'] . " at the ". $row['hotelname'] ." from the ". $row['indate'] ." to the ". $row['outdate'] . " booked on the ". $row['datetime'] . " <br> <br>";
                              }

                        } else {
                            
                 echo "<span> Guest Name: </span>" . $_SESSION['firstName'] . " " .  $_SESSION['surName'] ."<br><span>  Check-In Date: </span> " .  $_SESSION['inDate'] ."<br> <span> Check-Out Date: </span>  " .  $_SESSION['outDate'] ."<br> <span> Hotel Name: </span> " .  $_SESSION['hotelname'] . "<br>" ;

            if (($duration->format('%R')) == '+'){
                 echo  "<span>  Number of nights required: </span> " . $daysBooked;
            }else
            {
                echo "Invalid Duration - Please ensure that your CheckOut Date is after your CheckIn Date";
            }


            echo "<br>";

            $tajRate = 100;
            $twelveRate = 200;
            $graceRate = 300;
            $tableRate = 400;


                switch($_SESSION['hotelname']){
                case('Taj Cape Town') : {
                                          echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $tajRate . " at a rate of R" .  $tajRate . " per night";
                                        }
                                         break;
                case('Twelve Apostles Hotel and Spa') :  {
                                          echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $twelveRate . " at a rate of R" .  $twelveRate . " per night";
                                        }
                                         break;
                case('Cape Grace') : {
                                          echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $graceRate . " at a rate of R" .  $graceRate. " per night";
                                        }
                                         break;
                case('The Table Bay Hotel') :  {
                                          echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $tableRate. " at a rate of R" .  $tableRate . " per night";
                                        }
                                         break;
                default:
                return "Invalid Input - Please restart the booking process";
        
                
        }
        


        
   echo '<form name="confirmBooking" action="index.php" method="post">'; 
        
           

  
        
        
   echo '<button type="submit" class="btn btn-success" name = "confim" value = "confim">Confirm Booking </button>';
  
      echo '</form>';  
        
              
            if (!empty($_POST['confim'])){
                
           
                $stmt = $conn->prepare("INSERT INTO bookings (firstname, surname, hotelname, indate, outdate) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $firstname, $surname, $hotelname, $indate, $outdate);

                // set parameters and execute
                $firstname = $_SESSION['firstName'];
                $surname = $_SESSION['surName'];
                $hotelname = $_SESSION['hotelname'];                
                $indate = $_SESSION['inDate'];                
                $outdate = $_SESSION['outDate'];                

                $stmt->execute();
                $stmt->close();

               
  
                echo "New records created successfully";
                
                echo '<a href="clearData.php">Clear Session Data</a>';    
    
                           
                        }
        
            }
           
        
         echo '</div>'; // closing info Div to Confim booking
    
        
    }
    
    
?>
      </div> <!-- end div Contact -->
     </div><!-- end div Wrapper -->
    </div><!-- end div Container -->
    
  
    </div> <!-- end div Container -->
    
    
    <!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
    
    </body>
</html>
