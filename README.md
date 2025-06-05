## 🛠 Setup Instructions

1. **Clone and Install Dependencies**

```bash
git clone https://github.com/your-repo/laravel-api-travel.git
cd laravel-api-travel
composer install

2 . Environment Setup

cp .env.example .env
php artisan key:generate


3. Configure .env Database

DB_DATABASE=your_db
DB_USERNAME=your_user
DB_PASSWORD=your_pass

4.Run Migrations

php artisan migrate -php artisan serve

5.POST /api/register

curl -X POST http://localhost:8000/api/register \
-H "Content-Type: application/json" \
-d '{
  "name": "Test User",
  "email": "test@example.com",
  "password": "password",
  "password_confirmation": "password"
}'


6.POST /api/login


curl -X POST http://localhost:8000/api/login \
-H "Content-Type: application/json" \
-d '{
  "email": "test@example.com",
  "password": "password"
}'

7. GET /api/user


curl -X GET http://localhost:8000/api/user \
-H "Authorization: Bearer YOUR_API_TOKEN"


8.POST /api/packages

curl -X POST http://localhost:8000/api/packages \
-H "Authorization: Bearer YOUR_API_TOKEN" \
-H "Content-Type: application/json" \
-d '{
  "name": "Beach Escape",
  "price": 299.99,
  "location": "Malibu"
}'


9.GET /api/packages-eager-load


curl -X GET http://localhost:8000/api/packages-eager-load \
-H "Authorization: Bearer YOUR_API_TOKEN"


10.GET /api/packages-with-join

curl -X GET http://localhost:8000/api/packages-with-join \
-H "Authorization: Bearer YOUR_API_TOKEN"


11.GET /api/geo/save-output


curl -X GET http://localhost:8000/api/geo/save-output \
-H "Authorization: Bearer YOUR_API_TOKEN"

12.Testing

php artisan test


-task 1-4 ~ 2Hours. task sanctum 1hour. task 5 30 minutes. task test 2hours.

