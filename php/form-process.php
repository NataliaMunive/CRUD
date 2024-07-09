<?php

$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG = "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MSG Guest
if (empty($_POST["guest"])) {
    $errorMSG .= "Guest is required ";
} else {
    $guest = $_POST["guest"];
}


// MSG Event
if (empty($_POST["event"])) {
    $errorMSG .= "Event is required ";
} else {
    $event = $_POST["event"];
}


// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


$EmailTo = "armanmia7@gmail.com";
$Subject = "New Message Received";

// prepare email body text
$Body = "";
$Body .= "Name: ";
$Body .= $name;
$Body .= "\n";
$Body .= "Email: ";
$Body .= $email;
$Body .= "\n";
$Body .= "Guest: ";
$Body .= $guest;
$Body .= "\n";
$Body .= "Event: ";
$Body .= $event;
$Body .= "\n";
$Body .= "Message: ";
$Body .= $message;
$Body .= "\n";

// send email
$success = mail($EmailTo, $Subject, $Body, "From:".$email);

// Insertar los datos en la tabla de la base de datos si no hay errores
if ($success && $errorMSG == ""){
    // Conexión a la base de datos (modifica los valores según tu configuración)
    $servername = "localhost";
    $username = "tu_usuario";
    $password = "tu_contraseña";
    $dbname = "usuarios";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Insertar los datos en la tabla
    $sql = "INSERT INTO usuarios (nombre, email, guest, event, mensaje)
    VALUES ('$name', '$email', '$guest', '$event', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG;
    }
}

?>