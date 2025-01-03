CREATE TABLE doktori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(100) NOT NULL,
    prezime VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    specijalizacija VARCHAR(255),
    datum_rodjenja DATE
);

INSERT INTO doktori (ime, prezime, email, password, specijalizacija, datum_rodjenja) 
VALUES
('Luka', 'Djelosevic', 'luka.djelosevic@gmail.com', 'fakultet', 'Kardiologija', '2002-06-16'),
('Dusan', 'Kasalovic', 'dusan.kasalovic@gmail.com', 'fakultet', 'Pediatrija', '2002-08-18'),
('Marko', 'Radivojevic', 'marko.radivojevic@gmail.com', 'fakultet', 'Hirurgija', '2003-01-14');


-- tabela pacijenata


CREATE TABLE pacijenti (
    id INT PRIMARY KEY UNIQUE,
    jmbg VARCHAR(13) UNIQUE NOT NULL,
    lbo VARCHAR(8) UNIQUE NOT NULL,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    datum_rodjenja DATE NOT NULL,
    -- pol ENUM('M', 'Ž') NOT NULL,
    telefon VARCHAR(15) UNIQUE NOT NULL CHECK (telefon LIKE '+381%')
);
