<?php
session_start();

if (!isset($_SESSION['doktori_id'])) {
    die("Pristup zabranjen! Nemate ovlašćenje za ovu stranicu.");
}

echo "<h1>Dobrodošli, " . htmlspecialchars($_SESSION['doktori_ime']) . "!</h1>";

$conn = new mysqli('db', 'devuser', 'devpass', 'test_db');

if ($conn->connect_error) {
    die("Konekcija neuspešna: " . $conn->connect_error);
}

$sql = "SELECT ime, prezime, email, specijalizacija, datum_rodjenja FROM doktori";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1' style='width:100%; text-align:left;'>";
    echo "<tr>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Email</th>
            <th>Specijalizacija</th>
            <th>Datum rođenja</th>
          </tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['ime']) . "</td>
                <td>" . htmlspecialchars($row['prezime']) . "</td>
                <td>" . htmlspecialchars($row['email']) . "</td>
                <td>" . htmlspecialchars($row['specijalizacija']) . "</td>
                <td>" . htmlspecialchars($row['datum_rodjenja']) . "</td>
              </tr>";
    }

    echo "</table>";
} else {
    echo "Nema podataka u tabeli.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doktor</title>
    <style>
        table {
            margin-top: 20px;
            border-collapse: collapse;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <a href="logout.php" class="btn btn-danger">Odjava</a>
    </div>
</body>
</html>
