To-Do List Application

1.Technologies

Backend: Laravel 12, PHP 8.2, Laravel Sanctum
Frontend: Vue.js 3, Vue Router, Axios, Vite
Database: MySQL
Testing: PHPUnit (backend), Postman (API)
Version Control: Git, GitHub

2.Setup Instructions
Prerequisites

PHP >= 8.2
Composer
Node.js >= 18
MySQL
Git
Postman (for API testing)

3.Installation

Clone the repository:
git clone https://github.com/Aladin554/TODO-APP.git
cd TODO-APP


Install backend dependencies:
composer install


Install frontend dependencies:
npm install


4.Configure environment:

Update .env with database credentials and set:SANCTUM_STATEFUL_DOMAINS=localhost:8000
SESSION_DOMAIN=localhost
VITE_PORT=5173

Run migrations:
php artisan migrate

Start the backend:
php artisan serve

Build and run the frontend:
npm run dev

5.Access the application:
Open http://localhost:8000 in your browser.



6.API Endpoints
The RESTful API provides the following endpoints, tested with Postman:

POST
/api/register
Register a new user
None

POST
/api/login
Login and get token
None

GET
/api/tasks
List all tasks
Sanctum

POST
/api/tasks
Create a task
Sanctum

GET
/api/tasks/{id}
Show a task
Sanctum

PUT
/api/tasks/{id}
Update a task
Sanctum

DELETE
/api/tasks/{id}
Delete a task
Sanctum

7.Testing
Backend Tests:

Run PHPUnit tests to verify task CRUD and validation:php artisan test
Tests in tests/Feature/TaskTest.php cover:
Task creation (POST /api/tasks)
Task updates (PUT /api/tasks/{id})
Task deletion (DELETE /api/tasks/{id})
Validation errors (e.g., missing title)


<img width="938" alt="image" src="https://github.com/user-attachments/assets/ecaa49db-5d34-4eea-b3ff-6050b6674240" />
<img width="953" alt="image" src="https://github.com/user-attachments/assets/d8efa9ab-4442-4303-9dca-3d2532f49112" />


