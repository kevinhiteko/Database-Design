<?php
session_start();
$con = mysqli_connect("localhost","root","","systems");

if(isset($_POST['Submit']))
{
    $Travelling_From = $_POST['Travelling_From'];
    $Travelling_To = $_POST['Travelling_To'];
    $Time_Of_Travel = $_POST['Time_Of_Travel'];
    $Departure_Date = date('Y-m-d', strtotime($_POST['dateofbirth']));

    $query = "INSERT INTO reservation (Travelling_From,Travelling_To,Time_Of_Travel,Departure_Date) VALUES ('$Travelling_From','$Travelling_To','$Time_Of_Travel','$Departure_Date')";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $_SESSION['status'] = "Date values Inserted";
        header("Location: http://localhost/Payment.html");
       /* echo "Successfully booked.";*/
    }
    else
    {
        $_SESSION['status'] = " values Inserting Failed";
        header("Location: index.php");
    }
}
?>