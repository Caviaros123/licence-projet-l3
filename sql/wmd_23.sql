-- Supprimer la base de données si elle existe
DROP DATABASE IF EXISTS wmd_23;

-- Créer la base de données wmd_23
CREATE DATABASE wmd_23;

-- Utiliser la base de données wmd_23
USE wmd_23;

-- Création de la table Catégories_Donnation
CREATE TABLE cate_don (
    id_catedon INT AUTO_INCREMENT,
    nom_cate_don VARCHAR(255),
    descrip_cate_don VARCHAR(255),
    PRIMARY KEY (id_catedon)
);

-- Création de la table CategoriesProjets
CREATE TABLE cate_projets (
    id_cateproj INT AUTO_INCREMENT,
    nom_cate_proj VARCHAR(255),
    descrip_cate_proj VARCHAR(255),
    PRIMARY KEY (id_cateproj)
);

-- Création de la table AssociationCaritatif
CREATE TABLE asso_carita (
    id_assocarita INT AUTO_INCREMENT,
    nom_asso_carita VARCHAR(255),
    descrip_asso_carita VARCHAR(255),
    pays_asso_carita VARCHAR(255),
    adresse_asso_carita VARCHAR(255),
    email_asso_carita VARCHAR(255),
    objectif_asso_carita TEXT (2000),
    PRIMARY KEY (id_assocarita)
);

-- Création de la table ProjetsCaritatifs
CREATE TABLE projets_carita (
    id_projetcar INT AUTO_INCREMENT,
    titre_p_car VARCHAR(255),
    descrip_p_car VARCHAR(255),
    date_debut_p_car DATE,
    date_fin_p_car DATE,
    id_assocarita INT,
    id_cateproj INT,
    id_imagep INT,
    PRIMARY KEY (id_projetcar),
    FOREIGN KEY (id_assocarita) REFERENCES asso_carita(id_assocarita),
    FOREIGN KEY (id_cateproj) REFERENCES cate_projets(id_cateproj)
);

-- Création de la table Image_P
CREATE TABLE images_p (
    id_imagep INT AUTO_INCREMENT,
    nom_image_p VARCHAR(255),
    chemin_image_p VARCHAR(255),
    id_projetcar INT,
    PRIMARY KEY (id_imagep),
    FOREIGN KEY (id_projetcar) REFERENCES projets_carita(id_projetcar)
);
-- Alter Table sur la Table Projets_carita
ALTER TABLE projets_carita
ADD FOREIGN KEY (id_imagep) REFERENCES images_p(id_imagep);

-- Création de la table Roles
CREATE TABLE roles (
    id_role INT AUTO_INCREMENT,
    nom_role VARCHAR(255),
    PRIMARY KEY (id_role),
    UNIQUE (id_role)
);

-- Création de la table Utilisateurs
CREATE TABLE utilisateurs (
    id_utilisateur INT AUTO_INCREMENT,
    nom VARCHAR(255),
    prenom VARCHAR(255),
    email VARCHAR(255) UNIQUE NOT NULL,
    age INT,
    mdp_utilisateur VARCHAR(255),
    telephone VARCHAR(255) UNIQUE NOT NULL,
    date_inscription DATETIME,
    id_role INT,
    PRIMARY KEY (id_utilisateur),
    FOREIGN KEY (id_role) REFERENCES roles(id_role)
);

-- Création de la table Evenements
CREATE TABLE evenements (
    id_evenement INT AUTO_INCREMENT,
    nom_event VARCHAR(255),
    descrip_event VARCHAR(255),
    date_debut_event DATE,
    date_fin_event DATE,
    lieu_event VARCHAR(255),
    id_assocarita INT,
    id_imagep INT,
    PRIMARY KEY (id_evenement),
    FOREIGN KEY (id_assocarita) REFERENCES asso_carita(id_assocarita),
    FOREIGN KEY (id_imagep) REFERENCES images_p(id_imagep)
);

-- Création de la table Séjours
CREATE TABLE sejours (
    id_sejour INT AUTO_INCREMENT,
    date_debut_sejour DATE,
    nb_places_dispo_sejour INT,
    station_sejour VARCHAR(255),
    prix_sejour DECIMAL(10, 2),
    PRIMARY KEY (id_sejour)
);

-- Création de la table Evaluations
CREATE TABLE evaluations (
    id_evaluation INT AUTO_INCREMENT,
    id_sejour INT,
    id_utilisateur INT,
    note INT NOT NULL,
    commentaire VARCHAR(255) NOT NULL,
    date_evaluation DATE,
    PRIMARY KEY (id_evaluation),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_sejour) REFERENCES sejours(id_sejour)
);

-- Création de la table Reservations
CREATE TABLE reservations (
    id_reservation INT AUTO_INCREMENT,
    id_sejour INT,
    id_utilisateur INT,
    date_reservation DATE,
    nb_personne INT,
    PRIMARY KEY (id_reservation),
    FOREIGN KEY (id_sejour) REFERENCES sejours(id_sejour),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

-- Création de la table Paiements
CREATE TABLE paiements (
    id_paiement INT AUTO_INCREMENT,
    montant_paie DECIMAL (10, 2),
    date_paie DATE,
    id_utilisateur INT,
    id_donnation INT,
    mode_paie VARCHAR(255),
    stat_paie VARCHAR(255),
    ref_paie VARCHAR(255),
    PRIMARY KEY (id_paiement),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

-- Création de la table Donnations
CREATE TABLE donnations (
    id_donnation INT AUTO_INCREMENT,
    montant_don DECIMAL(10, 2),
    date_don DATE,
    id_utilisateur INT,
    id_projetcar INT,
    id_catedon INT,
    id_imagep INT,
    PRIMARY KEY (id_donnation),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur),
    FOREIGN KEY (id_projetcar) REFERENCES projets_carita(id_projetcar),
    FOREIGN KEY (id_catedon) REFERENCES cate_don (id_catedon),
    FOREIGN KEY (id_imagep) REFERENCES images_p(id_imagep)
);

-- Rajouter dans la table paiements la clé étrangère de la table donnation -- 
ALTER TABLE paiements
ADD FOREIGN KEY (id_donnation) REFERENCES donnations(id_donnation);


-- Création de la table Activités
CREATE TABLE activites (
    id_activite INT AUTO_INCREMENT,
    libelle_activite VARCHAR(255),
    nom_station_activite VARCHAR(255),
    prix_activite DECIMAL(10, 2),
    PRIMARY KEY (id_activite)
);

-- Création de la table Admin (la table enfant)
CREATE TABLE admin (
    id_admin INT AUTO_INCREMENT,
    id_utilisateur INT,
    PRIMARY KEY (id_admin),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

-- Création de la table Responsable (la table enfant)
CREATE TABLE responsable (
    id_responsable INT AUTO_INCREMENT,
    id_assocarita INT,
    id_utilisateur INT,
    PRIMARY KEY (id_responsable),
    FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs(id_utilisateur)
);

-- Création de la table Activités_Séjours
CREATE TABLE activites_sejours (
    id_activite INT,
    id_sejour INT,
    PRIMARY KEY (id_activite, id_sejour),
    FOREIGN KEY (id_activite) REFERENCES activites(id_activite),
    FOREIGN KEY (id_sejour) REFERENCES sejours(id_sejour)
);


--- Insert table Sejour ---
INSERT INTO sejours (date_debut_sejour, nb_places_dispo_sejour, station_sejour, prix_sejour)
VALUES
    ('2023-01-01', 10, 'Station A', 500.00),
    ('2023-02-02', 5, 'Station B', 300.50),
    ('2024-03-03', 8, 'Station C', 150.75),
    ('2023-04-04', 12, 'Station D', 299.99),
    ('2023-05-05', 4, 'Station E', 138.00),
    ('2023-06-06', 2, 'Station F', 284.00),
    ('2023-07-07', 20, 'Station G', 123.56),
    ('2023-08-08', 17, 'Station H', 218.40);

INSERT INTO evaluations (id_sejour, id_utilisateur, note, commentaire, date_evaluation) 
VALUES 
(1, 1, 4, 'Très bon séjour !', '2023-12-15'),
(2, 2, 5, 'Expérience formidable.', '2023-12-16'),
(3, 3, 3, 'Peut être amélioré.', '2023-12-17');


-- Inséret table rôles --
INSERT INTO roles (nom_role) VALUES ('Utilisateur');

INSERT INTO roles (nom_role) VALUES ('Invité');

INSERT INTO roles (nom_role) VALUES ('Modérateur');

--Insert utilisateurs --
INSERT INTO utilisateurs (nom, prenom, email, age, mdp_utilisateur, telephone, date_inscription, id_role)
VALUES ('Doe', 'John', 'john.doe@example.com', 30, 'motdepasse123', '123456789', NOW(), 1);

-- Insérer un autre utilisateur --
INSERT INTO utilisateurs (nom, prenom, email, age, mdp_utilisateur, telephone, date_inscription, id_role)
VALUES ('Smith', 'Jane', 'jane.smith@example.com', 25, 'mdp456', '987654321', NOW(), 2);

-- Insérer un troisième utilisateur --
INSERT INTO utilisateurs (nom, prenom, email, age, mdp_utilisateur, telephone, date_inscription, id_role)
VALUES ('Martin', 'Luc', 'luc.martin@example.com', 40, 'monmotdepasse', '5551234567', NOW(), 1);

-- Insérer un asso_carita --
INSERT INTO asso_carita (nom_asso_carita, descrip_asso_carita, pays_asso_carita, adresse_asso_carita, email_asso_carita, objectif_asso_carita)
VALUES
    ('Association caritative 1', 'Description Association caritative 1.', 'Pays Association caritative 1', 'Adresse Association caritative 1', 'mail@Association caritative 1', 'Objectif Association caritative 1.'),
    ('Association caritative 2', 'Description Association caritative 2.', 'Pays Association caritative 2', 'Adresse Association caritative 2', 'mail@Association caritative 2', 'Objectif Association caritative 2.'),
    ('Association caritative 3', 'Description Association caritative 3.', 'Pays Association caritative 3', 'Adresse Association caritative 3', 'mail@Association caritative 3', 'Objectif Association caritative 3.'),
    ('Association caritative 4', 'Description Association caritative 4.', 'Pays Association caritative 4', 'Adresse Association caritative 4', 'mail@Association caritative 4', 'Objectif Association caritative 4.'),
    ('Association caritative 5', 'Description Association caritative 5.', 'Pays Association caritative 5', 'Adresse Association caritative 5', 'mail@Association caritative 5', 'Objectif Association caritative 5.');

-- Inserer cate_don --
 INSERT INTO cate_don (nom_cate_don, descrip_cate_don) VALUES
('Annuels','Ce type de donnation s effectue tout les ans');

INSERT INTO cate_don (nom_cate_don, descrip_cate_don) VALUES
('Mensuelle','Ce type de donnatin s effectue tout les mois');


--insert Activités-- 

INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité A1', 'Station A', 50.00);

-- Pour Station B
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité B1', 'Station B', 70.00);

-- Pour Station C
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité C1', 'Station C', 45.00);

-- Pour Station D
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité D1', 'Station D', 80.00);

-- Pour Station E
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité E1', 'Station E', 90.00);

-- Pour Station F
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité F1', 'Station F', 100.00);

-- Pour Station G
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité G1', 'Station G', 35.00);

-- Pour Station H
INSERT INTO activites (libelle_activite, nom_station_activite, prix_activite) VALUES
('Activité H1', 'Station H', 125.00);

--Inserer activite_sejours--
 INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(1, 1);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(2, 2);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(3, 3);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(4, 4);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(5, 5);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(6, 6);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(7, 7);

INSERT INTO activites_sejours (id_activite, id_sejour) VALUES
(8, 8);


--Insert cate_projets--

-- Aide humanitaire d'urgence
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet1', 'Description1.');

-- Éducation
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet2', 'Description2.');

-- Santé
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet3', 'Description3.');

-- Alimentation et agriculture
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet4', 'Description4.');

-- Eau et assainissement
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet5', 'Description5')
-- Logement
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet6', 'Categorie Projet6.');

-- Développement économique
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet7', 'Categorie Projet7.');

-- Droits de l'homme
INSERT INTO cate_projets (nom_cate_proj, descrip_cate_proj) VALUES
('Categorie Projet8', 'Categorie Projet8.');



--Insert evenement

    INSERT INTO evenements (nom_event, descrip_event, date_debut_event, date_fin_event, lieu_event, id_assocarita, id_imagep) VALUES
    ('Event1', 'Description Event1', '2001-01-01', '2001-02-02', 'Lieu Event1', 1, null);

    INSERT INTO evenements (nom_event, descrip_event, date_debut_event, date_fin_event, lieu_event, id_assocarita, id_imagep) VALUES
    ('Event2', 'Description Event2', '2001-03-03', '2001-04-04', 'Lieu Event2', 2, null);

    INSERT INTO evenements (nom_event, descrip_event, date_debut_event, date_fin_event, lieu_event, id_assocarita, id_imagep) VALUES
    ('Event3', 'Description Event3', '2001-05-05', '2001-06-06', 'Lieu Event3', 3, null);

    INSERT INTO evenements (nom_event, descrip_event, date_debut_event, date_fin_event, lieu_event, id_assocarita, id_imagep) VALUES
    ('Event4', 'Description Event4', '2001-07-07', '2001-08-08', 'Lieu Event4', 4, null);

    INSERT INTO evenements (nom_event, descrip_event, date_debut_event, date_fin_event, lieu_event, id_assocarita, id_imagep) VALUES
    ('Event5', 'Description Event5', '2001-09-09', '2001-10-10', 'Lieu Event5', 5, null);




--Insert projet_carita

INSERT INTO projets_carita (titre_p_car, descrip_p_car, date_debut_p_car, date_fin_p_car, id_assocarita, id_cateproj, id_imagep) VALUES
('Projet Carita1', 'Description Projet Carita1', '2002-01-01', '2002-02-02', 1, 1, null);

INSERT INTO projets_carita (titre_p_car, descrip_p_car, date_debut_p_car, date_fin_p_car, id_assocarita, id_cateproj, id_imagep) VALUES
('Projet Carita2', 'Description Projet Carita2', '2002-03-03', '2002-04-04', 2, 2, null);

INSERT INTO projets_carita (titre_p_car, descrip_p_car, date_debut_p_car, date_fin_p_car, id_assocarita, id_cateproj, id_imagep) VALUES
('Projet Carita3', 'Description Projet Carita3', '2002-05-05', '2002-06-06', 3, 3, null);

INSERT INTO projets_carita (titre_p_car, descrip_p_car, date_debut_p_car, date_fin_p_car, id_assocarita, id_cateproj, id_imagep) VALUES
('Projet Carita4', 'Description Projet Carita4', '2002-07-07', '2002-08-08', 4, 4, null);

INSERT INTO projets_carita (titre_p_car, descrip_p_car, date_debut_p_car, date_fin_p_car, id_assocarita, id_cateproj, id_imagep) VALUES
('Projet Carita5', 'Description Projet Carita5', '2002-09-09', '2002-10-10', 5, 5, null);


--Insert reservations
INSERT INTO reservations (id_sejour, id_utilisateur, date_reservation, nb_personne) VALUES
(1, 1, '2004-01-01', 5);

INSERT INTO reservations (id_sejour, id_utilisateur, date_reservation, nb_personne) VALUES
(2, 2, '2004-02-02', 3);

INSERT INTO reservations (id_sejour, id_utilisateur, date_reservation, nb_personne) VALUES
(3, 3, '2004-02-03', 4);



--[Donations] lorsqu'une nouvelle donation est ajoutée, un trigger pour mettre à jour automatiquement
--le total des dons effectués par un utilisateur spécifique.

DELIMITER //
CREATE TRIGGER update_total_donations
AFTER INSERT ON donnations
FOR EACH ROW
BEGIN
    -- l'ID de l'utilisateur qui a effectué le don
    DECLARE user_id INT;
    SELECT id_utilisateur INTO user_id FROM donnations WHERE id_donnation = NEW.id_donnation;
    
    -- total des dons effectués par cet utilisateur
    UPDATE utilisateurs
    SET total_dons = (
        SELECT SUM(montant_don)
        FROM donnations
        WHERE id_utilisateur = user_id
    )
    WHERE id_utilisateur = user_id;
END;
//
DELIMITER ;

-- [Réservation] vérifier si le nombre de places disponibles en séjour est inférieur au nombre de personnes spécifié dans la réservation.

DELIMITER //
CREATE TRIGGER generate_invoice_number
BEFORE INSERT ON paiements
FOR EACH ROW
BEGIN
    -- Générez un numéro de facture unique basé sur la date et l'heure actuelles
    SET NEW.ref_paie = CONCAT('F', DATE_FORMAT(NOW(), '%Y%m%d%H%i%s'));
END;
//
DELIMITER ;

-- [Utilisateur] vérifier les mails 
DELIMITER //
CREATE TRIGGER verifier_adresse_email
BEFORE INSERT ON utilisateurs
FOR EACH ROW
BEGIN
    DECLARE email_pattern VARCHAR(255);
    SET email_pattern = '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$';

    IF NEW.email NOT REGEXP email_pattern THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Adresse e-mail invalide : Veuillez fournir une adresse e-mail valide.';
    END IF;
END;
//
DELIMITER ;

--[Reservation] : mettre à jour le nombre de places disponibles en séjour lorsque des réservations sont effectuées
DELIMITER //
CREATE TRIGGER miseajour_places_disponibles
AFTER INSERT ON reservations
FOR EACH ROW
BEGIN
    DECLARE sejour_id INT;
    DECLARE nb_personne INT;
    
    -- Obtenir l'ID du séjour associé à la réservation
    SELECT id_sejour INTO sejour_id FROM reservations WHERE id_reservation = NEW.id_reservation;
    
    -- Obtenir le nombre de personnes de la réservation
    SELECT nb_personne INTO nb_personne FROM reservations WHERE id_reservation = NEW.id_reservation;
    
    -- Mettre à jour le nombre de places disponibles en soustrayant le nombre de personnes de la réservation
    UPDATE sejours
    SET nb_places_dispo_sejour = nb_places_dispo_sejour - nb_personne
    WHERE id_sejour = sejour_id;
END;
//
DELIMITER ;

--[Reservation] : mettre à jour le nombre de places disponibles en séjour lorsque des réservations sont supprimées
DELIMITER //
CREATE TRIGGER miseajour_places_disponibles_suppression
AFTER DELETE ON reservations
FOR EACH ROW
BEGIN
    DECLARE sejour_id INT;
    DECLARE nb_personne INT;
    
    -- Obtenir l'ID du séjour associé à la réservation
    SELECT id_sejour INTO sejour_id FROM reservations WHERE id_reservation = OLD.id_reservation;
    
    -- Obtenir le nombre de personnes de la réservation
    SELECT nb_personne INTO nb_personne FROM reservations WHERE id_reservation = OLD.id_reservation;
    
    -- Mettre à jour le nombre de places disponibles en ajoutant le nombre de personnes de la réservation
    UPDATE sejours
    SET nb_places_dispo_sejour = nb_places_dispo_sejour + nb_personne
    WHERE id_sejour = sejour_id;
END;
//
DELIMITER ;


-- [Donation] : mettre à jour le montant total des dons effectués par un utilisateur spécifique lorsqu'une donation est supprimée
DELIMITER //
CREATE TRIGGER miseajour_total_dons
AFTER DELETE ON donnations
FOR EACH ROW
BEGIN
    DECLARE user_id INT;
    DECLARE montant_don DECIMAL(10, 2);
    
    -- Obtenir l'ID de l'utilisateur qui a effectué la donation
    SELECT id_utilisateur INTO user_id FROM donnations WHERE id_donnation = OLD.id_donnation;
    
    -- Obtenir le montant de la donation
    SELECT montant_don INTO montant_don FROM donnations WHERE id_donnation = OLD.id_donnation;
    
    -- Mettre à jour le montant total des dons en soustrayant le montant de la donation
    UPDATE utilisateurs
    SET total_dons = total_dons - montant_don
    WHERE id_utilisateur = user_id;
END;
//
DELIMITER ;
