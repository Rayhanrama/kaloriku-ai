
# Kaloriku-AI

 Aplikasi Pelacak Kalori & Saran Diet Berbasis AI

🥗 Kaloriku-AI
Kaloriku-AI adalah aplikasi berbasis web untuk membantu pengguna memantau asupan dan pembakaran kalori harian, serta memberikan saran diet otomatis berbasis AI menggunakan model IBM Granite melalui Replicate API.

Kaloriku-AI membantu pengguna dalam:

Mencatat makanan yang dikonsumsi dan aktivitas yang dilakukan

Menghitung defisit kalori harian secara otomatis

Menyediakan saran makanan atau aktivitas berbasis target defisit kalori menggunakan AI dari IBM Granite

⚙️ Technologies Used
Backend:
Laravel 10 – RESTful web framework

Flask – Lightweight Python API framework

MySQL – Relational database for data storage

Frontend:
Blade (Laravel) – Template engine

TailwindCSS – Utility-first CSS framework

Chart.js / Recharts – Grafik kalori harian & mingguan

AI Integration:
IBM Granite 3.3 via Replicate API

LangChain + Flask as Python wrapper

✨ Features
✅ Autentikasi pengguna (Login & Register)

✅ Dashboard kalori harian

✅ Input makanan & aktivitas

✅ Grafik mingguan asupan vs pembakaran kalori

✅ Saran AI berdasarkan kalori masuk, terbakar, dan target defisit

✅ Terintegrasi dengan Flask API menggunakan endpoint /saran-ai

✅ Responsive UI dengan Tailwind CSS

🚀 Setup Instructions
# 1. Clone project dari GitHub
git clone https://github.com/RayhanRama/kaloriku-ai.git
cd kaloriku-ai

# 2. Install dependency PHP
composer install

# 3. Install dependency frontend (Vite, Tailwind, dsb.)
npm install

# 4. Salin file .env dan generate app key
cp .env.example .env
php artisan key:generate

# 5. Edit file .env untuk sesuaikan database
# Buka file .env dan ubah sesuai:
# DB_DATABASE=kaloriku
# DB_USERNAME=root
# DB_PASSWORD=

# 6. Jalankan migrasi dan seeder jika tersedia
php artisan migrate 

# 7. Jalankan Vite/Tailwind jika digunakan
npm run dev

# 8. Jalankan server Laravel
php artisan serve

# 9. Akses project di browser
# http://127.0.0.1:8000


cd kaloriku-ai
