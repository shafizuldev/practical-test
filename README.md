
````markdown
## 🧩 Installation & Setup

### 1️⃣ Install dependencies
```bash
composer install
````

---

### 2️⃣ Environment configuration

Copy the example environment file:

```bash
cp .env.example .env
```

Edit the `.env` file with your database credentials:

```env
APP_NAME="Test"
APP_URL=http://localhost:8000

DB_DATABASE=consent_db
DB_USERNAME=root
DB_PASSWORD=
```

---

### 3️⃣ Generate app key

```bash
php artisan key:generate
```

---

### 4️⃣ Run migrations

```bash
php artisan migrate
```

This creates a **`consents`** table for storing user acceptances.

---

## 🧱 Database Structure

| Column      | Type         | Description                 |
| ----------- | ------------ | --------------------------- |
| id          | int          | Primary key                 |
| guid        | varchar(255) | Unique user identifier      |
| accepted_at | datetime     | Timestamp of acceptance     |
| version     | int          | Consent version (default 1) |

---

## ▶️ Running the Project

Use Laravel’s built-in development server:

```bash
php artisan serve
```

Then open in your browser:
👉 [http://localhost:8000](http://localhost:8000)

---

## 🔐 Admin Panel (Optional)

You can view all consent records at:

```
/admin/consents
```

### Default login credentials (if seeded)

```
Email: admin@example.com  
Password: Admin@123
```

To seed the admin user:

```bash
php artisan db:seed --class=AdminSeeder
```
