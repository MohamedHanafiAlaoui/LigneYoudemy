# Youdemy - Online Learning Platform

Youdemy is an online learning platform designed to offer interactive and personalized learning experiences for students and teachers. The platform includes functionalities for both the front-office and back-office, enabling users to interact with the system based on their roles (Student, Teacher, Admin).

## Table of Contents

1. [Features](#features)
   - [Front Office](#front-office)
   - [Back Office](#back-office)
   - [Cross-cutting Features](#cross-cutting-features)
2. [Technical Requirements](#technical-requirements)
3. [Installation](#installation)
4. [Usage](#usage)
5. [Contributing](#contributing)
6. [License](#license)

## Features

### Front Office

#### Visitor
- Browse the course catalog with pagination.
- Search for courses by keywords.
- Create an account with the option to choose a role (Student or Teacher).

#### Student
- View the course catalog.
- Search and consult course details (description, content, teacher, etc.).
- Enroll in courses after authentication.
- Access a "My Courses" section containing enrolled courses.

#### Teacher
- Add new courses with details such as:
  - Title
  - Description
  - Content (video or document)
  - Tags
  - Category
- Manage courses:
  - Modify, delete, and view course enrollments.
- Access a "Statistics" section displaying:
  - Number of enrolled students
  - Number of courses
  - Other relevant statistics.

### Back Office

#### Admin
- Validate teacher accounts.
- Manage users:
  - Activate, suspend, or delete user accounts.
- Manage content:
  - Courses, categories, and tags.
  - Bulk insertion of tags for efficiency.
- Access global statistics:
  - Total number of courses
  - Course distribution by category
  - The course with the highest number of students
  - Top 3 teachers based on student enrollments.

### Cross-cutting Features
- A course can contain multiple tags (many-to-many relationship).
- Polymorphism applied to the methods for adding and displaying courses.
- Authentication and authorization system to protect sensitive routes.
- Role-based access control, ensuring users can only access features corresponding to their roles.

## Technical Requirements

- **Object-Oriented Programming (OOP)**:
  - Encapsulation
  - Inheritance
  - Polymorphism
- **Database**:
  - Relational database design with appropriate relationships (one-to-many, many-to-many).
- **PHP Sessions**: Used for managing logged-in users.
- **Data Validation**: Ensures that all user input is validated for security.
- **Authentication & Authorization**: Secure routes and pages for different user roles.

##

[canva](https://www.canva.com/design/DAGc803esik/tIg-hvZ9bBf_fi9aCYJmfA/edit?utm_content=DAGc803esik&utm_campaign=designshare&utm_medium=link2&utm_source=sharebutton)