<?php
    session_start();
    //set session variables for date
    date_default_timezone_set("Africa/Johannesburg");
    $today = date('Y-m-d');
    $tomorrow = date("Y-m-d", strtotime("+1 day"));
?>

<?php
    // import the connection creation script from connect.php
    require_once 'connect.php';
    include 'Booking.php';
?>

<?php
    // sql to create table bookings using OOP approach
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
            echo " <script> console.log('Table Created Successfully'); </script>"; // error checking if Table was created successfully 
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
        <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
        <link rel="icon" href="images/favicon.ico" type="image/x-icon">
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
                <input type = "text" name = "firstName"  required autofocus/>
           </p>
           <p>
                <i class="fas fa-user-circle"></i>
                <label>Surname</label>
                <input type = "text" name = "surName" required/>
           </p>
           <p>
                <i class="fas fa-calendar-day"></i>
                <label>Check-In Date</label>
                <input type = "date" name = "inDate" value = <?php echo date('Y-m-d');  ?> min = <?php echo date('Y-m-d'); ?>  required/>
           </p>
           <p>
                <i class="fas fa-calendar-day"></i>
                <label>Check-Out Date</label>
                <input type = "date" name = "outDate" value = <?php echo $tomorrow;  ?> min = <?php echo $tomorrow; ?> required/>
               
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

        
        echo '<div class="info">'; // info Div to Confim booking

         if (!empty($_POST['check'])){

                //set session variables 

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
                
                //Class Booking - Instantiation and __construc 
                
                
                $booking = new Booking($_SESSION['firstName'], $_SESSION['surName'], $_SESSION['inDate'], $_SESSION['outDate'], $_SESSION['hotelname']); 
                

                $booking->calcDuration();
                
                
            }
          
                echo '</div>'; // closing info Div to Confim booking
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