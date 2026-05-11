# Smart Library Management System

A complete PHP MVC based Smart Library Management System developed using PHP, MySQL, HTML, CSS, JavaScript, AJAX, and Chart.js.

This project provides a complete digital library workflow including authentication, role management, book catalog management, borrowing system, return processing, fine calculation, analytics, and admin reporting.

---

# Features

## Authentication & Authorization

- Member Registration
- Secure Login System
- Password Hashing
- Role-Based Access Control
- Session Management
- Profile Management
- Password Change System

### Supported Roles

- Member
- Librarian
- Admin

---

# Book Catalog Management

## Genre Management

- Create Genre
- Edit Genre
- Delete Genre
- Prevent deletion when books are assigned

## Book Management

- Create Book
- Edit Book
- Delete Book
- ISBN Validation
- Book Availability Tracking
- Shelf Location Management
- Publication Year Management

---

# AJAX Live Search

- Real-time book searching
- Search by:
  - Title
  - Author
  - ISBN
- Dynamic table rendering without page reload

---

# Borrowing System

## Member Features

- Browse Books
- Request Borrow
- View Borrowed Books
- View Fine History

## Librarian Features

- Approve Borrow Requests
- Reject Borrow Requests
- Process Returns
- Track Availability

---

# Fine Management System

- Automatic Fine Generation
- Overdue Detection
- Fine Calculation
- Member Fine Dashboard
- Librarian Payment Management

---

# Reports & Analytics

## Admin Reports

- Top Borrowed Books
- Most Active Members
- Monthly Borrow Analytics
- Chart.js Data Visualization

---

# User Management

## Admin Features

- View All Users
- Create Librarian Accounts
- Edit User Information
- Change User Roles
- Delete Users
- Prevent Self Deletion

---

# Additional Features

- Flash Message System
- Validation Error Handling
- Old Form Data Persistence
- Responsive Dashboard UI
- AJAX Availability Updates
- Role-Based Navigation
- Confirmation Popups
- Modern Admin Dashboard

---

# Technologies Used

| Technology | Purpose |
|---|---|
| PHP | Backend Development |
| MySQL | Database |
| HTML5 | Structure |
| CSS3 | Styling |
| JavaScript | Client-side Logic |
| AJAX | Dynamic Requests |
| Chart.js | Analytics Visualization |
| XAMPP | Local Server |

---

# Project Structure

```txt
Project/
│
├── config/
├── controllers/
├── helpers/
├── models/
├── public/
│   ├── css/
│   ├── js/
│
├── routes/
├── views/
│
├── index.php
└── routers.php
```

---

# Installation Guide

## Step 1

Clone or download the project.

## Step 2

Move the project folder into:

```txt
htdocs/
```

## Step 3

Create a MySQL database.

Example:

```txt
smart_library
```

## Step 4

Import the SQL file into phpMyAdmin.

## Step 5

Configure database credentials inside:

```txt
config/database.php
```

## Step 6

Start Apache and MySQL from XAMPP.

## Step 7

Run the project:

```txt
http://localhost/Library-Management-System/Project
```

---

# Default Roles

| Role | Access |
|---|---|
| Member | Borrow Books |
| Librarian | Manage Books & Borrows |
| Admin | Full System Control |

---

# Security Features

- Password Hashing
- Session Authorization
- Role-Based Access
- Validation Protection
- SQL Injection Protection using PDO Prepared Statements

---

# Future Improvements

- Email Notifications
- PDF Report Export
- Book Reservation System
- Pagination
- Dark Mode
- REST API
- Mobile App Integration

---

# Developed By

MOHIBUL ALAM ANANDA

American International University-Bangladesh (AIUB)

Department of Computer Science

ABU TAIB MAHDI

American International University-Bangladesh (AIUB)

Department of Computer Science

MIRZA TARVIR BAIG

American International University-Bangladesh (AIUB)

Department of Computer Science


NASIF RAHMAN


American International University-Bangladesh (AIUB)

Department of Computer Science

---

# License

This project is developed for academic and learning purposes.