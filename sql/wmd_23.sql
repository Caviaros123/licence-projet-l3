drop database if exists wmd_23;
CREATE database wmd_23;
use wmd_23;

-- Création de la table Catégories_Donnation
create table Cate_Don (
    id_catedon int AUTO_INCREMENT,
    Nom_Cate_Don varchar(255),
    Descrip_Cate_Don varchar(255),
    PRIMARY KEY (id_catedon)
);

-- Création de la table CategoriesProjets
CREATE TABLE Cate_Projets (
    id_cateproj int AUTO_INCREMENT,
    Nom_Cate_Proj VARCHAR(255),
    Descrip_Cate_Proj VARCHAR(255),
    PRIMARY KEY (id_cateproj)
);

--Création de la table AssociationCaritatif 
CREATE TABLE Asso_Carita (
    id_assocarita int AUTO_INCREMENT,
    Nom_Asso_Carita varchar(255),
    Descrip_Asso_Carita varchar(255),
    Pays_Asso_Carita VARCHAR(255),
    Adresse_Asso_Carita VARCHAR(255),
    Email_Asso_Carita VARCHAR(255),
    Objectif_Asso_Carita TEXT (2000),
    PRIMARY KEY (id_assocarita)
);

-- Création de la table ProjetsCaritatifs
CREATE TABLE Projets_Carita (
    id_projetcar INT AUTO_INCREMENT,
    Titre_P_Car VARCHAR(255),
    Descrip_P_Car VARCHAR(255),
    Date_Debut_P_Car DATE,
    Date_Fin_P_Car DATE,
    id_assocarita INT,
    id_cateproj INT,
    id_imagep INT,
    PRIMARY KEY (id_projecar),
    FOREIGN KEY (id_assocarita) REFERENCES Asso_Carita(id_assocarita),
    FOREIGN KEY (id_cateproj) REFERENCES Cate_Projets(id_cateproj),
    FOREIGN KEY (id_imagep) REFERENCES Images_P(id_imagep)
);

--Création de la table Image_P
Create table Images_P (
    id_imagep int AUTO_INCREMENT ,
    Nom_Image_P VARCHAR(255),
    Chemin_Image_P VARCHAR(255),
    id_projetcar INT,
    PRIMARY KEY (id_imagep),
    FOREIGN KEY (id_projetcar) REFERENCES Projets_Carita(id_projetcar)
);

-- Création de la table Roles
    create table Roles (
    id_role int AUTO_INCREMENT,
    Nom_Role varchar(255),
    PRIMARY KEY (id_role),
    UNIQUE (id_role)
);

-- Création de la table Utilisateurs
CREATE TABLE Utilisateurs (
    id_utilisateur INT AUTO_INCREMENT,
    Nom VARCHAR(255),
    Prenom VARCHAR(255),
    Email VARCHAR(255),
    Age, int (3),
    Mdp_Utilisateur VARCHAR(255),
    Telephone int (3),
    Date_Inscription DATE,
    id_role INT,
    PRIMARY KEY (id_utilisateur),
    FOREIGN KEY (id_role) REFERENCES Roles(id_role)
);



-- Création de la table Evenements
CREATE TABLE Evenements (
    id_evenement INT AUTO_INCREMENT ,
    Nom_Event VARCHAR(255),
    Descrip_Event VARCHAR(255),
    Date_Debut_Event DATE,
    Date_Fin_Event DATE,
    Lieu_Event VARCHAR(255),
    id_assocarita INT,
    id_imagep INT,
    PRIMARY KEY (id_evenement),
    FOREIGN KEY (id_assocarita) REFERENCES Asso_Carita(id_assocarita),
    FOREIGN KEY (id_imagep) REFERENCES Images_P(id_imagep)
);

-- Création de la table Séjours
CREATE TABLE Sejours (
    id_sejour INT AUTO_INCREMENT,
    Date_Debut_Sejour DATE,
    Nb_Places_Dispo_Sejour INT,
    Station_Sejour VARCHAR(255),
    Prix_Sejour DECIMAL(10, 2),
    PRIMARY KEY (id_sejour)
);

-- Création de la table Evaluations
CREATE TABLE Evaluations (
    id_evaluation INT AUTO_INCREMENT,
    id_sejour INT,
    Note INT not null,
    Commentaire VARCHAR(255) not null,
    Date_Evaluation DATE ,
    PRIMARY KEY (id_evaluation),
    FOREIGN KEY (id_sejour) REFERENCES Sejours(id_sejour)
);

-- Création de la table Reservations
CREATE TABLE Reservations (
    id_reservation INT AUTO_INCREMENT,
    id_sejour INT,
    id_utilisateur INT,
    Date_Reservation DATE,
    Nb_Personne INT,
    PRIMARY KEY (id_reservation),
    FOREIGN KEY (id_sejour) REFERENCES Sejours(id_sejour),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

-- Création de la table Paiements
create table Paiements (
    id_paiement int AUTO_INCREMENT,
    Montant_Paie decimal (10, 2),
    Date_Paie date,
    id_utilisateur int,
    id_donnation int,
    Mode_Paie varchar(255),
    Stat_Paie varchar(255),
    Ref_Paie varchar(255),
    PRIMARY KEY (id_paiement),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
    FOREIGN KEY (id_donnation) REFERENCES Donnations(id_donnation)
);

-- Création de la table Donnations
create table Donnations (
    id_donnation int AUTO_INCREMENT,
    Montant_Don decimal(10, 2),
    Date_Don date,
    id_utilisateur int,
    id_projet int,
    id_catedon int,
    id_imagep int,
    PRIMARY KEY (id_dnnation),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur),
    FOREIGN KEY (id_projecar) REFERENCES Projets_Carita(id_projetcar),
    FOREIGN KEY (id_catedon) REFERENCES Cate_Don (id_catedon),
    FOREIGN KEY (id_imagep) REFERENCES Images_P(id_imagep)
);

-- Création de la table Activités
CREATE TABLE Activites (
    id_activite INT AUTO_INCREMENT,
    Libelle_Activite VARCHAR(255),
    Nom_Station_Activite VARCHAR(255),
    Prix_Activite DECIMAL(10, 2),
    PRIMARY KEY (id_activite)
);

-- Création de la table Admin (la table enfant)
CREATE TABLE Admin (
    id_admin INT AUTO_INCREMENT,
    id_utilisateur INT,
    PRIMARY KEY (id_admin),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

-- Création de la table Responsable (la table enfant)
CREATE TABLE Responsable (
    id_responsable INT AUTO_INCREMENT,
    id_assocarita INT,
    id_utilisateur INT,
    PRIMARY KEY (id_responsable),
    FOREIGN KEY (id_utilisateur) REFERENCES Utilisateurs(id_utilisateur)
);

--[Donations] lorsqu une nouvelle donation est ajoutée,  un trigger pour mettre à jour automatiquement 
--le total des dons effectués par un utilisateur spécifique.

DELIMITER //
CREATE TRIGGER update_total_donations
AFTER INSERT ON Donnations
FOR EACH ROW
BEGIN
    -- l'ID de l'utilisateur qui a effectué le don
    DECLARE user_id INT;
    SELECT id_utilisateur INTO user_id FROM Donnations WHERE id_donnation = NEW.id_donnation;
    
    --  total des dons effectués par cet utilisateur
    UPDATE Utilisateurs
    SET Total_Dons = (
        SELECT SUM(Montant_Don)
        FROM Donnations
        WHERE id_utilisateur = user_id
    )
    WHERE id_utilisateur = user_id;
END;
//
DELIMITER ;

-- [Réservation] vérifier si le nombre de places disponibles en séjour est inférieur au nombre de personnes spécifié dans la réservation.

DELIMITER //
CREATE TRIGGER generate_invoice_number
BEFORE INSERT ON Paiements
FOR EACH ROW
BEGIN
    -- Générez un numéro de facture unique basé sur la date et l'heure actuelles
    SET NEW.Ref_Paie = CONCAT('F', DATE_FORMAT(NOW(), '%Y%m%d%H%i%s'));
END;
//
DELIMITER ;


-- [Utilsateur] vérifier les mail 
DELIMITER //
CREATE TRIGGER Verifier_Adresse_Email
BEFORE INSERT ON Utilisateurs
FOR EACH ROW
BEGIN
    DECLARE email_pattern VARCHAR(255);
    SET email_pattern = '^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+[.][A-Za-z]+$';

    IF NEW.Email NOT REGEXP email_pattern THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Adresse e-mail invalide : Veuillez fournir une adresse e-mail valide.';
    END IF;
END;
//
DELIMITER ;





--[Reservation]  : mettre à jour le nombre de places disponibles en séjour lorsque des réservations sont effectuée 
DELIMITER //
CREATE TRIGGER MiseAJour_Places_Disponibles
AFTER INSERT ON Reservations
FOR EACH ROW
BEGIN
    DECLARE sejour_id INT;
    DECLARE nb_personne INT;
    
    -- Obtenir l'ID du séjour associé à la réservation
    SELECT id_sejour INTO sejour_id FROM Reservations WHERE id_reservation = NEW.id_reservation;
    
    -- Obtenir le nombre de personnes de la réservation
    SELECT Nb_Personne INTO nb_personne FROM Reservations WHERE id_reservation = NEW.id_reservation;
    
    -- Mettre à jour le nombre de places disponibles en soustrayant le nombre de personnes de la réservation
    UPDATE Sejours
    SET Nb_Places_Dispo_Sejour = Nb_Places_Dispo_Sejour - nb_personne
    WHERE id_sejour = sejour_id;
END;
//
DELIMITER ;




