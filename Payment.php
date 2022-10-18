<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Bank_Name']) && isset($_POST['Account_Number']) &&
        isset($_POST['Card_Number']) && isset($_POST['Security_Code'])) {
        
        $Bank_Name = $_POST['Bank_Name'];
        $Account_Number	 = $_POST['Account_Number'];
        $Card_Number = $_POST['Card_Number'];
        $Security_Code = $_POST['Security_Code'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "systems";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);

        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Security_Code FROM payment WHERE Security_Code = ? LIMIT 1";
            $Insert = "INSERT INTO payment(Bank_Name, Account_Number, Card_Number, Security_Code) values(?, ?, ?, ?)";

            $stmt = $conn->prepare($Select);
            $stmt->bind_param("i", $Security_Code);
            $stmt->execute();
            $stmt->bind_result($resultSecurity);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows; 

            if ($rnum == 0) {
                $stmt->close();

                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sssi",$Bank_Name, $Account_Number, $Card_Number, $Security_Code);
                if ($stmt->execute()) {
                    echo "Successfully booked.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Unrecognised Security Code.";
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