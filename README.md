<h1>Simple To Do Backend</h1>

## Requirement

- PHP >= 8.x
- Composer
- XAMPP (includes Apache, MySQL, PhpMyAdmin)
- Laravel >= 9.x

## Instalasi

- clone repository ini
  ```bash
  git clone https://github.com/bima-taruna/BE-INT-AD-Mhd-Bima-Taruna-Cipta.git
  cd BE-INT-AD-Mhd-Bima-Taruna-Cipta
    ```
- Install Dependencies dengan composer
  ```bash
     composer install
    ```
- Buat Database
  Buka xampp anda, aktifkan apache dan mySQL lalu buat database di phpMyAdmin

- Ubah env
  Kembali ke project, ubah nama .env.example ke .env lalu ubah variabel berikut :
  ```
    DB_DATABASE=laravel
  ```
  menjadi seperti ini :

   ```
    DB_DATABASE=nama_database_anda
  ```
- Pada terminal masukkan perintah berikut untuk menggenerate jwt-key:
  ```
    php artisan jwt:secret
  
  ```
- Lalu jalankan perintah berikut untuk membuat tabel pada database ;
  ```
    php artisan migrate
  ```
- Jalankan Projek ini dengan perintah :
  ```
  php artisan serve
  ```
  Projek akan berjalan di alamat http://localhost:8000.
  dan format api adalah http://localhost:8000/api/v1/[endpoint]

  jangan lupa untuk memasukkan token pada header dengan format :
  ```
   Authorization : Bearer [token]
  ```

  berikut adalah endpoint yang tersedia :

  ## Available Endpoints

| Method | URI                   | Description                  | Auth Required |
|--------|------------------------|------------------------------|---------------|
| POST   | `/api/v1/register`     | Registrasi user baru           | No            |
| POST   | `/api/v1/login`       | Login and mendapatkan token JWT     | No            |
| GET    | `/api/v1/user`          | mendapatkan data user yang telah login   | Yes           |
| POST   | `/api/v1/logout`      | Logout              | Yes           |
| GET    | `/api/v1/tasks`            | mendapatkan data task dari user          | Yes           |
| POST   | `/api/v1/tasks`            | membuat task baru            | Yes           |
| GET    | `/api/v1/tasks/{id}` //NOT TESTED  YET    | Get details of a specific task| Yes           |
| PUT    | `/api/v1/tasks/{id}` //NOT TESTED  YET    | Update a task                 | Yes           |
| DELETE | `/api/v1/tasks/{id}` //NOT TESTED YET      | Delete a task                 | Yes           |
  
  
