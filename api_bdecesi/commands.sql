CREATE TABLE T_USERS (
    USE_id INT AUTO_INCREMENT NOT NULL,
    USE_username VARCHAR(50) NOT NULL,
    USE_password VARCHAR(60) NOT NULL,
    USE_email VARCHAR(180) NOT NULL,
    USE_description TEXT,
    USE_created_at TIMESTAMP,
    USE_updated_at TIMESTAMP,
    
    PIC_id INT NOT NULL,
    SPE_id INT NOT NULL,
    CAM_id INT NOT NULL,
    ROL_id INT NOT NULL,
    
    PRIMARY KEY (USE_id),
    FOREIGN KEY (PIC_id) REFERENCES T_PICTURES(PIC_id),
    FOREIGN KEY (SPE_id) REFERENCES T_SPECIALITIES(SPE_id),
    FOREIGN KEY (CAM_id) REFERENCES T_CAMPUS(CAM_id),
    FOREIGN KEY (ROL_id) REFERENCES T_ROLES(ROL_id)
);

CREATE TABLE T_PICTURES (
    PIC_id INT AUTO_INCREMENT NOT NULL,
    PIC_name VARCHAR(255) NOT NULL,
    PIC_created_at TIMESTAMP,
    PIC_updated_at TIMESTAMP,
    
    USE_id INT NOT NULL,
    ACT_id INT NOT NULL,
    PRO_id INT NOT NULL,
    
    PRIMARY KEY (PIC_id),
    FOREIGN KEY (USE_id) REFERENCES T_USERS(USE_id),
    FOREIGN KEY (ACT_id) REFERENCES T_ACTIVITIES(ACT_id),
    FOREIGN KEY (PRO_id) REFERENCES T_PRODUCTS(PRO_id)
);

CREATE TABLE T_CAMPUS (
    CAM_id INT AUTO_INCREMENT NOT NULL,
    CAM_name VARCHAR(50) NOT NULL,
    
    PRIMARY KEY (CAM_id)
);

CREATE TABLE T_ACTIVITIES (
    ACT_id INT AUTO_INCREMENT NOT NULL,
    ACT_name VARCHAR(100) NOT NULL,
    ACT_price DECIMAL,
    ACT_description TEXT,
    ACT_date TIMESTAMP,
    ACT_likes INT,
    ACT_place VARCHAR(255),
    ACT_created_at TIMESTAMP,
    ACT_updated_at TIMESTAMP,
    
    PRIMARY KEY (ACT_id)
);

CREATE TABLE Register (
	ACT_id INT NOT NULL,
    USE_id INT NOT NULL,
    
    FOREIGN KEY (ACT_id) REFERENCES T_ACTIVITIES(ACT_id),
    FOREIGN KEY (USE_id) REFERENCES T_USERS(USE_id)
);

CREATE TABLE T_COMMENTS (
    COM_id INT AUTO_INCREMENT NOT NULL,
    COM_content TEXT NOT NULL,
    COM_created_at TIMESTAMP,
    
    USE_id INT NOT NULL,
    ACT_id INT NOT NULL,
        
    PRIMARY KEY (COM_id),
    FOREIGN KEY (USE_id) REFERENCES T_USERS(USE_id),
    FOREIGN KEY (ACT_id) REFERENCES T_ACTIVITIES(ACT_id)
);

CREATE TABLE T_PRODUCTS (
    PRO_id INT AUTO_INCREMENT NOT NULL,
    PRO_name VARCHAR(100) NOT NULL,
    PRO_description TEXT,
    PRO_price DECIMAL NOT NULL,
    PRO_quantity INT NOT NULL,
    PRO_solde INT,
    PRO_created_at TIMESTAMP,
    PRO_updated_at TIMESTAMP,
        
    PRIMARY KEY (PRO_id)
);

CREATE TABLE Compose (
	PRO_id INT NOT NULL,
    ORD_id INT NOT NULL,
    
    FOREIGN KEY (PRO_id) REFERENCES T_PRODUCTS(PRO_id),
    FOREIGN KEY (ORD_id) REFERENCES T_ORDERS(ORD_id)
);

CREATE TABLE `Order` (
	PRO_id INT NOT NULL,
    USE_id INT NOT NULL,
    
    FOREIGN KEY (PRO_id) REFERENCES T_PRODUCTS(PRO_id),
    FOREIGN KEY (USE_id) REFERENCES T_USERS(USE_id)
);

CREATE TABLE T_ORDERS (
    ORD_id INT AUTO_INCREMENT NOT NULL,
    ORD_quantity INT NOT NULL,
    ORD_date TIMESTAMP NOT NULL,
        
    PRIMARY KEY (ORD_id)
);

CREATE TABLE T_ROLES (
	ROL_id INT AUTO_INCREMENT NOT NULL,
    ROL_name VARCHAR(100) NOT NULL,
    ROL_power_level INT NOT NULL,
    
    PRIMARY KEY(ROL_id)
);

CREATE TABLE T_SPECIALITIES (
	SPE_id INT AUTO_INCREMENT NOT NULL,
    SPE_name VARCHAR(100),
    
    PRIMARY KEY(SPE_id)
);









