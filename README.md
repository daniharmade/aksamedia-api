# Employee Management API

API sederhana untuk mengelola data karyawan, termasuk fitur upload gambar, validasi data, dan update informasi karyawan.

## Teknologi

- Laravel 11
- MySQL
- Laravel Storage (untuk upload file)
- UUID sebagai primary key

## Instalasi

```bash
git clone https://github.com/username/project-employee-api.git
cd project-employee-api
composer install
cp .env.example .env
php artisan key:generate
```

Edit konfigurasi database di file `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=employee_api
DB_USERNAME=root
DB_PASSWORD=
```

Lalu jalankan migrasi:

```bash
php artisan migrate
```

## Menjalankan Server

```bash
php artisan serve
```

---

## Endpoint API

### GET `/api/employees`

Ambil semua data karyawan.

### GET `/api/employees/{id}`

Ambil detail karyawan berdasarkan ID.

### POST `/api/employees`

Tambah karyawan baru.

#### Request Body:

| Field       | Tipe     | Wajib | Keterangan               |
|-------------|----------|-------|---------------------------|
| name        | string   | Ya    | Nama karyawan             |
| phone       | string   | Ya    | Nomor telepon             |
| division_id | UUID     | Ya    | ID divisi (relasi)        |
| position    | string   | Ya    | Jabatan karyawan          |
| image       | file     | Tidak | Foto karyawan (opsional)  |

### PUT `/api/employees/{id}`

Update data karyawan berdasarkan ID.

#### Request Body:

| Field       | Tipe     | Wajib | Keterangan                        |
|-------------|----------|-------|------------------------------------|
| name        | string   | Tidak | Nama karyawan                     |
| phone       | string   | Tidak | Nomor telepon                     |
| division_id | UUID     | Tidak | ID divisi (relasi)                |
| position    | string   | Tidak | Jabatan karyawan                  |
| image       | file     | Tidak | Gambar baru, akan ganti yang lama |

Contoh cURL:

```bash
curl -X PUT http://localhost:8000/api/employees/{id}   -H "Accept: application/json"   -F "name=John Doe"   -F "phone=081234567890"   -F "image=@/path/to/photo.jpg"
```

---

## Struktur Folder Penting

- `app/Http/Controllers/EmployeeController.php` – logika utama untuk CRUD karyawan.
- `app/Http/Requests/EmployeeUpdateRequest.php` – validasi update karyawan.
- `app/Models/Employee.php` – model karyawan dengan UUID dan relasi ke divisi.
- `storage/app/public/employees/` – folder upload gambar.

---

## Catatan

- Gambar disimpan di `storage/app/public/employees`, dan diakses melalui `Storage::url()`.
- UUID di-generate otomatis saat insert (`creating` di model).
- Field `name`, `phone`, dan lainnya bersifat *conditionally updated* saat update.
- Pastikan menjalankan `php artisan storage:link` agar gambar bisa diakses melalui URL publik.

---

## Kontributor

Dibuat oleh: **Dani Harmade**  
