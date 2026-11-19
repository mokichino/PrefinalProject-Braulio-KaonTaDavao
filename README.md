# Kaon Ta! Davao – Braulio's Food Guide

**Developer:** Alessandra Veronica Braulio  
**Course:** CS Elective 2 – Full-Stack Development (Laravel)  
**Project:** Prefinal Milestone – Kaon Ta! Davao: Carinderia and Eatery Guide

## Setup Commands (Windows PowerShell)

```powershell
composer install
Copy-Item .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File -Force
php artisan migrate:fresh --seed
npm install
npm run build
php artisan serve
```

Set `.env` to use SQLite:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

A successful seed reports migration and seeding completion with output ending in:

```text
INFO  Seeding database.
INFO  Database seeding completed successfully.
```

## Personalized Data

- Site title: **Kaon Ta! Davao – Braulio's Food Guide**
- Developer: Alessandra Veronica Braulio
- Lowercase name: braulio
- Birthday: June 24 (MMDD: 0624)

### Districts

Poblacion, Talomo, Agdao, Buhangin, Toril, Bunawan

### Features

Suki ni Braulio, Budget Meal, Halal, Open 24 Hours, Aircon, Live Music

### Seeded Users

| Name | Email | Password |
| --- | --- | --- |
| Alessandra Veronica Braulio | braulio@kaonta.test | kaonta2026 |
| Tita Braulio | tita.braulio@kaonta.test | kaonta2026 |

Ten additional factory users bring the total to 12 users.

### Seed Counts

- 1 handmade eatery: Carinderia ni Braulio
- Exactly 14 factory eateries
- Exactly 3 closed factory eateries
- 1 permit per eatery
- 2–5 dishes per factory eatery
- 1–3 features per factory eatery
- Open eateries receive 0–6 reviews; closed eateries receive none

### Handmade Eatery

- Name: Carinderia ni Braulio
- Slug: `carinderia-ni-braulio`
- District: Poblacion
- Address: San Pedro St., Poblacion, Davao City
- Price range: budget
- Specialty: Tinolang Manok
- Status: open
- Features: Suki ni Braulio and Budget Meal
- Permit: DVO-2026-0624
- Permit expiry: June 24, 2027

## Relationship Table

| Relationship | Type | Why it fits |
| --- | --- | --- |
| District → Eateries | hasMany / Eatery belongsTo District | One district contains many eateries, while each eatery belongs to only one district. |
| Eatery → Dishes | hasMany / Dish belongsTo Eatery | An eatery can offer several dishes, and each dish belongs to one eatery. |
| Eatery → Reviews | hasMany / Review belongsTo Eatery | One eatery can receive many reviews, and every review belongs to one eatery. |
| User → Reviews | hasMany / Review belongsTo User | One user may write several reviews, but each review has one reviewer. |
| Eatery → Permit | hasOne / Permit belongsTo Eatery | Each eatery has a single permit record. |
| Eatery ↔ Features | belongsToMany | An eatery may have several features and a feature may appear on many eateries. |
| District → Reviews through Eateries | hasManyThrough | District reviews are reached through eateries. |

## Verification

```powershell
php artisan migrate:fresh --seed
php artisan route:list
npm run build
php artisan test
```

## Screenshots

Required screenshots are stored in `screenshots/`:

- `eatery-list.png` – eatery list with cards and filters
- `eatery-page.png` – eatery page with dishes and reviews
- `create-validation.png` – create eatery form showing actual validation errors
