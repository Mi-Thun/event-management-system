# Event Management System

## Overview
The Event Management System is a web application designed to facilitate the management of events, including user authentication, event creation, attendee registration, and report generation. This system provides a user-friendly interface for both event organizers and attendees.

## Features
- User authentication (login, registration, logout)
- Event management (create, edit, delete events)
- Attendee registration for events
- Event dashboard displaying all events
- Report generation for attendee lists in CSV format

## Installation Instructions
1. Clone the repository:
   ```
   git clone <repository-url>
   ```
2. Navigate to the project directory:
   ```
   cd event-management-system
   ```
3. Set up the database:
   - Create a MySQL database and import the necessary SQL schema (not provided in this README).
4. Configure the database connection:
   - Open `config/config.php` and update the database credentials.
5. Install dependencies (if any):
   ```
   composer install
   ```
6. Start the server:
   ```
   php -S localhost:8000
   ```
7. Access the application in your web browser at `http://localhost:8000`.

## Testing Credentials
- **Admin User:**
  - Username: admin
  - Password: password123

## License
This project is licensed under the MIT License. See the LICENSE file for more details.