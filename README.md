# Event Management System

## Overview

The **Event Management System** is a web-based application designed to streamline the process of managing events. It provides features for user authentication, event creation, attendee registration, and report generation. The system offers a user-friendly interface for both event organizers and attendees, making event management efficient and accessible.

## Features

- **User Authentication:** Secure login, registration, and logout functionalities.
- **Event Management:** Create, edit, and delete events with ease.
- **Attendee Registration:** Users can register for events seamlessly.
- **Event Dashboard:** Displays all upcoming and past events.
- **Report Generation:** Export attendee lists in CSV format for easy record-keeping.
- **Search Functionality:** Quickly find events and attendees.

## Installation Guide

### Prerequisites

Ensure you have the following installed on your system:

- PHP (latest version recommended)
- MySQL or MariaDB
- Apache Server (XAMPP, WAMP, or any preferred setup)
- Git (for cloning the repository)
- Docker (optional, for containerized deployment)

### Step-by-Step Installation

1. **Clone the Repository:**
   ```sh
   git clone <repository-url>
   ```
2. **Navigate to the Project Directory:**
   ```sh
   cd event-management-system
   ```
3. **Set Up the Database:**
   - Create a MySQL database.
   - Import the necessary SQL schema.
4. **Configure the Database Connection:**
   - Open `config/config.php`.
   - Update the database credentials (host, username, password, database name).
5. **Install and Start XAMPP (or Alternative Stack):**
   - Run Apache and MySQL services.
6. **Launch the Application:**
   - Open your web browser and navigate to:
     ```
     http://localhost/event-management-system/
     ```

## Testing Credentials

To log in as an admin or user, use the following credentials:

### Admin User:

- **Email:** `admin@gmail.com`
- **Password:** `123456`

### Regular User:

- **Email:** `bob@gmail.com`
- **Password:** `bob123456`

## Docker Deployment

To run this project using Docker, execute the following commands:

```sh
docker compose build
docker compose up -d
```

### Launch the Application:

- **Access the database:**

  ```
  http://localhost:8081/
  ```

  - **Username:** `root`
  - **Password:** `root`

- **Access the application:**
  ```
  http://localhost:8080/event-management-system/
  ```
  - **Login credentials:** Use the same as provided in the testing section.

This will build the necessary images and start the containers in detached mode.
