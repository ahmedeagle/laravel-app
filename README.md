# Laravel API - Fullstack Assessment

## 📌 Project Overview
This is a Laravel-based REST API for managing **Users, Projects, and Timesheets**. It follows clean architecture principles, includes **authentication**, and supports **Docker & Swarm deployment**.

## 🚀 Features
- ✅ **Laravel 11** with best practices (Service Layer, Repository Pattern, Middleware).
- ✅ **JWT Authentication** using Laravel Sanctum.
- ✅ **CRUD API** for **Users, Projects, and Timesheets**.
- ✅ **Filtering & Pagination** support.
- ✅ **Docker & Docker Swarm** setup.
- ✅ **Redis Caching**.
- ✅ **Swagger API Documentation** (`l5-swagger`).
- ✅ **Unit & Feature Tests** (`php artisan test`).
- ✅ **Postman Collection** for easy API testing.

---
## 📂 Folder Structure
```
fullstack-laravel-assesment/
├── app/
│   ├── Http/
│   │   ├── Controllers/  # API Controllers
│   │   ├── Middleware/   # Authentication Middleware
│   ├── Models/          # User, Project, Timesheet Models
│   ├── Services/        # Business Logic Layer
│   ├── Repositories/    # Database Query Logic
├── database/
│   ├── migrations/      # Database Migrations
│   ├── seeders/         # Seed Data
├── routes/
│   ├── api.php          # API Routes
├── docker/
│   ├── Dockerfile       # PHP-FPM Container
│   ├── nginx/default.conf # Nginx Configuration
├── docker-compose.yml   # Docker Services
├── README.md            # This file
```

---
## ⚡ Installation Guide

### 1️⃣ **Run the App Using Docker** (Recommended)
```bash
docker-compose up -d --build
```
- Access API at: `http://localhost:8000/api`
- Access Redis: `docker exec -it laravel_redis redis-cli`

### 2️⃣ **Manual Setup Without Docker**
1. Clone the repository:
   ```bash
   git clone https://github.com/your-repo/fullstack-laravel-assesment.git
   cd fullstack-laravel-assesment
   ```
2. Install dependencies:
   ```bash
   composer install
   ```
3. Configure the `.env` file:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Run database migrations:
   ```bash
   php artisan migrate --seed
   ```
5. Start the development server:
   ```bash
   php artisan serve
   ```

---
## 🔑 API Authentication
1. Register a new user:
   ```bash
   curl -X POST http://localhost:8000/api/register -d '{"first_name": "Ahmed", "last_name": "TechLead", "email": "ahmed@example.com", "password": "password"}'
   ```
2. Login to get a token:
   ```bash
   curl -X POST http://localhost:8000/api/login -d '{"email": "ahmed@example.com", "password": "password"}'
   ```
3. Use token in API calls:
   ```bash
   curl -H "Authorization: Bearer YOUR_TOKEN" http://localhost:8000/api/users
   ```

---
## 🔗 API Endpoints
| Method | Endpoint               | Description            |
|--------|------------------------|------------------------|
| POST   | /api/register          | Register a new user   |
| POST   | /api/login             | Authenticate user     |
| GET    | /api/users             | List all users        |
| POST   | /api/users             | Create a new user     |
| GET    | /api/users/{id}        | Get a user by ID      |
| PUT    | /api/users/{id}        | Update user           |
| DELETE | /api/users/{id}        | Delete user           |
| GET    | /api/projects          | List all projects     |
| GET    | /api/timesheets        | List all timesheets   |

---
## 🛠️ Running Tests
Run the test suite:
```bash
php artisan test
```

---
## 📦 Deployment with Docker Swarm
1. **Initialize Swarm** (if not already initialized):
   ```bash
   docker swarm init
   ```
2. **Deploy the stack**:
   ```bash
   docker stack deploy -c docker-compose.yml laravel_stack
   ```
3. **Check running services**:
   ```bash
   docker service ls
   ```

---
## 📑 Swagger API Documentation
- Run:
  ```bash
  php artisan l5-swagger:generate
  ```
- Access docs at: `http://localhost:8000/api/documentation`

---
## 🎯 Summary
- ✅ **Best Laravel practices** with Services, Repositories, and Middleware.
- ✅ **Fully containerized using Docker & Swarm**.
- ✅ **Secure JWT-based authentication**.
- ✅ **Unit & Feature tests for robustness**.

