<?php
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $idnumber = $_POST['idnumber'];

//Database connection
    $conn = new mysqli('localhost','root','','test');
    if($conn->connect_error){
        die('Connection failed : '.$conn->connect_error);
    }else{
        $stmt = $conn->prepare("insert into test_(name, surname, gender, email, password, idnumber) values(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $name, $surname, $gender, $email, $password, $idnumber); //since all are strings, if interger then i, double then d, blob then b
        $stmt->execute();
        echo "Registration successful";
        $stmt->close();
        $conn->close();
    }


?>