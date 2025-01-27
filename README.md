# ⛓‍💥 Web ShortLink
Web ShortLink merupakan sebuah aplikasi penyingkat URL berbasis web yang dibangun dengan menggunakan framework php yang bernama Laravel. Web ShortLink ini memiliki 2 role yang diterapkan pada pengguna, yaitu User dan Admin. Ketika melakukan login, terdapat sebuah sistem validasi yang menyalurkan pengguna ke halamannya masing-masing sesuai dengan role yang dimiliki pennguna. Pengguna Admin hanya akan bisa mengakses halaman untuk Admin saja, dan begitu juga untuk pengguna User. Setelah berhasil masuk, pada dashboard pengguna (baik itu Admin maupun User) memiliki fitur pengelolaan data. Teruntuk Admin, mereka memiliki akses kelola data terkait pembuatan, pengeditan, dan penghapusan shortlink semua akun.  Kemudian, untuk User hanya dapat melakukan pengelolaan shortlink yang hanya miliknya saja.

## 📋 Fitur Web ShortLink
- *Login dengan Validasi Role*:
  - *Admin*: Memiliki akses penuh untuk mengelola semua data, yaitu kelola shortlink dan user.
  - *User*: Hanya dapat mengakses fitur pengelolaan shortlink milik mereka sendiri.
- *Dashboard Admin*:
  - Membuat, mengedit, dan menghapus shortlink.
  - Mengelola data pengguna, seperti menambah dan menghapus akun user, juga reset password akun user.
- *Dashboard User*:
  - Membuat, mengedit, dan menghapus shortlink milik user sendiri.
- *Keamanan*: Validasi yang memastikan hanya pengguna berhak yang dapat mengakses fitur sesuai peran masing-masing.

## 📋 Demo Website

- **Link Demo**: [web.labhans.com](https://web.labhans.com/)

- *Login Admin*:
  - *Username*: admin
  - *Password*: adminpassword

- *Login User*:
  - *Username*: user
  - *Password*: password

## 👥 Anggota Kelompok
- 🧑‍💻 Farhan Adiaswara (2230511003)
- 🧑‍💻 Dani Akhmad Maulana (2230511007)
- 🧑‍💻 Arman Surahman (2230511032)