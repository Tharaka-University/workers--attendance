-- Create Database
CREATE DATABASE attendance;

-- Use the database
USE attendance;

-- Create Employees table
CREATE TABLE employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50),
    designation VARCHAR(50)
);

-- Create Attendance table
CREATE TABLE attendance_records (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT,
    date DATE,
    status ENUM('P', 'A', 'L'), -- P = Present, A = Absent, L = Leave
    FOREIGN KEY (employee_id) REFERENCES employees(id)
);
