<?php


class Booking{
        public $firstName;
        public $surName;
        public $inDate;
        public $outDate;
        public $hotelName;
    
    public function __construct($firstName,$surName,$inDate,$outDate,$hotelName)
    {
        
        $this->firstname = $firstName;
        $this->surname = $surName;
        $this->inDate = $inDate;
        $this->outDate = $outDate;
        $this->hotel = $hotelName;
        
    }
    
    
    
    public function calcDuration(){
        
            include 'connect.php';
        
                    $in =  date_create($this->inDate);
                    $out = date_create($this->outDate );
                    $duration = date_diff($in, $out);

                    $daysBooked = $duration->format('%d');


                // Check for Duplicate Bookings - Validation 

             $checkName = $this->firstname;

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

                         echo "<span> Guest Name: </span>" . $this->firstname . " " .  $this->surname  ."<br><span>  Check-In Date: </span> " . $this->inDate ."<br> <span> Check-Out Date: </span>  " .  $this->outDate ."<br> <span> Hotel Name: </span> " .  $this->hotel . "<br>" ;

                    if (($duration->format('%R')) == '+'){
                         echo  "<span>  Number of nights required: </span> " . $daysBooked;
                    }else
                    {
                        echo "Invalid Duration - Please ensure that your CheckOut Date is after your CheckIn Date";
                    }


                    echo "<br>";

                    $tajRate    = 100;
                    $twelveRate = 200;
                    $graceRate  = 300;
                    $tableRate  = 400;


                        switch($_SESSION['hotelname']){
                        case('Taj Cape Town') : {
                                                  echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $tajRate . " at a rate of R" .  $tajRate . " per night <br><br>";

                                                }
                                                 break;
                        case('Twelve Apostles Hotel and Spa') :  {
                                                  echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $twelveRate . " at a rate of R" .  $twelveRate . " per night <br><br>";

                                                }
                                                 break;
                        case('Cape Grace') : {
                                                  echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $graceRate . " at a rate of R" .  $graceRate. " per night <br><br>";

                                                }
                                                 break;
                        case('The Table Bay Hotel') :  {
                                                  echo " Total Bill for stay of ". $daysBooked ." nights is R" . $daysBooked * $tableRate. " at a rate of R" .  $tableRate . " per night <br><br>";

                                                }
                                                 break;
                        default:
                        echo "Invalid Input - Please restart the booking process";

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


                        echo " <script> console.log('New records created successfully'); </script>"; 
                        echo "Booking Confirmed - Thank you for using the Hotel Booking App, Enjoy your stay";
                        echo "<br> <br>";
                        echo '<a class="btn" href="clearData.php">Start a New Booking</a>';    
                      
                        }
                    
            }
                
        
    }

}
?>