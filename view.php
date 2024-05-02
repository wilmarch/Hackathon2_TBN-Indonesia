<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

<?php
$dsn = 'mysql:host=localhost;dbname=hackathon2';
$username = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $username, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $stmt = $dbh->query("SELECT nama, email FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "<div class='container mx-auto my-8'>";
    echo "<h2 class='text-2xl font-bold mb-4'>Data Pengguna</h2>";
    echo "<div class='overflow-x-auto'>";
    echo "<table class='w-full bg-white border-collapse border border-gray-300'>";
    echo "<thead>";
    echo "<tr class='bg-gray-200'>";
    echo "<th class='px-4 py-2'>Nama</th><th class='px-4 py-2'>Email</th>";
    echo "</tr>";
    echo "</thead>";
    echo "<tbody>";
    foreach ($users as $user) {
        echo "<tr class='bg-white'>";
        echo "<td class='border px-4 py-2'>".$user['nama']."</td><td class='border px-4 py-2'>".$user['email']."</td>";
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";
    echo "</div>";
    echo "</div>";
    echo "<div class='container mx-auto my-4'>";
    echo "<a href='index.html' class='bg-green-500 hover:bg-green-900 text-white font-bold py-2 px-4 rounded'>Back to Home</a>";
    echo "</div>";
} catch (PDOException $e) {
    echo "Koneksi database gagal: " . $e->getMessage();
}
?>
</body>
</html>
