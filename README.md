# 📋 Task Management System (Multi-Tenant)

A robust, secure, and highly optimized multi-tenant Task Management application built using **Laravel 13**, **Tailwind CSS**, and **SQL Server**. The project features scoping of data by tenant, advanced caching strategies, and user authentication.

---

## 🚀 Key Features

*   **Multi-Tenancy**: Automatically resolves and bounds the current tenant via a custom subdomain/hostname middleware, separating user permissions and database scopes dynamically.
*   **Authentication & Authorization**: Integrated secure registration, login, and tenant boundaries preventing cross-tenant access.
*   **CRUD Operations**: Fully functional task management flow allowing users to create, view, edit, update, and delete tasks.
*   **Task Filters & Search**: Real-time filters to search by task title and filter by status (`To Do`, `In Progress`, `Done`), with instant page clearing.
*   **High Performance Caching**: Implements tag-based Redis caching (`Cache::tags`) for query performance. Automatically invalidates user/tenant caches on any updates or new task additions using Laravel Eloquent Observers.

---

## 🛠️ Technology Stack

*   **Framework**: Laravel 13.x
*   **Language**: PHP 8.3+
*   **Database**: Microsoft SQL Server (using `sqlsrv` driver)
*   **Cache Store**: Redis (via `predis` client)
*   **Frontend**: HTML, Vanilla CSS, Tailwind CSS, Laravel Blade template engine
*   **Authentication**: Custom session-based authentication

---

## 📂 Project Architecture & Codebase Structure

*   `app/Http/Middleware/ResolveTenant.php`: Checks and scopes the tenant instance based on hostnames.
*   `app/Http/Controllers/TaskController.php`: Manages requests for task listing, creation, editing, and deletion.
*   `app/Services/TaskService.php`: Core business logic for tasks, containing safe cached data queries and paginator rebuilds.
*   `app/Observers/TaskObserver.php`: Automated caching tagging invalidation.
*   `routes/web.php`: Defines the web routes, properly ordered to separate static assets from wildcard route model bindings.

---

## 💻 Installation & Setup

1. **Clone the Repository**:
   ```bash
   git clone https://github.com/RizkUssef/Task-Management.git
   cd Task-Management
   ```

2. **Install Dependencies**:
   ```bash
   composer install
   npm install
   ```

3. **Configure Environment Variables**:
   Copy `.env.example` to `.env` and fill in your SQL Server database, cache connection details, and tenant credentials.
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Run Migrations & Seeds**:
   ```bash
   php artisan migrate --seed
   ```

5. **Start Local Servers**:
   ```bash
   npm run dev
   ```

---

## 🤖 AI Assistance in this Project

We utilized agentic AI development throughout the lifecycle of this application to resolve critical issues and design standard layouts:

1. **Helping in Set Design & Layout**: Assisted in standardizing Tailwind CSS layouts, micro-interactions, clean margins, and form styles across Blade templates (such as the task filter component).
2. **Solving Complex Caching Issues**:
   * Investigated the Laravel 13 `__PHP_Incomplete_Class` error when unserializing cached paginator structures under strict cache security configs.
   * Solved it securely without compromising `'serializable_classes' => false` by converting query paginators to raw attribute arrays before caching, and hydrating them back to Eloquent instances (`Task::hydrate`) dynamically in-memory on demand.
3. **Debugging Route Binding Errors**:
   * Resolved SQL Server datatype mismatch crashes (`nvarchar to bigint` conversion failure on `[id] = create`).
   * Detected and fixed the route order conflict where static paths (`tasks/create`) were mistakenly matched against wildcard routes (`/tasks/{task}`) by reordering routes in `web.php`.
4. **Optimizing Config & Version Setup**: Guided configurations, Git repo setups, and cache cleaning command-flows (`php artisan optimize:clear`).
