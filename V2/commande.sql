CREATE DATABASE emprunt;
USE emprunt;

CREATE TABLE s2_membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255),
    date_naissance DATE,
    genre ENUM('M', 'F'),
    email VARCHAR(100),
    ville VARCHAR(100),
    mdp VARCHAR(30),
    image_profil VARCHAR(100)
);

CREATE TABLE s2_categorie_objet (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(100)
);

CREATE TABLE s2_objet (
    id_objet INT PRIMARY KEY AUTO_INCREMENT,
    nom_objet VARCHAR(100),
    id_categorie INT,
    id_membre INT,
    FOREIGN KEY (id_categorie) REFERENCES s2_categorie_objet(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES s2_membre(id_membre)
);

CREATE TABLE s2_image_objet (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    nom_image VARCHAR(100),
    FOREIGN KEY (id_objet) REFERENCES s2_objet(id_objet)
);

CREATE TABLE s2_emprunt (
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
    id_objet INT,
    id_membre INT,
    date_emprunt DATE,
    date_retour DATE,
    FOREIGN KEY (id_objet) REFERENCES s2_objet(id_objet),
    FOREIGN KEY (id_membre) REFERENCES s2_membre(id_membre)
);


CREATE OR REPLACE VIEW v_s2_objet AS
SELECT co.id_categorie, co.nom_categorie, o.id_objet, o.nom_objet, o.id_membre
FROM s2_categorie_objet co
JOIN s2_objet o ON co.id_categorie = o.id_categorie
ORDER BY o.id_objet;

INSERT INTO s2_membre (id_membre, nom, date_naissance, genre, email, ville, mdp, image_profil) VALUES
(1, 'Alice', '1990-05-10', 'F', 'alice@example.com', 'Antananarivo', 'pass1', 'alice.jpg'),
(2, 'Bob', '1985-08-22', 'M', 'bob@example.com', 'Fianarantsoa', 'pass2', 'bob.jpg'),
(3, 'Charlie', '1993-11-02', 'M', 'charlie@example.com', 'Tamatave', 'pass3', 'charlie.jpg'),
(4, 'Diana', '2000-03-15', 'F', 'diana@example.com', 'Majunga', 'pass4', 'diana.jpg');

INSERT INTO s2_categorie_objet (id_categorie, nom_categorie) VALUES
(1, 'esthétique'),
(2, 'bricolage'),
(3, 'mécanique'),
(4, 'cuisine');

INSERT INTO s2_objet (id_objet, nom_objet, id_categorie, id_membre) VALUES
-- Objets d'Alice (id_membre = 1)
(1, 'Sèche-cheveux', 1, 1),
(2, 'Mascara', 1, 1),
(3, 'Tournevis', 2, 1),
(4, 'Marteau', 2, 1),
(5, 'Clé à molette', 3, 1),
(6, 'Pompe à vélo', 3, 1),
(7, 'Mixeur', 4, 1),
(8, 'Poêle', 4, 1),
(9, 'Fouet', 4, 1),
(10, 'Lime à ongles', 1, 1),

-- Objets de Bob (id_membre = 2)
(11, 'Perceuse', 2, 2),
(12, 'Ponceuse', 2, 2),
(13, 'Crème visage', 1, 2),
(14, 'Fer à lisser', 1, 2),
(15, 'Jack hydraulique', 3, 2),
(16, 'Clé dynamométrique', 3, 2),
(17, 'Casserole', 4, 2),
(18, 'Four micro-ondes', 4, 2),
(19, 'Cuillère en bois', 4, 2),
(20, 'Shampooing', 1, 2),

-- Objets de Charlie (id_membre = 3)
(21, 'Tournevis électrique', 2, 3),
(22, 'Rasoir', 1, 3),
(23, 'Compresseur', 3, 3),
(24, 'Clé Allen', 3, 3),
(25, 'Robot de cuisine', 4, 3),
(26, 'Batteur', 4, 3),
(27, 'Mascara waterproof', 1, 3),
(28, 'Scie', 2, 3),
(29, 'Marmite', 4, 3),
(30, 'Pinceau maquillage', 1, 3),

-- Objets de Diana (id_membre = 4)
(31, 'Tournevis plat', 2, 4),
(32, 'Pied-de-biche', 2, 4),
(33, 'Ciseaux', 1, 4),
(34, 'Crayon à sourcils', 1, 4),
(35, 'Frein à disque', 3, 4),
(36, 'Boulonneuse', 3, 4),
(37, 'Moulinette', 4, 4),
(38, 'Balance de cuisine', 4, 4),
(39, 'Spatule', 4, 4),
(40, 'Blender', 4, 4);

INSERT INTO s2_image_objet (id_image, id_objet, nom_image) VALUES
(1, 1, 'seche.jpg'),
(2, 11, 'perceuse.jpg'),
(3, 25, 'robot.jpg'),
(4, 33, 'ciseaux.jpg'),
(5, 40, 'blender.jpg');

INSERT INTO s2_emprunt (id_emprunt, id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 1, 2, '2025-07-01', '2025-07-07'),
(2, 11, 1, '2025-07-03', '2025-07-10'),
(3, 25, 2, '2025-07-05', '2025-07-12'),
(4, 33, 3, '2025-07-06', '2025-09-12'),
(5, 5, 4, '2025-07-01', '2025-07-04'),
(6, 6, 2, '2025-07-02', '2025-07-20'),
(7, 15, 1, '2025-07-04', '2025-08-12'),
(8, 20, 3, '2025-07-08', '2025-07-11'),
(9, 38, 1, '2025-07-09', '2025-10-12'),
(10, 3, 4, '2025-07-10', '2025-07-29');

INSERT INTO s2_emprunt (id_emprunt, id_objet, id_membre, date_emprunt, date_retour) VALUES
(1, 1, 2, '2025-07-01', '2025-07-20');
UPDATE s2_emprunt
SET date_retour = now()
WHERE date_retour IS NULL;
