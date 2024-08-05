-- Database: clientdb

-- DROP DATABASE IF EXISTS clientdb;

CREATE DATABASE clientdb
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
    name TEXT NOT NULL,
    severity TEXT CHECK (severity IN ('Low', 'Medium', 'High')) NOT NULL,
    wait_time INTEGER NOT NULL,
    code CHAR(3) UNIQUE NOT NULL
);
