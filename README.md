# 🍅 Pomodoro Timer Application

![License](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://img.shields.io/badge/PHP-7.4%2B-purple.svg)
![Tailwind](https://img.shields.io/badge/Tailwind_CSS-2.2.19-38b2ac.svg)

A professional Pomodoro Timer web application built with a clean MVC architecture, helping you boost productivity and manage your time effectively.

## ✨ Features

- **Flexible Time Management**: 25-minute focus sessions, 5-minute short breaks, and 15-minute long breaks
- **Productivity Tracking**: Comprehensive history of all completed sessions
- **Performance Statistics**: Track your productivity metrics over time 
- **Modern UI**: Clean, responsive design with Tailwind CSS
- **Notifications**: Audio alerts and browser notifications when sessions complete
- **Responsive Design**: Works seamlessly on desktop and mobile devices

## 🚀 Tech Stack

- **Frontend**: HTML5, Tailwind CSS, JavaScript (ES6+)
- **Backend**: PHP with MVC architecture
- **Database**: MySQL
- **Architecture**: Custom MVC framework with clean separation of concerns

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or higher
- Web server (Apache/Nginx)

## 💻 Installation

### Option 1: Traditional Setup

#### 1. Clone the Repository

```bash
git clone https://github.com/yourusername/pomodoro-timer.git
cd pomodoro-timer
```

#### 2. Database Setup

1. Create a MySQL database named `pomodoro_db` (or update the database name in the config file)
2. Import the database schema:

```bash
mysql -u your_username -p pomodoro_db < database_setup.sql
```

Or use phpMyAdmin to import the `database_setup.sql` file.

#### 3. Configuration

1. Update database credentials in `config/config.php`:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'your_username');  // Update with your MySQL username
define('DB_PASS', 'your_password');  // Update with your MySQL password
define('DB_NAME', 'pomodoro_db');
```

2. Update the `URL_ROOT` in `config/config.php` with your base URL.

#### 4. Web Server Configuration

Configure your web server to point to the `public` directory as the document root.

### Option 2: Docker Setup

Using Docker is the easiest way to get started:

1. Clone the repository:

```bash
git clone https://github.com/yourusername/pomodoro-timer.git
cd pomodoro-timer
```

2. Start the Docker containers:

```bash
docker-compose up -d
```

3. Access the application:
   - Web application: http://localhost:8080
   - phpMyAdmin: http://localhost:8081 (Server: db, Username: root, Password: password)

4. Update the URL_ROOT in `config/config.php` if needed:

```php
define('URL_ROOT', '');  // Empty for Docker setup with default ports
```

## 📖 How to Use

1. **Select Session Type**: Choose between Focus (25 min), Short Break (5 min), or Long Break (15 min)
2. **Start Timer**: Click the Start button to begin your session
3. **Manage Sessions**: Use Pause to temporarily stop and Reset to restart
4. **Track Progress**: Complete sessions are automatically logged
5. **View History**: Access your session history through the History tab

## 🏗️ Project Structure

```
pomodoro-timer/
├── app/
│   ├── controllers/     # Request handlers
│   ├── models/          # Database interaction
│   └── views/           # UI templates
├── config/              # Configuration files
├── core/                # Core framework classes
├── public/              # Publicly accessible files
│   ├── assets/          # JS, CSS, images
│   └── index.php        # Entry point
├── routes/              # URL routing definitions
├── .github/             # GitHub templates
├── docker-compose.yml   # Docker configuration
├── Dockerfile           # Docker image definition
├── .gitignore           # Git ignore file
├── database_setup.sql   # Database schema
├── LICENSE              # MIT license
└── README.md            # This file
```

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request. For more details, see [CONTRIBUTING.md](CONTRIBUTING.md).

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details. 