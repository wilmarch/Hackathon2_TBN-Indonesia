<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

// Fungsi untuk menyimpan data ke database
function simpanData($nama, $email) {
    $dsn = 'mysql:host=localhost;dbname=hackathon2';
    $username = 'root';
    $password = '';

    try {
        $dbh = new PDO($dsn, $username, $password);
        $stmt = $dbh->prepare("INSERT INTO users (nama, email) VALUES (:nama, :email)");
        $stmt->bindParam(':nama', $nama);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $dbh = null;
        return true;
    } catch (PDOException $e) {
        return false;
    }
}

$nama = $_POST['nama'];
$email = $_POST['email'];

if(simpanData($nama, $email)) {
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;
    $mail->Username = 'johnnydion38@gmail.com'; 
    $mail->Password = 'xehy retm wccn gtsj'; 
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('johnnydion38@gmail.com', 'Will');
    $mail->addAddress($email, $nama);
    $mail->Subject = 'TBN Indonesia';
    $mail->Body    = 'Test';

    // Kirim email
    if(!$mail->send()) {
        $status = 'Message could not be sent.';
        $statusClass = 'bg-red-100 text-red-700';
    } else {
        $status = 'Message has been sent';
        $statusClass = 'bg-green-100 text-green-700';
    }
} else {
    $status = 'Failed to save data to database';
    $statusClass = 'bg-red-100 text-red-700';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission Status</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto mt-8">
        <div class="max-w-md mx-auto bg-white rounded-md shadow-md overflow-hidden">
            <div class="px-6 py-4 bg-gray-100 border-b">
                <h2 class="text-lg font-semibold text-gray-800">Submission Status</h2>
            </div>
            <div class="px-6 py-4">
                <div class="py-2 px-4 <?php echo $statusClass; ?> rounded-md">
                    <?php echo $status; ?>
                </div>
                <a href="index.html" class="inline-block mt-4 px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-600">Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>