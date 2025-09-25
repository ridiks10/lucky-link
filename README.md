# 🎲 Lucky Link

Laravel 12 demo app with registration and unique access links.  
Each user gets one link valid for 7 days and can play a simple **“I'm feeling lucky”** game with win/lose and payout logic.

## 🚀 How to run

1. Clone repo and install dependencies:
   ```bash
   git clone https://github.com/your-username/lucky-link.git
   cd lucky-link
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

2. Configure database in `.env` and run migrations:
   ```bash
   php artisan migrate
   ```

3. Start server:
   ```bash
   php artisan serve
   ```

4. Open in browser:  
   [http://127.0.0.1:8000](http://127.0.0.1:8000)
