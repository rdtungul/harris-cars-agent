---
name: laravel-site-builder
description: >
  Full-stack Laravel website builder. Use whenever a user wants to build,
  scaffold, or generate a complete Laravel site from scratch — including Docker
  setup, MySQL migrations, Eloquent models, controllers, Blade views, admin
  CRUD panels, Zoho Web Forms integration, TailwindCSS, and deployment config.

  Trigger for: "build this site in Laravel", "scaffold a Laravel app",
  "rebuild [site] in Laravel", "Laravel + Docker setup", "create a business
  site with Laravel", "set up Laravel with MySQL", "Laravel admin panel",
  or any request combining a site description with Laravel, PHP, or LAMP/LEMP.

  Generates production-ready file trees with real working code — not outlines.
  Covers all 10 build phases: Docker, Laravel scaffold, database & models,
  routes & controllers, Blade views, Zoho webhook integration, frontend assets,
  admin panel, seeders, and README with deploy checklist.
---

# Laravel Full-Site Builder Agent

## Overview

This skill guides Claude through generating a **complete, production-ready
Laravel website** from a user's site description or reference URL. The output
is a fully structured file tree with real, working code in every file —
suitable for a junior developer to drop into a repo and run immediately.

---

## Phase 0 — Understand the Site

Before writing any code, extract the following from the user's request or
reference site. Ask only what you cannot infer:

| Question | Why it matters |
|---|---|
| What type of business / site? | Shapes pages, services, CTAs |
| Does it need a booking / contact form? | Determines Zoho or custom form strategy |
| Does it need user authentication? | Adds Laravel Breeze/Sanctum |
| Does it need an admin panel? | Adds full CRUD backend |
| Any third-party integrations? | Zoho, Google Maps, Stripe, etc. |
| Preferred Docker or bare-metal? | Determines environment layer |

If the user provided a reference URL, treat the visible site structure
(pages, nav items, services listed) as the spec. Infer reasonable defaults
for everything not explicitly stated.

---

## Phase 1 — Docker Environment

Always generate Docker-first unless the user explicitly says bare-metal.

### Files to generate

```
docker-compose.yml
docker/php/Dockerfile
docker/nginx/default.conf
docker/mysql/init.sql          (optional — seed DB name/charset)
docker/php/local.ini           (PHP config: upload_max_filesize, etc.)
```

### docker-compose.yml must include

- `app` — PHP 8.2-FPM container (built from `docker/php/Dockerfile`)
- `nginx` — `nginx:1.25-alpine`, port `8080:80`
- `db` — `mysql:8.0`, with named volume, env vars for DB name/user/pass
- `redis` — `redis:7-alpine` for cache, sessions, queues
- `phpmyadmin` — optional, port `8081:80` for easy DB browsing

### Dockerfile must install

```dockerfile
# Extensions: pdo_mysql mbstring exif pcntl bcmath gd zip
# Extras: Composer (from composer:latest), Node.js 20.x (for Vite)
# User: create non-root www user (uid 1000)
```

### Nginx config must

- Set `root` to `/var/www/html/public`
- Include `try_files $uri $uri/ /index.php?$query_string`
- Add security headers (X-Frame-Options, X-Content-Type-Options)
- Enable gzip for CSS/JS/JSON
- Cache static assets 1 year

---

## Phase 2 — Laravel Scaffold

### Bootstrap commands (document in README.md)

```bash
docker-compose up -d
docker-compose exec app bash
composer create-project laravel/laravel .
php artisan key:generate
php artisan storage:link
```

### Always generate

```
.env                          (all vars; DB_HOST=db for Docker)
.env.example                  (same structure, values blanked)
routes/web.php                (all public routes)
routes/admin.php              (admin-only routes, required by web.php)
app/Http/Middleware/AdminMiddleware.php
app/Providers/AppServiceProvider.php   (register admin middleware alias)
config/zoho.php               (if Zoho integration needed)
README.md                     (setup steps, Docker commands, URLs)
```

### .env required keys

```
APP_NAME, APP_ENV, APP_KEY, APP_DEBUG, APP_URL
DB_CONNECTION=mysql, DB_HOST=db, DB_PORT=3306, DB_DATABASE, DB_USERNAME, DB_PASSWORD
CACHE_STORE=redis, SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
REDIS_HOST=redis
MAIL_MAILER, MAIL_FROM_ADDRESS
GOOGLE_MAPS_API_KEY           (if map embed used)
ZOHO_WEBHOOK_SECRET           (if Zoho used)
```

---

## Phase 3 — Database & Models

### Standard tables for a business/service site

| Table | Key columns |
|---|---|
| `users` | id, name, email, password, role, timestamps |
| `service_categories` | id, name, slug, order, timestamps |
| `services` | id, category_id, title, slug, short_description, description, icon, image, price_range, is_active, is_featured, order, meta_title, meta_description, timestamps |
| `appointments` | id, service_id, customer_name, email, phone, vehicle_*, preferred_date, preferred_time, notes, status (enum), source, timestamps |
| `testimonials` | id, customer_name, customer_location, rating (tinyint), review, service_id, is_approved, is_featured, source, timestamps |
| `gallery` | id, image_path, caption, alt_text, category, order, is_active, timestamps |
| `settings` | id, key (unique), value (longText), type, group, timestamps |
| `zoho_form_submissions` | id, form_name, payload (json), processed_at, timestamps |
| `pages` | id, slug, title, content (json), meta_title, meta_description, timestamps |

Add or remove tables based on the site type.

### For each model generate

- `$fillable` array covering all mass-assignable columns
- `$casts` (booleans, dates, JSON, integers)
- All Eloquent relationships (`belongsTo`, `hasMany`, `belongsToMany`)
- Named scopes: `active()`, `featured()`, `approved()`, `pending()`
- Computed accessors: `imageUrlAttribute`, `starsAttribute`, `statusBadgeColorAttribute`

### Migration rules

- One migration file per table
- Use `foreignId()->constrained()->nullOnDelete()` for FK columns
- Define enums with `->enum()` and document allowed values in a `const`
- Always include `timestamps()`

---

## Phase 4 — Routes & Controllers

### Public routes pattern (routes/web.php)

```php
// Pages
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/services', [ServicesController::class, 'index'])->name('services.index');
Route::get('/services/{slug}', [ServicesController::class, 'show'])->name('services.show');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/testimonials', [TestimonialController::class, 'index'])->name('testimonials');

// Forms
Route::get('/book', [AppointmentController::class, 'create'])->name('appointments.create');
Route::post('/book', [AppointmentController::class, 'store'])->name('appointments.store');
Route::post('/testimonials', [TestimonialController::class, 'store'])->name('testimonials.store');

// Zoho webhook (CSRF exempt — add URL to VerifyCsrfToken $except array)
Route::post('/zoho/webhook', [ZohoWebhookController::class, 'handle'])->name('zoho.webhook');
```

### Admin routes pattern (routes/admin.php)

```php
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('services', ServiceController::class);
    Route::patch('services/{service}/toggle', [ServiceController::class, 'toggle']);
    Route::resource('appointments', AppointmentController::class)->only(['index','destroy']);
    Route::patch('appointments/{appointment}/status', [AppointmentController::class, 'updateStatus']);
    Route::resource('testimonials', TestimonialController::class)->only(['index','destroy']);
    Route::patch('testimonials/{testimonial}/approve', [TestimonialController::class, 'approve']);
    Route::resource('gallery', GalleryController::class)->except(['show']);
    Route::get('settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::post('settings', [SettingsController::class, 'update'])->name('settings.update');
});
```

### Controller conventions

- Every `store()` / `update()` must call `$request->validate([...])`
- File uploads use `$request->file('image')->store('folder', 'public')`
- Redirects use named routes: `redirect()->route('admin.services.index')`
- Flash messages: `->with('success', '...')` or `->with('error', '...')`
- Use `firstOrFail()` for slug lookups, never `find()` without null check
- Admin controllers live in `app/Http/Controllers/Admin/` namespace

---

## Phase 5 — Blade Views

### Layout structure

```
resources/views/
├── layouts/
│   ├── app.blade.php        (public master: nav + footer + @yield('content'))
│   └── admin.blade.php      (admin master: sidebar + @yield('content'))
├── partials/
│   ├── nav.blade.php
│   ├── footer.blade.php
│   └── flash.blade.php
├── pages/
│   ├── home.blade.php
│   ├── services.blade.php
│   ├── service-detail.blade.php
│   ├── about.blade.php
│   ├── contact.blade.php
│   ├── gallery.blade.php
│   ├── testimonials.blade.php
│   ├── book.blade.php
│   └── booking-confirmation.blade.php
├── admin/
│   ├── dashboard.blade.php
│   ├── services/index.blade.php, create.blade.php, edit.blade.php
│   ├── appointments/index.blade.php
│   ├── testimonials/index.blade.php
│   ├── gallery/index.blade.php
│   └── settings/index.blade.php
└── emails/
    ├── appointment-confirmation.blade.php
    └── appointment-notification.blade.php
```

### Layout requirements

**`layouts/app.blade.php` must include:**
- `<meta charset>`, viewport, CSRF token meta tag
- `@yield('title')` in `<title>` with site name fallback
- `@yield('meta_description')` in meta description
- Google Fonts link (choose fonts appropriate to the brand)
- `@vite(['resources/css/app.css', 'resources/js/app.js'])`
- `@stack('styles')` before `</head>`
- `@include('partials.nav')`
- `@include('partials.flash')` (session success/error banners)
- `<main>@yield('content')</main>`
- `@include('partials.footer')`
- `@stack('scripts')` before `</body>`

### Homepage sections (minimum)

1. **Hero** — full-height or large, headline, subtext, two CTAs, stats bar
2. **Featured Services** — card grid (3-col on desktop), icon, title, short desc, price
3. **Why Choose Us** — icon list of trust signals (certified, warranty, honest, fast)
4. **CTA Banner** — strong call-to-action with phone number + book button
5. **Testimonials** — 3-col card grid with star rating, quote, customer name
6. **Map Embed** — Google Maps iframe, full-width

### Design aesthetic rules

- Fonts: choose one strong display font (Bebas Neue, Oswald, Syne, or similar)
  paired with a clean body font (Barlow, DM Sans, Outfit). Never Inter/Roboto.
- Colors: commit to a dominant palette. For auto/industrial: dark navy + red accent.
  For medical/clean: deep teal + warm white. For luxury: charcoal + gold.
- Use `font-bebas` (or equivalent) for all H1/H2 headings via Tailwind custom font
- No generic card shadows everywhere — use border accents, colored left borders, or
  subtle background fills for variety
- Mobile-first: every section must stack gracefully on small screens

---

## Phase 6 — Zoho Web Forms Integration

### When to add Zoho

Add Zoho integration whenever the user mentions:
- Zoho, Zoho CRM, Zoho Web Forms
- "embed a form", "connect to our CRM", "Zoho leads"

### Four standard forms to create in Zoho

| Form name | Fields | Embed location |
|---|---|---|
| Contact Us | Name, Email, Phone, Message | /contact page |
| Book an Appointment | Name, Email, Phone, Service, Preferred Date, Vehicle, Notes | /book page |
| Leave a Review | Name, Rating, Review | /testimonials page |
| Get a Quote | Name, Email, Phone, Vehicle info, Service needed | /quote page |

### Embedding pattern

Store the raw Zoho embed HTML in the `settings` table (key: `zoho_contact_form_embed`).
Render it with unescaped output — **never** `{{ }}` for embed codes:

```blade
{!! setting('zoho_contact_form_embed', '<p>Form not configured.</p>') !!}
```

Provide a global `setting()` helper function in `app/helpers.php`:

```php
function setting(string $key, $default = null): mixed {
    return \App\Models\Setting::where('key', $key)->value('value') ?? $default;
}
```

Register in `composer.json` autoload files section.

### Webhook handler

```php
// app/Http/Controllers/ZohoWebhookController.php
public function handle(Request $request): JsonResponse
{
    // 1. Verify secret header
    if ($request->header('X-Zoho-Webhook-Secret') !== config('zoho.webhook_secret')) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // 2. Log every submission
    ZohoFormSubmission::create([
        'form_name'    => $request->input('form_name', 'unknown'),
        'payload'      => $request->all(),
        'processed_at' => now(),
    ]);

    // 3. Route to appropriate model
    match ($request->input('form_name')) {
        'Appointment Booking' => $this->createAppointment($request),
        'Leave a Review'      => $this->createTestimonial($request),
        default               => null,
    };

    return response()->json(['status' => 'ok']);
}
```

Add the webhook route to `VerifyCsrfToken::$except`:

```php
protected $except = ['/zoho/webhook'];
```

---

## Phase 7 — Frontend Assets

### Required files

```
tailwind.config.js
vite.config.js
resources/css/app.css
resources/js/app.js
resources/js/bootstrap.js
package.json               (include tailwindcss, @tailwindcss/forms, alpinejs, vite, laravel-vite-plugin)
```

### tailwind.config.js

```js
export default {
  content: ['./resources/**/*.blade.php', './resources/**/*.js'],
  theme: {
    extend: {
      fontFamily: {
        display: ['"Bebas Neue"', 'sans-serif'],   // adjust to chosen font
        body:    ['Barlow', 'sans-serif'],
      },
      colors: {
        brand: { primary: '#DC2626', dark: '#0F172A' }
      }
    }
  },
  plugins: [require('@tailwindcss/forms'), require('@tailwindcss/typography')]
}
```

### vite.config.js — Docker HMR fix

```js
server: {
  host: '0.0.0.0',   // REQUIRED inside Docker
  port: 5173,
  hmr: { host: 'localhost' }
}
```

### Alpine.js usage patterns

Use Alpine for: mobile nav toggle, gallery lightbox, accordion FAQs, form
step wizards. Always `x-data` on the wrapping element, never global state.

---

## Phase 8 — Admin Panel

### Admin layout (`layouts/admin.blade.php`)

- Fixed left sidebar: logo, nav links to each admin section, logout
- Top bar: page title, notification bell (pending appointments count)
- Main content area: `@yield('content')`
- Sidebar active state: `{{ request()->routeIs('admin.services.*') ? 'bg-gray-800' : '' }}`

### Dashboard stats cards

Always show: Pending Appointments, Total Appointments, Pending Reviews, Active Services.
Use colored left-border cards (yellow/pending, blue/total, orange/reviews, green/active).

### Data tables

All admin list views must have:
- `<table>` with `<thead>` (gray bg, uppercase, xs text) and `<tbody>` (hover bg)
- Action buttons: Edit (blue), Toggle Active (yellow), Delete (red, with confirm)
- Empty state row: `<td colspan="n">No records yet.</td>`
- Pagination: `{{ $items->links() }}`

### Settings page

The settings page is the CMS. It must include fields for:
- Phone, Address, Business Hours (textarea), Email
- Zoho embed codes (each form, textarea)
- Google Maps embed URL
- Social media links
- Hero headline and subtext
- Meta tags (site-wide defaults)

All saved with `Setting::updateOrCreate(['key' => $key], ['value' => $value])`.

---

## Phase 9 — Seeders & Demo Data

Always generate a `DatabaseSeeder.php` that seeds:

- 1 admin user (email: `admin@site.com`, password: `password`, role: `admin`)
- 4–6 service categories with slugs
- 8–12 services (2 per category, mixed featured)
- 5–8 approved testimonials (varied ratings)
- Default settings rows (phone placeholder, address placeholder, etc.)

Use `Model::factory()->create()` where factories exist; use direct `Model::create()`
for settings/categories where factory overhead isn't worth it.

---

## Phase 10 — README.md

Always generate a `README.md` at the project root with:

```markdown
# [Site Name] — Laravel Application

## Tech Stack
[list]

## Quick Start (Docker)
1. cp .env.example .env
2. docker-compose up -d
3. docker-compose exec app composer install
4. docker-compose exec app php artisan key:generate
5. docker-compose exec app php artisan migrate --seed
6. docker-compose exec app npm install && npm run dev
7. Open http://localhost:8080

## Admin Panel
URL: http://localhost:8080/admin
Email: admin@sample.com
Password: admin1234

## Zoho Web Forms Setup
[step-by-step: create form, get embed code, paste in Admin > Settings]

## Deployment Checklist
[.env changes, APP_ENV=production, cache commands, storage:link]
```

---

## Output Format

When generating files, present them in **phase order**. For each file:

1. Show the full file path as a code block header comment
2. Provide the complete file content — no `// ... rest of file` shortcuts
3. After all files, output a **Next Steps** section with the exact terminal
   commands to run to get the site live

If generating a React artifact agent UI (interactive file browser), follow
the pattern in `references/agent-ui.md` for the phased pipeline + log panel
+ file tree + code viewer layout.

---

## Common Mistakes to Prevent

| Mistake | Fix |
|---|---|
| CSRF error on Zoho webhook | Add route to `VerifyCsrfToken::$except` |
| XSS via Zoho embed | Use `{!! !!}` only for trusted embed codes; `{{ }}` for all user input |
| N+1 queries | Always eager load: `Service::with('category')->get()` |
| Uploads in `public/` | Use `storage/app/public/` + `php artisan storage:link` |
| Hardcoded credentials | All secrets in `.env`; `.env` in `.gitignore` |
| Docker HMR fails | Set `server.host: '0.0.0.0'` in `vite.config.js` |
| Mass assignment error | Define `$fillable` on every model |
| Missing `nullOnDelete()` | Always add to foreign key constraints |
| Admin 403 loop | Ensure `AdminMiddleware` checks `auth()->check()` first |
| Slug collision | Use `Str::slug()` + unique DB index on `slug` column |

---

## Reference Files

For complex subsections, read these before generating:

- `references/docker-templates.md` — Full Dockerfile and docker-compose templates
- `references/blade-components.md` — Reusable Blade component patterns
- `references/admin-crud-template.md` — Full CRUD controller + views boilerplate
- `references/zoho-integration.md` — Zoho API, webhook, and embed deep dive
- `references/deployment.md` — Production server setup, SSL, caching, queues
