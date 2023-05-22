# 專案部署流程

### 將專案 clone 到本地端

```
git clone https://github.com/holmes4932/AllTogether.git 
```

### 複製 env

```
cp php/env/local.env php/env/.env  
```

### 啟動 docker

```
docker-compose up -d
```

### 進入 app container

```
docker exec -it app sh
```


### 下載 php library

```
composer install
```


### 產生 APP_KEY

```
php artisan key:generate
```

### 初始化資料庫

```
php artisan migrate:install
php artisan migrate
```

### 初始化資料庫資料 (optional)

```
php artisan db:seed
```
如果在這個階段遇到 
```
Target class [xxxSeeder] does not exist.
```
的問題，要更新 composer
```
composer update
```