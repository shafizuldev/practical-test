🧩 Installation & Setup
1️⃣ Install dependencies
composer install

2️⃣  Environment configuration

Copy the example environment file:

cp .env.example .env


Edit .env with your database credentials:

APP_NAME="Test"
APP_URL=http://localhost:8000

DB_DATABASE=consent_db
DB_USERNAME=root
DB_PASSWORD=

4️⃣ Generate app key
php artisan key:generate

5️⃣ Run migrations
php artisan migrate


This creates a consents table for storing user acceptances.

🧱 Database Structure
Column	Type	Description
id	int	Primary key
guid	varchar(255)	Unique user identifier
accepted_at	datetime	Timestamp of acceptance
version	int	Consent version (default 1)
ip_address	varchar(255)	User’s IP address
user_agent	text	Browser user agent string
▶️ Running the Project

Use Laravel’s built-in server:

php artisan serve


Then open in browser:
👉 http://localhost:8000

🔐 Admin Panel (Optional)

You can view all consent records at:

/admin/consents


Default login credentials (if seeded):

Email: admin@example.com
Password: Admin@123


To seed the admin:

php artisan db:seed --class=AdminSeeder
