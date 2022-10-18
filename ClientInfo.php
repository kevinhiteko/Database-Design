<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['clientname']) &&
        isset($_POST['clientsurname']) &&
        isset($_POST['IdNumber']) &&
        isset($_POST['gender']) && isset($_POST['email']) &&
        isset($_POST['phoneCode']) && isset($_POST['phone']) &&
        isset($_POST['Travelling_with_infant'])) {
        
        $clientname = $_POST['clientname'];
        $clientsurname = $_POST['clientsurname'];
        $IdNumber = $_POST['IdNumber'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $phoneCode = $_POST['phoneCode'];
        $phone = $_POST['phone'];
        $Travelling_with_infant = $_POST['Travelling_with_infant'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "systems";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT email FROM client_info WHERE email = ? LIMIT 1";
            $Insert = "INSERT INTO client_info(clientname, clientsurname,IdNumber, gender, email, phoneCode, phone, Travelling_with_infant) values(?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssssiis",$clientname, $clientsurname, $IdNumber, $gender, $email, $phoneCode, $phone, $Travelling_with_infant);
                if ($stmt->execute()) {
                    header('Location: http://localhost/Reservation.html');
                    //echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>