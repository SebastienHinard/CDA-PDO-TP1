#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: Services
#------------------------------------------------------------

CREATE TABLE Services(
        id          Int  Auto_increment  NOT NULL ,
        name        Varchar (50) NOT NULL ,
        description Varchar (100) NOT NULL
	,CONSTRAINT Services_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: Users
#------------------------------------------------------------

CREATE TABLE Users(
        id          Int  Auto_increment  NOT NULL ,
        lastname    Varchar (50) NOT NULL ,
        firstname   Varchar (50) NOT NULL ,
        birthdate   Date NOT NULL ,
        address     Text NOT NULL ,
        zipcode     Varchar (5) NOT NULL ,
        phone       Varchar (10) NOT NULL ,
        service     Int NOT NULL ,
        id_Services Int NOT NULL
	,CONSTRAINT Users_PK PRIMARY KEY (id)

	,CONSTRAINT Users_Services_FK FOREIGN KEY (id_Services) REFERENCES Services(id)
)ENGINE=InnoDB;

