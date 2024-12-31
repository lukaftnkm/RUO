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

// Provera da li su podaci poslati putem POST-a
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $jmbg = $_POST['jmbg'];
    $lbo = $_POST['lbo'];
    $ime = $_POST['ime'];
    $prezime = $_POST['prezime'];
    $datum_rodjenja = $_POST['datum_rodjenja'];
    // $pol = $_POST['pol'];
    // var_dump($pol);
    $telefon = $_POST['telefon'];

    // Priprema SQL upita za unos podataka
    $sql = "INSERT INTO pacijenti (id, jmbg, lbo, ime, prezime, datum_rodjenja, telefon) 
        VALUES (?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("issssss", $id, $jmbg, $lbo, $ime, $prezime, $datum_rodjenja, $telefon);

    // Izvrši upit
    if ($stmt->execute()) {
        echo "Pacijent uspešno unesen!";
    } else {
        echo "Greška prilikom unosa pacijenta: " . $stmt->error;
    }
    $stmt->close();
} else {
    echo "Greška u pripremi SQL upita: " . $conn->error;
}
}

$conn->close();
?>
