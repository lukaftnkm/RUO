CREATE TABLE doktori (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(100) NOT NULL,
    prezime VARCHAR(100) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    specijalizacija VARCHAR(255),
    datum_rodjenja DATE
);
<<<<<<< HEAD

=======
 
>>>>>>> 340ce3f8957433a8f52444d4d2d3b796cd4d23e6
INSERT INTO doktori (ime, prezime, email, password, specijalizacija, datum_rodjenja) 
VALUES
('Luka', 'Djelosevic', 'luka.djelosevic@gmail.com', 'fakultet', 'Kardiologija', '2002-06-16'),
('Dusan', 'Kasalovic', 'dusan.kasalovic@gmail.com', 'fakultet', 'Pediatrija', '2002-08-18'),
('Marko', 'Radivojevic', 'marko.radivojevic@gmail.com', 'fakultet', 'Hirurgija', '2003-01-14');
<<<<<<< HEAD

=======
>>>>>>> 340ce3f8957433a8f52444d4d2d3b796cd4d23e6
