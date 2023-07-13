<!DOCTYPE html>

<!DOCTYPE html>

#Ma base de données : 
DROP DATABASE IF EXISTS projet;
CREATE DATABASE IF NOT EXISTS projet;
USE projet;
DROP TABLE IF EXISTS Formateur;
CREATE TABLE Formateur(
        id_formateur     Integer(11) AUTO_INCREMENT,
        nom_formateur     Varchar (50),
        prenom_formateur     Varchar (50),
        dtn_formateur     Date,
        mdp_formateur     Varchar (50),
        email_formateur     Varchar (50),
        specialite    Varchar (50),
        PRIMARY KEY (id_formateur)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS Eleve;
CREATE TABLE Eleve(
        id_eleve    Integer(25) AUTO_INCREMENT,
        nom_eleve     Varchar (50),
        prenom_eleve     Varchar (50),
        dtn_eleve     Date ,
        mdp_eleve     Varchar (25),
        niveauEtude     Varchar (50),
        PRIMARY KEY (id_eleve)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS Message;
CREATE TABLE Message(
        id_message     Integer (50) AUTO_INCREMENT,
        date_envoi     Date ,
        date_reçoit     Date ,
        contenu     Varchar (50),
        fichier_joint     Blob (50),
        type_implicationElv_envoyer     Varchar (50),
        id_eleve_Eleve     Integer (25),
        type_implicationForm_envoi     Varchar (50),
        id_formateur_Formateur     Integer (11),
        PRIMARY KEY (id_message)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS Reclamation;
CREATE TABLE Reclamation(
        id_reclamation     Integer (25) AUTO_INCREMENT,
        objet     Varchar (25),
        mesg_reclamation     Text (500),
        id_formateur_Formateur     Integer (11),
        PRIMARY KEY (id_reclamation)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS CoursSoutien;
CREATE TABLE CoursSoutien(
        id_cours     Integer (25) AUTO_INCREMENT,
        titre_cours     Varchar (50),
        niveau     Varchar (50),
        id_matiere_Matiere     Integer (25),
        id_formateur_Formateur     Integer (11),
        PRIMARY KEY (id_cours)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS visio_conference;
CREATE TABLE visio_conference(
        num_seance     Integer (25) AUTO_INCREMENT,
        nom_seance     Varchar (50),
        date_seance     Date,
        heure_seance     Time,
        duree     Varchar (25),
        lien     Blob (25),
        id_cours_CoursSoutien     Integer (25),
        PRIMARY KEY (num_seance)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS Matiere;
CREATE TABLE Matiere(
        id_matiere     Integer (25) AUTO_INCREMENT,
        libelle_matiere     Varchar (50),
        PRIMARY KEY (id_matiere)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS Document;
CREATE TABLE Document(
        id_doc     Integer (25) AUTO_INCREMENT,
        libelle_doc     Varchar (50),
        type_doc     Varchar (50),
        dateDepot     Date ,
        pieceJoint     Blob,
        PRIMARY KEY (id_doc)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS contenu;
CREATE TABLE contenu(
        id_cours_CoursSoutien     Integer (25) ,
        id_doc_Document     Integer (25) ,
        PRIMARY KEY (id_cours_CoursSoutien,id_doc_Document)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS assistance;
CREATE TABLE assistance(
        num_seance_visio_conference     Integer (25),
        id_eleve_Eleve     Integer (25),
        PRIMARY KEY (num_seance_visio_conference,id_eleve_Eleve)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS envoie;
CREATE TABLE envoie(
        id_eleve_Eleve     Integer (25),
        id_reclamation_Reclamation     Integer (25),
        PRIMARY KEY (id_eleve_Eleve,id_reclamation_Reclamation)
)ENGINE=InnoDB;


CREATE DATABASE IF NOT EXISTS projet;
USE projet;
DROP TABLE IF EXISTS enseigne;
CREATE TABLE enseignement(
        id_eleve_Eleve     Integer (25),
        id_formateur_Formateur     Integer (11),
        PRIMARY KEY (id_eleve_Eleve,id_formateur_Formateur)
)ENGINE=InnoDB;



DROP TABLE IF EXISTS insription;
CREATE TABLE inscription(
        id_cours_CoursSoutien     Integer (25),
        id_eleve_Eleve     Integer (25),
        PRIMARY KEY (id_cours_CoursSoutien,id_eleve_Eleve)
)ENGINE=InnoDB;



ALTER TABLE Message ADD CONSTRAINT FK_Message_id_eleve_Eleve FOREIGN KEY (id_eleve_Eleve) REFERENCES Eleve(id_eleve);
ALTER TABLE Message ADD CONSTRAINT FK_Message_id_formateur_Formateur FOREIGN KEY (id_formateur_Formateur) REFERENCES Formateur(id_formateur);
ALTER TABLE Reclamation ADD CONSTRAINT FK_Reclamation_id_formateur_Formateur FOREIGN KEY (id_formateur_Formateur) REFERENCES Formateur(id_formateur);
ALTER TABLE CoursSoutien ADD CONSTRAINT FK_CoursSoutien_id_matiere_Matiere FOREIGN KEY (id_matiere_Matiere) REFERENCES Matiere(id_matiere);
ALTER TABLE CoursSoutien ADD CONSTRAINT FK_CoursSoutien_id_formateur_Formateur FOREIGN KEY (id_formateur_Formateur) REFERENCES Formateur(id_formateur);
ALTER TABLE visio_conference ADD CONSTRAINT FK_visio_conference_id_cours_CoursSoutien FOREIGN KEY (id_cours_CoursSoutien) REFERENCES CoursSoutien(id_cours);
ALTER TABLE contenu ADD CONSTRAINT FK_contenu_id_cours_CoursSoutien FOREIGN KEY (id_cours_CoursSoutien) REFERENCES CoursSoutien(id_cours);
ALTER TABLE contenu ADD CONSTRAINT FK_contenu_id_doc_Document FOREIGN KEY (id_doc_Document) REFERENCES Document(id_doc);
ALTER TABLE assistance ADD CONSTRAINT FK_assistance_num_seance_visio_conference FOREIGN KEY (num_seance_visio_conference) REFERENCES visio_conference(num_seance);
ALTER TABLE assistance ADD CONSTRAINT FK_assistance_id_eleve_Eleve FOREIGN KEY (id_eleve_Eleve) REFERENCES Eleve(id_eleve);
ALTER TABLE envoie ADD CONSTRAINT FK_envoie_id_eleve_Eleve FOREIGN KEY (id_eleve_Eleve) REFERENCES Eleve(id_eleve);
ALTER TABLE envoie ADD CONSTRAINT FK_envoie_id_reclamation_Reclamation FOREIGN KEY (id_reclamation_Reclamation) REFERENCES Reclamation(id_reclamation);
ALTER TABLE enseignement ADD CONSTRAINT FK_enseignement_id_eleve_Eleve FOREIGN KEY (id_eleve_Eleve) REFERENCES Eleve(id_eleve);
ALTER TABLE enseignement ADD CONSTRAINT FK_enseignement_id_formateur_Formateur FOREIGN KEY (id_formateur_Formateur) REFERENCES Formateur(id_formateur);
ALTER TABLE inscription ADD CONSTRAINT FK_inscription_id_cours_CoursSoutien FOREIGN KEY (id_cours_CoursSoutien) REFERENCES CoursSoutien(id_cours);
ALTER TABLE inscription ADD CONSTRAINT FK_inscription_id_eleve_Eleve FOREIGN KEY (id_el