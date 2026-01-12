# Simple User Manager (PHP & MySQL)

A lightweight and secure CRUD user management system built with **PHP** and **MySQL**, featuring a modern UI, CSRF protection, and dark/light theme support.  
This project is suitable for learning purposes, small internal tools, and as a portfolio demonstration.


## 🚀 Features

- Create, Read, Update, and Delete (CRUD) users
- CSRF protection for secure form submissions
- Dark / Light theme toggle
- Responsive and clean user interface
- Secure database operations using prepared statements
- UTF-8 support (including Khmer characters)

---

## 🖼️ Screenshots

### Home Page
![Home Page](screenshots/home.png)

### Edit User
![Edit User](screenshots/edit.png)

---

## 🛠️ Tech Stack

* **Backend:** PHP (MySQLi)
* **Database:** MySQL
* **Frontend:** HTML5, CSS3, JavaScript
* **Icons:** Feather Icons

---

## ⚙️ Installation & Setup

1. Clone the repository:

```bash
git clone https://github.com/your-username/simple-user-manager.git
```

2. Create a database:

```sql
CREATE DATABASE user_manager;
```

3. Import the SQL file:

```text
users.sql
```

4. Configure database connection in `db.php`:

```php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "user_manager";
```

5. Run the project using **XAMPP** or any local PHP server:

```
http://localhost/simple-dynamic/
```

---

## 📁 Project Structure

```text
simple-dynamic/
├── index.php
├── add.php
├── edit.php
├── update.php
├── delete.php
├── db.php
├── style.css
├── script.js
├── users.sql
├── screenshots/
└── README.md
```

---

## 🔒 Security Notes

* Uses prepared statements to prevent SQL Injection
* CSRF tokens implemented for POST requests
* Input sanitization using `htmlspecialchars`

---

## 👨‍💻 Author

**Pich Chanthorn**
IT Student – Build Bright University (BBU)
Aspiring Full-Stack Developer

---

## 📜 License

This project is open-source and available for educational and personal use.

```


 