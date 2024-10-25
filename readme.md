# Cara run project 

## untuk development Font End 

```
npm install 
npm run dev 
```

## untuk backend 

> - Pertama import peduli_rasa.sql ke database mysql kamu
> - selanjutnya atur user dan password database difolder config

```
cd config/
```
> - ubah pada bagian 

```php

"prod" => [
    "url" => "mysql:host=localhost:3306;dbname=peduli_rasa",
    "username" => "user mysql", 
    "password" => "password user mysql"
]

```

> - masuk ke folder public terlebih dahulu 
> - jalankan perintah dengan php versi 8 atau lebih

```
php -S localhost:3000
```

## Untuk prod 
> - bisa memakai laragon sebagai local server ,kemudian jalankan melalui virtual host
> - jika memakai xampp maka kamu harus membuat virtual host nya terlebih dahulu
> - file yang harus dijalankan yaitu file index.php yang berada di folder public

```
cd public/
```
