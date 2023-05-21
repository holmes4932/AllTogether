# Laravel 入門

## 先備知識

#### MVC 架構

## 變數命名規則

### 大駝峰

每個單字的起始字母大寫，其餘小寫
用於 class 的命名
```php=
class UserController
```

### 小駝峰 

除了開頭之外，每個單字的起始字母大寫，其餘小寫
用於 class 之外的命名
```php=
// func
public function getUser()

// var
$data = 1;
```
## Laravel 架構

![](https://hackmd.io/_uploads/By8AHkdBh.png)

#### Controller
Request 入口
```
app/Http/Controllers/
```
#### Service
定義商業邏輯
```
app/Services/
```
#### Repository
定義資料庫邏輯
```
app/Repositories/
```
#### Model
定義資料庫連線方式
```
app/Models/
```
#### View
前端
```
resources/views/
```
#### Route
定義所有 Web 及 API 路徑
```
routes
```
#### Migration
創建、修改或刪除資料表
```
database/migrations/
```
command
```php=
// 創建 migration 資料表
php artisan migrate:install

// 執行 migration
php artisan migrate

// 復原 migration
php artisan migrate:rollback
```
#### Seeder
更動資料庫資料
```
database/seeds/
```
command
```
php artisan db:seed
```
#### Vendor
laravel 的 library
```
vendor/
```
