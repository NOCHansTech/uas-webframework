<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404 - Halaman Tidak Ditemukan</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap">
    <style>
        /* CSS dasar untuk tampilan halaman 404 */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
            text-align: center;
        }

        .container {
            max-width: 600px;
            padding: 40px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            position: relative;
        }

        h1 {
            font-size: 100px;
            margin: 0;
            color: #3a7bd5;
        }

        h2 {
            font-size: 24px;
            color: #555;
        }

        p {
            font-size: 16px;
            color: #777;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3a7bd5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        a:hover {
            background-color: #2c6ca5;
        }

        small {
            font-size: 12px;
            color: #aaa;
            display: block;
            margin-top: 30px;
        }

        /* Mengubah link Powered by menjadi teks biasa */
        small a {
            color: #3a7bd5; /* Warna biru */
            text-decoration: none; /* Menghilangkan garis bawah */
            font-weight: normal; /* Menghilangkan bold */
            background: none; /* Menghapus latar belakang */
            border: none; /* Menghapus border */
            padding: 0; /* Menghapus padding */
            font-size: inherit; /* Menggunakan ukuran font yang sama dengan elemen di sekitarnya */
        }

        small a:hover {
            text-decoration: underline; /* Menambahkan garis bawah saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <h2>Halaman Tidak Ditemukan</h2>
        <p>Maaf, halaman yang Anda cari tidak ada atau telah dihapus.</p>
        <a href="/">Kembali ke Beranda</a>
        <small>Powered by: <a href="" target="_blank">Tugas Web Framework</a></small>
    </div>
</body>
</html>
