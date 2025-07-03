
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
1. Clone project
bash
Salin
Edit
git clone https://github.com/Rayhanrama/kaloriku-ai.git

cd kaloriku-ai
