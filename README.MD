# Learning Management System 🌐

Welcome to the Learning Management System (LMS) project! This is a PHP-based application with a MySQL database, designed to support a variety of user roles: Admin, Lecturer, and Student. Each role has specific capabilities, with security managed through sessions and hashed passwords to ensure authentication and authorization. This document provides a detailed overview of the project, including setup, functionality, and database schema.

## Table of Contents

1. [Project Overview](#project-overview)
2. [Technology Stack](#technology-stack)
3. [Features](#features)
4. [Database Schema](#database-schema)
5. [User Roles and Permissions](#user-roles-and-permissions)
6. [Installation and Setup](#installation-and-setup)
7. [Authentication and Security](#authentication-and-security)
8. [Contributing](#contributing)
9. [Contact Information](#contact-information)

---

## Project Overview 📋

The Learning Management System (LMS) is designed to facilitate interaction between educational administrators, lecturers, and students. Admins can manage announcements, courses, and results, while Lecturers can post assignments. Students can view all content shared by Admins and Lecturers. The platform uses sessions to ensure security, preventing unauthorized access to restricted pages.

## Technology Stack 🛠️

- **Backend**: PHP
- **Frontend**: HTML with Bootstrap for responsive design
- **Database**: MySQL
- **Authentication**: Sessions and hashed passwords

## Features 🎯

- **User Roles**: Admin, Lecturer, and Student, each with specific permissions.
- **Announcements**: Admins can create, and delete announcements.
- **Courses**: Admins can create, and delete courses.
- **Assignments**: Lecturers can create, and delete assignments.
- **Results**: Admins can manage student results, and students can view them.
- **Authentication**: Secure login and signup with session-based authentication.
- **Error Handling**: Clear error messages for incorrect information or unauthorized access.

## Database Schema 📊

The MySQL database consists of the following tables:

- **Courses Table**: Holds course information.

  - `id`: Primary key
  - `title`: Title of the course
  - `description`: Description of the course
  - `created_at`: Timestamp of course creation

- **Assignments Table**: Stores assignment details.

  - `id`: Primary key
  - `assignment_title`: Title of the assignment
  - `subject`: Subject of the assignment
  - `description`: Description of the assignment

- **Results Table**: Contains student results.

  - `id`: Primary key
  - `student_name`: Name of the student
  - `result`: Result or grade of the student

- **Announcements Table**: Contains announcements for the platform.
  - `id`: Primary key
  - `title`: Title of the announcement
  - `description`: Description of the announcement
  - `created_at`: Timestamp of announcement creation

## User Roles and Permissions 🔑

The LMS project has three user roles, each with specific permissions:

- **Admin**:
  - Can create, and delete announcements.
  - Can create, and delete courses.
  - Can manage student results.
  - Has access to all pages.
- **Lecturer**:
  - Can create, and delete assignments.
  - Can view announcements and courses.
- **Student**:
  - Can view announcements, courses, assignments, and results.
  - Restricted access to administrative features.

## Installation and Setup ⚙️

To set up the LMS project locally, follow these steps:

1. **Clone the Repository**:

   ```bash
   git clone https://github.com/your-username/lms-project.git
   ```

2. **Database Setup**:

   - Create a MySQL database for the project.
   - Use the following SQL script to create the necessary tables:

     ```sql
     CREATE DATABASE lms_project;

     USE lms_project;

     CREATE TABLE courses (
       id INT PRIMARY KEY AUTO_INCREMENT,
       title VARCHAR(255),
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );

     CREATE TABLE assignments (
       id INT PRIMARY KEY AUTO_INCREMENT,
       assignment_title VARCHAR(255),
       subject VARCHAR(255),
       description TEXT
     );

     CREATE TABLE results (
       id INT PRIMARY KEY AUTO_INCREMENT,
       student_name VARCHAR(255),
       result VARCHAR(255)
     );

     CREATE TABLE announcements (
       id INT PRIMARY KEY AUTO_INCREMENT,
       title VARCHAR(255),
       description TEXT,
       created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
     );
     ```

3. **Backend Setup**:

   - Install a PHP server (like XAMPP or WAMP).
   - Place the project files in the server's public directory.
   - Configure the database connection in the appropriate PHP file.
   - Start the server.

4. **Access the Application**:
   - Open a web browser and navigate to `http://localhost/<your-directory>` to access the application.

## Authentication and Security 🔐

The LMS project uses session-based authentication and hashed passwords to ensure security. The following security measures are implemented:

- **Sessions**: Sessions are used to maintain user authentication. If a user is not logged in, they cannot access restricted pages.
- **Password Hashing**: User passwords are stored in the database in hashed form, ensuring they are not exposed.
- **Login and Signup**: Users can create an account or log in with existing credentials. Errors are displayed for incorrect information or unauthorized access.

## Contributing 🤝

Contributions are welcome! To contribute to this project, follow these steps:

1. **Fork the Repository**: Create your own fork of the project.
2. **Create a Branch**: Work on your changes in a new branch.
   ```bash
   git checkout -b feature/my-feature
   ```
3. **Commit Your Changes**: Describe your changes in commit messages.
4. **Submit a Pull Request**: Once your changes are complete, submit a pull request for review.

## Contact Information 📧

For questions or further information about this project, please contact:

- **Email**: asinhonore823@gmail.com

Thank you for your interest in the Learning Management System project! If you have any questions or feedback, don't hesitate to reach out. Happy coding! 🌟
