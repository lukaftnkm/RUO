<?php
session_start();

if (!isset($_SESSION['doktori_id'])) {
    die("Pristup zabranjen! Nemate ovlašćenje za ovu stranicu.");
}

echo "<h1>Dobrodošli, " . htmlspecialchars($_SESSION['doktori_ime']) . "!</h1>";

// Konekcija na bazu podataka
$conn = new mysqli('db', 'devuser', 'devpass', 'test_db');

if ($conn->connect_error) {
    die("Konekcija neuspešna: " . $conn->connect_error);
}

// Upit za tabelu doktori
$sql = "SELECT ime, prezime, email, specijalizacija, datum_rodjenja FROM doktori";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    echo "<h2>Lista doktora</h2>";
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
    echo "Nema podataka u tabeli doktori.";
}

$sql_pacijenti = "SELECT id, jmbg, lbo, ime, prezime, datum_rodjenja, telefon FROM pacijenti";
$result_pacijenti = $conn->query($sql_pacijenti);

if ($result_pacijenti && $result_pacijenti->num_rows > 0) {
    echo "<h2>Lista pacijenata</h2>";
    echo "<table border='1' style='width:100%; text-align:left; margin-top: 20px;'>";
    echo "<tr>
            <th>ID</th>
            <th>JMBG</th>
            <th>LBO</th>
            <th>Ime</th>
            <th>Prezime</th>
            <th>Datum rođenja</th>
            <th>Telefon</th>
          </tr>";

          while ($row = $result_pacijenti->fetch_assoc()) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['id']) . "</td>
                    <td>" . htmlspecialchars($row['jmbg']) . "</td>
                    <td>" . htmlspecialchars($row['lbo']) . "</td>
                    <td>" . htmlspecialchars($row['ime']) . "</td>
                    <td>" . htmlspecialchars($row['prezime']) . "</td>
                    <td>" . htmlspecialchars($row['datum_rodjenja']) . "</td>
                    <td>" . htmlspecialchars($row['telefon']) . "</td>
                    <td>
                        <a href='./brisanje_pacijenata.php?id=" . $row['id'] . "' onclick='return confirm(\"Da li ste sigurni da želite da obrišete ovog pacijenta?\")'>Obriši</a>
                    </td>
                  </tr>";
        }
    echo "</table>";
} else {
    echo "<p>Nema pacijenata u tabeli.</p>";
}


// Zatvaranje konekcije
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
        .form-container {
            text-align: center;
            margin-top: 20px;
        }
        .form-container form {
            display: inline-block;
            text-align: left;
        }
        .form-container label {
            display: block;
            margin: 5px 0;
        }
        .form-container input {
            width: 100%;
            padding: 5px;
            margin: 5px 0;
        }
        .form-container button {
            margin-top: 10px;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-top: 20px;">
        <a href="logout.php" class="btn btn-danger">Odjava</a>
    </div>

    <div class="form-container">
        <button onclick="toggleForm()">Unesi pacijenta</button>

        <form id="patient-form" style="display: none;" method="POST" action="unesi_pacijenta.php">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" required>

            <label for="jmbg">JMBG:</label>
            <input type="text" id="jmbg" name="jmbg" required>

            <label for="lbo">LBO:</label>
            <input type="text" id="lbo" name="lbo" required>

            <label for="ime">Ime:</label>
            <input type="text" id="ime" name="ime" required>

            <label for="prezime">Prezime:</label>
            <input type="text" id="prezime" name="prezime" required>

            <label for="datum_rodjenja">Datum rođenja:</label>
            <input type="date" id="datum_rodjenja" name="datum_rodjenja" required>

            <!-- <label for="pol">Pol:</label>
            <input type="radio" id="pol_m" name="pol" value="M" required> Muški
            <input type="radio" id="pol_z" name="pol" value="Ž" required> Ženski -->


            <label for="telefon">Telefon:</label>
            <input type="text" id="telefon" name="telefon" required>

            <button type="submit">Sačuvaj</button>
        </form>
    </div>

    <script>
        function toggleForm() {
            const form = document.getElementById('patient-form');
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>