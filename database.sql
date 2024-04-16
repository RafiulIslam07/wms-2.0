
-- Table: USER
CREATE TABLE USER (
    userID INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    dateOfBirth DATE,
    gender ENUM('Male', 'Female', 'Other'),
    email VARCHAR(30),
    phone VARCHAR(11),
    address VARCHAR(50),
    entryDate DATE,
    password VARCHAR(10)
);

-- Table: CUSTOMER
CREATE TABLE CUSTOMER (
    c_userID INT PRIMARY KEY,
    FOREIGN KEY (c_userID) REFERENCES USER(userID)
);

-- Table: SERVICE_PROVIDER
CREATE TABLE SERVICE_PROVIDER (
    s_userID INT PRIMARY KEY,
    teamSize INT,
    rating DECIMAL(3,2),
    FOREIGN KEY (s_userID) REFERENCES USER(userID)
);

-- Table: VOLUNTEER
CREATE TABLE VOLUNTEER (
    v_userID INT PRIMARY KEY,
    organization VARCHAR(50),
    FOREIGN KEY (v_userID) REFERENCES USER(userID)
);
-- Table: GARBAGE_RECYCLE
CREATE TABLE GARBAGE_RECYCLE (
    recycleID INT PRIMARY KEY AUTO_INCREMENT,
    recyclableAmount INT,
    date DATE
);

-- Table: GARBAGE_TRACKING
CREATE TABLE GARBAGE_TRACKING (
    garbageID INT PRIMARY KEY AUTO_INCREMENT,
    location VARCHAR(50),
    quantity INT,
    type VARCHAR(50),
    c_userID INT,
    date DATE,
    recycleID INT,
    FOREIGN KEY (c_userID) REFERENCES USER(userID),
    FOREIGN KEY (recycleID) REFERENCES GARBAGE_RECYCLE(recycleID)
);

-- Table: REQUEST_STATUS
CREATE TABLE REQUEST_STATUS (
    requestID INT PRIMARY KEY AUTO_INCREMENT,
    status VARCHAR(50),
    date DATE,
    garbageID INT,
    s_userID INT,
    FOREIGN KEY (garbageID) REFERENCES GARBAGE_TRACKING(garbageID),
    FOREIGN KEY (s_userID) REFERENCES SERVICE_PROVIDER(s_userID)
);


-- Table: CUSTOMER_VOLUNTEER_REQUEST
CREATE TABLE CUSTOMER_VOLUNTEER_REQUEST (
    vol_requestID INT,
    c_userID INT,
    PRIMARY KEY (vol_requestID, c_userID),
    FOREIGN KEY (c_userID) REFERENCES USER(userID)
);

-- Table: VOLUNTEER_VOLUNTEER_REQUEST
CREATE TABLE VOLUNTEER_VOLUNTEER_REQUEST (
    vol_requestID INT,
    v_userID INT,
    PRIMARY KEY (vol_requestID, v_userID),
    FOREIGN KEY (v_userID) REFERENCES USER(userID)
);
-- Table: VOLUNTEER_REQUEST
CREATE TABLE VOLUNTEER_REQUEST (
    vol_requestID INT PRIMARY KEY AUTO_INCREMENT,
    location VARCHAR(100),
    count INT
);

-- Table: GARBAGE_SCHEDULING
CREATE TABLE GARBAGE_SCHEDULING (
    c_userID INT,
    s_userID INT,
    garbageID INT,
    scheduling_time DATETIME,
    PRIMARY KEY (c_userID, s_userID, garbageID),
    FOREIGN KEY (c_userID) REFERENCES USER(userID),
    FOREIGN KEY (s_userID) REFERENCES SERVICE_PROVIDER(s_userID),
    FOREIGN KEY (garbageID) REFERENCES GARBAGE_TRACKING(garbageID)
);
-- Populating USER table with dummy data
INSERT INTO USER (firstName, lastName, dateOfBirth, gender, email, phone, address, entryDate, password)
VALUES 
    ('John', 'Doe', '1990-05-15', 'Male', 'john.doe@example.com', '1234567890', '123 Main St', '2022-01-01', 'password123'),
    ('Jane', 'Smith', '1988-08-25', 'Female', 'jane.smith@example.com', '0987654321', '456 Elm St', '2022-01-02', 'secret456'),
    ('Michael', 'Johnson', '1995-03-10', 'Male', 'michael.johnson@example.com', '5551234567', '789 Oak St', '2022-01-03', 'pass321'),
    ('Emily', 'Brown', '1992-11-20', 'Female', 'emily.brown@example.com', '9876543210', '321 Pine St', '2022-01-04', 'qwerty789'),
    ('William', 'Taylor', '1985-09-05', 'Male', 'william.taylor@example.com', '1239876543', '567 Maple St', '2022-01-05', 'letmein'),
    ('Emma', 'Wilson', '1998-07-15', 'Female', 'emma.wilson@example.com', '4567890123', '890 Cedar St', '2022-01-06', 'hello123'),
    ('Johna', 'Doe', '1990-05-15', 'Male', 'john.doe@example.com', '1234567890', '123 Main St', '2022-01-01', 'password123'),
    ('Janeaga', 'Smith', '1988-08-25', 'Female', 'jane.smith@example.com', '0987654321', '456 Elm St', '2022-01-02', 'secret456'),
    ('Michaelagag', 'Johnson', '1995-03-10', 'Male', 'michael.johnson@example.com', '5551234567', '789 Oak St', '2022-01-03', 'pass321'),
    ('Emilyaga', 'Brown', '1992-11-20', 'Female', 'emily.brown@example.com', '9876543210', '321 Pine St', '2022-01-04', 'qwerty789'),
    ('Williamaga', 'Taylor', '1985-09-05', 'Male', 'william.taylor@example.com', '1239876543', '567 Maple St', '2022-01-05', 'letmein'),
    ('Emmaaga', 'Wilson', '1998-07-15', 'Female', 'emma.wilson@example.com', '4567890123', '890 Cedar St', '2022-01-06', 'hello123');


-- Populating CUSTOMER table with dummy data
INSERT INTO CUSTOMER (c_userID)
VALUES 
    (1), 
    (3),  
    (5);  
-- Populating SERVICE_PROVIDER table with dummy data
INSERT INTO SERVICE_PROVIDER (s_userID, teamSize, rating)
VALUES 
    (2, 5, 4.5),   
    (4, 8, 4.2),  
    (6, 3, 4.8); 

-- Populating VOLUNTEER table with dummy data
INSERT INTO VOLUNTEER (v_userID, organization)
VALUES 
    (7, 'Red Cross'),    
    (8, 'UNICEF'),       
    (9, 'Greenpeace');   


-- Populating GARBAGE_RECYCLE table with dummy data
INSERT INTO GARBAGE_RECYCLE (recyclableAmount, date)
VALUES 
    (100, '2022-03-15'),  
    (150, '2022-03-16'),
    (200, '2022-03-17');  



-- Populating GARBAGE_TRACKING table with dummy data
INSERT INTO GARBAGE_TRACKING (location, quantity, type, c_userID, date, recycleID)
VALUES 
    ('Street A', 50, 'Plastic', 1, '2022-03-15', 1),     ('Street B', 30, 'Glass', 3, '2022-03-16', 2),    ('Street C', 70, 'Paper', 5, '2022-03-17', 3);     

-- Populating REQUEST_STATUS table with dummy data
INSERT INTO REQUEST_STATUS (status, date, garbageID, s_userID)
VALUES 
    ('Pending', '2022-03-15', 1, 2),
    ('Completed', '2022-03-16', 2, 4), 
    ('Pending', '2022-03-17', 3, 6);   

-- Populating CUSTOMER_VOLUNTEER_REQUEST table with dummy data
INSERT INTO CUSTOMER_VOLUNTEER_REQUEST (vol_requestID, c_userID)
VALUES 
    (1, 1),   
    (2, 3),   
    (3, 5);   

-- Populating VOLUNTEER_VOLUNTEER_REQUEST table with dummy data
INSERT INTO VOLUNTEER_VOLUNTEER_REQUEST (vol_requestID, v_userID)
VALUES 
    (1, 7),   
    (2, 8),  
    (3, 9);  

-- Populating VOLUNTEER_REQUEST table with dummy data
INSERT INTO VOLUNTEER_REQUEST (location, count)
VALUES 
    ('Park', 5),    
    ('School', 3),  
    ('Hospital', 7);


-- Populating GARBAGE_SCHEDULING table with dummy data
INSERT INTO GARBAGE_SCHEDULING (c_userID, s_userID, garbageID, scheduling_time)
VALUES 
    (1, 2, 1, '2022-03-15 08:00:00'), 
    (3, 4, 2, '2022-03-16 10:00:00'), 
    (5, 6, 3, '2022-03-17 12:00:00'); 
