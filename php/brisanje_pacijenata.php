<?php
session_start();

if (!isset($_SESSION['doktori_id'])) {
    die("Pristup zabranjen! Nemate ovlašćenje za ovu stranicu.");
}

// Konekcija na bazu podataka
$conn = new mysqli('db', 'devuser', 'devpass', 'test_db');

if ($conn->connect_error) {
    die("Konekcija neuspešna: " . $conn->connect_error);
}

// Proveri da li je ID pacijenta prosleđen
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Pripremi SQL upit za brisanje pacijenta sa zadatim ID-om
    $sql = "DELETE FROM pacijenti WHERE id = ?";

    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id); // Bindovanje parametra za ID

        // Izvrši upit
        if ($stmt->execute()) {
            echo "Pacijent uspešno obrisan!";
        } else {
            echo "Greška prilikom brisanja pacijenta: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Greška u pripremi SQL upita: " . $conn->error;
    }
}

$conn->close();
?>
