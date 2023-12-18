<?php

function CompletePayment($userDetails, $paymentDetails) {
    // Perform payment processing logic (this is a mock, so no real payment is done)
    return ['success' => true, 'message' => 'Payment successful'];
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "yogaDB";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$name = $_POST['name'];
$age = $_POST['age'];
$batch = $_POST['batch'];
$gender = $_POST['gender'];
$sdate= $_POST['sdate'];

$sql = "INSERT INTO yoga_classes (name, age, batch,gender,start_date) VALUES ('$name', '$age', '$batch','$gender','$sdate')";


$phone = $_POST['phone'];
$email = $_POST['email'];
$cardNumber = $_POST['cardNumber'];
$expiryDate= $_POST['expiryDate'];

$sqlP = "INSERT INTO payment_information (phone, email, credit_card_number,expiry_date) VALUES ('$phone', '$email', '$cardNumber','$expiryDate')";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your PHP Page Title</title>
    <style>
        body {
            background-color: lightgrey; /* Change this to the desired background color */
            margin-top: 15%;
        }
        .card{
            max-width: 60%;
            margin: 1% auto;
            background-color: #fff;
            opacity: 1;
            background: radial-gradient(circle at 0% 100%, #3be241bb 35%, rgba(255, 255, 255, 0.671) 36%, transparent 36%), radial-gradient(circle at 100% 0%, #3be241bb 35%, rgba(255, 255, 255, 0.767) 36%, #ffffffce 36%);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
<div class="card">
    <?php

if ($conn->query($sql) === TRUE && $conn->query($sqlP) === TRUE) {

    $userDetails = ['name' => $name, 'age' => $age];
    $paymentDetails = ['amount' => 50];
    $paymentResponse = CompletePayment($userDetails, $paymentDetails);

    // Return response to front-end based on payment response
    // echo json_encode(['success' => $paymentResponse['success'], 'message' => $paymentResponse['message']]);
    if ($paymentResponse['success'] == true) {
        echo "<h1 style='color: green;text-align: center;'>Payment Successful</h1>";
        echo "<h2 style='color: green;text-align: center;'>You can start joining classes from $sdate</h2>";
    } else {
        echo "<h1 style='color: red;text-align: center;'>Payment is not Successful</h1>";
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}
echo '<div style="text-align: center; margin-top: 20px;"><a href="./index.html" style="text-decoration: none; padding: 10px 20px; background-color: #4caf50; color: #fff; display: inline-block;">Home</a></div>';
$conn->close();

?>
</div>
</body>

</html>
