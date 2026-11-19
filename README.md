# Kaon Ta! Davao – Braulio's Food Guide

**Developer:** Alessandra Veronica Braulio  
**Course:** CS Elective 2 – Full-Stack Development (Laravel)  
**Project:** Prefinal Milestone – Kaon Ta! Davao: Carinderia and Eatery Guide

## Setup Commands

```powershell
composer install
copy .env.example .env
php artisan key:generate
New-Item database/database.sqlite -ItemType File
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

## Personalized Data

- Site title: **Kaon Ta! Davao – Braulio's Food Guide**
- First name: Alessandra Veronica
- Last name: Braulio
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
| Eatery → Permit | hasOne / Permit belongsTo Eatery | Each eatery has a single permit record in this guide. |
| Eatery ↔ Features | belongsToMany on eatery_feature | An eatery may have several features and a feature may appear on many eateries. |
| District → Reviews through Eateries | hasManyThrough | The district is connected to reviews indirectly through its eateries. |

## Route List

```text
GET|HEAD        / .................................... home › HomeController
GET|HEAD        districts ........ districts.index › DistrictController@index
GET|HEAD        districts/{district} ........ districts.show › DistrictController@show
GET|HEAD        eateries ........ eateries.index › EateryController@index
POST            eateries ........ eateries.store › EateryController@store
GET|HEAD        eateries/create ........ eateries.create › EateryController@create
GET|HEAD        eateries/{eatery} ........ eateries.show › EateryController@show
PUT|PATCH       eateries/{eatery} ........ eateries.update › EateryController@update
DELETE          eateries/{eatery} ........ eateries.destroy › EateryController@destroy
GET|HEAD        eateries/{eatery}/edit ........ eateries.edit › EateryController@edit
POST            eateries/{eatery}/reviews ........ eateries.reviews.store › ReviewController@store
GET|HEAD        reviewers/{user} ........ reviewers.show › ReviewerController@show
DELETE          reviews/{review} ........ reviews.destroy › ReviewController@destroy
```

## Screenshots

The required screenshots are stored in `screenshots/`:

- `eatery-list.png` – eatery list with cards and filters
- `eatery-page.png` – eatery page with dishes and reviews
- `create-validation.png` – create eatery form showing validation errors
