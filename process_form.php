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

$sql = "INSERT INTO yoga_classes (name, age, batch) VALUES ('$name', '$age', '$batch')";

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
    </style>
</head>

<body>

    <?php

if ($conn->query($sql) === TRUE) {

    $userDetails = ['name' => $name, 'age' => $age];
    $paymentDetails = ['amount' => 50];
    $paymentResponse = CompletePayment($userDetails, $paymentDetails);

    // Return response to front-end based on payment response
    // echo json_encode(['success' => $paymentResponse['success'], 'message' => $paymentResponse['message']]);
    if ($paymentResponse['success'] == true) {
        echo "<h1 style='color: green;text-align: center;'>Payment Successful</h1>";
    } else {
        echo "<h1 style='color: red;text-align: center;'>Payment is not Successful</h1>";
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Error: ' . $conn->error]);
}
echo '<div style="text-align: center; margin-top: 20px;"><a href="./index.html" style="text-decoration: none; padding: 10px 20px; background-color: #4caf50; color: #fff; display: inline-block;">Home</a></div>';
$conn->close();

?>

</body>

</html>
