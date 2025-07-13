<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Documentation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h1 class="mb-4 text-center">📘 API Documentation - Employee Management</h1>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">POST /api/login</div>
        <div class="card-body">
            <p>Melakukan login untuk mendapatkan token autentikasi.</p>
            <strong>Body:</strong>
            <pre>
username: string
password: string
            </pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "message": "Login berhasil",
    "token": "your_token"
}</pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">POST /api/logout</div>
        <div class="card-body">
            <p>Logout dari sistem. Token akan menjadi tidak berlaku.</p>
            <strong>Headers:</strong>
            <pre>Authorization: Bearer {token}</pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "message": "Logout berhasil"
}</pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">GET /api/employees</div>
        <div class="card-body">
            <p>Mengambil daftar semua karyawan.</p>
            <strong>Headers:</strong>
            <pre>Authorization: Bearer {token}</pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "data": [
        {
            "id": "uuid",
            "name": "Nama Karyawan",
            ...
        }
    ]
}</pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">POST /api/employees</div>
        <div class="card-body">
            <p>Menambahkan data karyawan baru.</p>
            <strong>Headers:</strong>
            <pre>Authorization: Bearer {token}</pre>
            <strong>Body (multipart/form-data):</strong>
            <pre>
name: string
phone: string
position: string
division_id: UUID
image: file (optional)
            </pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "message": "Berhasil menambahkan karyawan",
    "data": {...}
}</pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">PUT /api/employees/{id}</div>
        <div class="card-body">
            <p>Memperbarui data karyawan berdasarkan ID.</p>
            <strong>Headers:</strong>
            <pre>Authorization: Bearer {token}</pre>
            <strong>Body (multipart/form-data):</strong>
            <pre>
name: string (optional)
phone: string (optional)
position: string (optional)
division_id: UUID (optional)
image: file (optional)
            </pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "message": "Data karyawan berhasil diperbarui",
    "data": {...}
}</pre>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-header bg-primary text-white">DELETE /api/employees/{id}</div>
        <div class="card-body">
            <p>Menghapus data karyawan berdasarkan ID.</p>
            <strong>Headers:</strong>
            <pre>Authorization: Bearer {token}</pre>
            <strong>Response:</strong>
            <pre>{
    "status": "success",
    "message": "Berhasil menghapus karyawan"
}</pre>
        </div>
    </div>

    <footer class="text-center mt-4">
        <small>© {{ date('Y') }} Employee API by Dani Harmade</small>
    </footer>
</div>
</body>
</html>
