CREATE DATABASE job_application_system;

USE job_application_system;

CREATE TABLE applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(15),
    specialization VARCHAR(100),
    experience_years INT,
    application_date DATE DEFAULT CURRENT_DATE
);
