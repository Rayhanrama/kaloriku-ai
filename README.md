# Kaloriku AI

Kaloriku AI is a full-stack web application designed for personal calorie tracking, daily intake and burn monitoring, and AI-driven nutritional recommendations. The system combines a modern PHP web portal built with **Laravel 10** and a microservice-based AI recommendation engine powered by **Python Flask** and **IBM Granite 3.3** (via the Replicate API).

This repository was developed as an academic portfolio project for the **Artificial Intelligence Talent Factory (AITF)** technical evaluation.

> **Note on AI Integration**: During initial development, the external AI recommendation engine integrated the IBM Granite 3.3 8B Instruct model. The API credits for the external Replicate service have expired, so the integration structure and architecture have been preserved with graceful fallback handling. Valid API credentials are required to resume live AI generation.

---

## Features

- **User Authentication & Authorization**: Secure account registration, login, session management, and password management powered by Laravel Breeze and Sanctum.
- **Personalized Daily Calorie Dashboard**: Real-time aggregation of daily intake vs. burned calories, displaying net calorie deficit/surplus statistics.
- **Food Intake Logging (Makanan)**: CRUD management for logging meal entries, calorie amounts, and consumption timestamps.
- **Activity & Exercise Tracking (Aktivitas)**: Logging physical activities, duration in minutes, calories burned, and activity timestamps.
- **Interactive Weekly Visual Analytics**: Embedded 7-day comparative bar chart visualizing daily calorie consumption against physical activity expenditure using Chart.js.
- **AI-Powered Nutritional Advice**: Integration with a microservice endpoint (`POST /saran-ai`) sending intake metrics to an LLM prompt engine for personalized diet advice.
- **Graceful Fallback Mechanism**: Built-in fallback algorithm ensuring continuous app operation and rule-based advice when external AI services or API keys are unavailable.

---

## Tech Stack

- **Laravel** (v10.x) - Main Web Application & RESTful Backend
- **PHP** (v8.1+) - Core Application Language
- **Python** (v3.10+) - AI Microservice Runtime
- **Flask** (v3.x) - Microservice API Framework
- **MySQL** - Relational Database Management System
- **REST API** - Communication Protocol between Laravel and Flask AI Engine
- **IBM Granite** (`ibm-granite/granite-3.3-8b-instruct` via Replicate API) - Large Language Model for Diet Advice Generation
- **Blade & Tailwind CSS** - UI Templating & Styling Framework
- **Chart.js** - Data Visualization Library

---

## System Architecture

```text
User (Web Browser)
        │
        ▼
Laravel Application (Web & Core Logic)
        │
        ▼
   REST API (POST /saran-ai)
        │
        ▼
Flask AI Microservice (Python / LangChain)
        │
        ▼
IBM Granite API / Replicate LLM (Requires active API Credentials)
```

### Communication Flow
1. **User Interaction**: The user logs food consumption or physical exercise and clicks **"Minta Saran AI"** on the Dashboard.
2. **Laravel Processing**: `DashboardController` receives the request, gathers current daily intake and burn stats, and forwards a payload to `FlaskAiService`.
3. **HTTP REST Dispatch**: `FlaskAiService` dispatches a POST request to the Flask AI service endpoint (`/saran-ai`).
4. **Flask LLM Prompt Execution**: The Flask microservice builds a zero-shot prompt from the payload and invokes the **IBM Granite 3.3** model via LangChain and Replicate.
5. **Response Rendering**: The generated advice is returned via JSON to Laravel and displayed on the user's dashboard. If the external AI service is unreachable or credentials are missing, Laravel's fallback system returns a rule-based advice notification.

*Note: Accessing external AI features requires configuring valid `REPLICATE_API_TOKEN` credentials in the Flask AI environment.*

---

## Installation

### Prerequisites
- PHP `>= 8.1`
- Composer `>= 2.0`
- Node.js `>= 18.0` & npm
- Python `>= 3.10` & `pip`
- MySQL Server `>= 8.0`

---

### Step 1: Laravel Web Application Setup

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/RayhanRama/kaloriku-ai.git
   cd kaloriku-ai
   ```

2. **Install PHP Dependencies**:
   ```bash
   composer install
   ```

3. **Install Frontend Dependencies**:
   ```bash
   npm install
   ```

4. **Environment Configuration**:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database Setup**:
   Configure your MySQL credentials in `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=kaloriku
   DB_USERNAME=root
   DB_PASSWORD=your_mysql_password
   ```

6. **Run Database Migrations**:
   ```bash
   php artisan migrate
   ```

7. **Compile Frontend Assets & Run Development Server**:
   In terminal 1:
   ```bash
   npm run dev
   ```
   In terminal 2:
   ```bash
   php artisan serve
   ```
   The Laravel application will be accessible at `http://127.0.0.1:8000`.

---

### Step 2: Flask AI Microservice Setup

1. **Navigate to AI Service Directory**:
   ```bash
   cd ai_service
   ```

2. **Create and Activate Virtual Environment**:
   ```bash
   python -m venv venv
   # Windows:
   venv\Scripts\activate
   # Linux/macOS:
   source venv/bin/activate
   ```

3. **Install Python Dependencies**:
   ```bash
   pip install -r requirements.txt
   ```

4. **Configure Environment Variables**:
   ```bash
   cp .env.example .env
   ```
   Add your Replicate API key in `.env`:
   ```env
   PORT=5000
   REPLICATE_API_TOKEN=your_actual_replicate_api_key
   ```

5. **Start Flask AI Service**:
   ```bash
   python app.py
   ```
   The Flask AI service will run at `http://127.0.0.1:5000`.

---

## Environment Variables

### Laravel Application (`.env`)

| Variable | Description | Default / Example |
|---|---|---|
| `APP_NAME` | Application title | `Kaloriku AI` |
| `APP_ENV` | Application environment | `local` |
| `APP_KEY` | Encryption key generated by Laravel | `base64:...` |
| `APP_DEBUG` | Enable debug mode | `true` |
| `APP_URL` | Base web application URL | `http://127.0.0.1:8000` |
| `DB_CONNECTION` | Database driver | `mysql` |
| `DB_HOST` | Database host IP | `127.0.0.1` |
| `DB_PORT` | Database port | `3306` |
| `DB_DATABASE` | Database name | `kaloriku` |
| `DB_USERNAME` | Database username | `root` |
| `DB_PASSWORD` | Database password | `""` |
| `FLASK_AI_API_URL` | Base URL of Flask AI backend microservice | `http://127.0.0.1:5000` |

### Flask AI Service (`ai_service/.env`)

| Variable | Description | Default / Example |
|---|---|---|
| `PORT` | Listening port for Flask app | `5000` |
| `REPLICATE_API_TOKEN` | API Token for IBM Granite model on Replicate | `your_replicate_api_key_here` |

---

## Screenshots

*(Placeholders for application UI screenshots)*

| Dashboard View | Meal Logging |
|:---:|:---:|
| `![Dashboard Placeholder](docs/screenshots/dashboard.png)` | `![Meal Logging Placeholder](docs/screenshots/makanan.png)` |

| Activity Logging | AI Recommendation Output |
|:---:|:---:|
| `![Activity Logging Placeholder](docs/screenshots/aktivitas.png)` | `![AI Advice Placeholder](docs/screenshots/saran_ai.png)` |

---

## Future Improvements

- **Asynchronous AI Request Queueing**: Use Laravel Queues (Redis/Database) to handle AI recommendation requests asynchronously without blocking web requests.
- **Macronutrient Breakdown Tracking**: Expand food logging to track Carbohydrates, Proteins, and Fats in addition to total calories.
- **Multi-Model LLM Provider Support**: Support multiple LLM backends (e.g. OpenAI GPT-4o, Ollama local models, Anthropic Claude) alongside IBM Granite.
- **Mobile Responsive Enhancements**: Refine Blade templates with dedicated mobile drawer menus and PWA capabilities.
- **Comprehensive Unit & Integration Testing**: Add PHPUnit tests for Laravel controllers/services and PyTest suites for the Flask microservice.

---

## Project Structure

```text
kaloriku-ai/
├── ai_service/                  # Standalone Python Flask AI Microservice
│   ├── app.py                   # Flask server script with /saran-ai endpoint
│   ├── requirements.txt         # Python package dependencies
│   └── .env.example             # Flask environment configuration template
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       ├── AIController.php         # AI recommendation page controller
│   │       ├── AktivitasController.php  # Activity tracking controller
│   │       ├── DashboardController.php  # Main dashboard & AI advice dispatcher
│   │       ├── MakananController.php    # Food intake controller
│   │       └── ProfileController.php    # User profile controller
│   ├── Models/
│   │   ├── Aktivitas.php        # Activity Eloquent model (belongsTo User)
│   │   ├── Makanan.php          # Food Eloquent model (belongsTo User)
│   │   └── User.php             # User Eloquent model (hasMany Makanan/Aktivitas)
│   └── Services/
│       └── FlaskAiService.php   # Service layer encapsulating HTTP REST calls to Flask AI
├── config/                      # Laravel configuration files (services.php, database.php)
├── database/
│   └── migrations/              # Database schema definition files
├── resources/
│   ├── views/
│   │   ├── ai/index.blade.php   # AI summary view page
│   │   ├── aktivitas/           # Activity management views
│   │   ├── dashboard.blade.php  # Interactive user dashboard view
│   │   ├── home.blade.php       # Public landing page
│   │   ├── layouts/             # Shared layout components (sidebar, navbar)
│   │   └── makanan/             # Food intake management views
├── routes/
│   ├── web.php                  # Application Web Routes
│   └── api.php                  # Application API Routes
├── sd_learn_cgo_lab1.ipynb      # Historical Jupyter Notebook used in Colab development
├── .env.example                 # Environment variable template
├── composer.json                # PHP Dependencies configuration
├── package.json                 # Frontend JS/CSS Dependencies configuration
└── README.md                    # Project Documentation
```

---

## License

This project is licensed under the [MIT License](LICENSE).
