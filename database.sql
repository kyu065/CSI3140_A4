-- Database: clientdb

-- DROP DATABASE IF EXISTS clientdb;

CREATE DATABASE Hospital
    WITH
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'English_Canada.1252'
    LC_CTYPE = 'English_Canada.1252'
    LOCALE_PROVIDER = 'libc'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1
    IS_TEMPLATE = False;


CREATE TABLE patients (
    id SERIAL PRIMARY KEY,
    name VARCHAR(255),
    severity VARCHAR(50),
    wait_time INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);