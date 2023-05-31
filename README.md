<p align="center"><img src="/storage/app/images/snappfood.jpg" width="400" alt="Snapp Food"></p>


## Installation

#### 1. Clone the project
```bash
git clone https://github.com/aliomidvar1995/snappfood.git
```

#### 2. Run `composer install`
Navigate into project folder using terminal and run

```bash
cd project-name
```
```bash
composer install
```

#### 3. Copy `.env.example` into `.env`

```bash
cp .env.example .env
```

#### 4. Set encryption key

```bash
php artisan key:generate
```

#### 5. Run migrations

```bash
php artisan migrate --seed
```
