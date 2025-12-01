> 💡 **TAUTAN** <br>
> <br>
> 📖 Materi: [fajarbaskoro.blogspot.com](https://fajarbaskoro.blogspot.com/2022/11/membuat-upload-pas-foto-pelengkap.html) <br>
> 📄 Dokumentasi (Blogspot): [Blogspot](https://5025241239.blogspot.com/2025/12/pweb-pertemuan-12.html) <br>
<br>

Database:
```sql
CREATE DATABASE IF NOT EXISTS `pweb-pertemuan-12`;

USE `pweb-pertemuan-12`;

CREATE TABLE IF NOT EXISTS pendaftaran (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    telepon VARCHAR(50) NOT NULL,
    cabang VARCHAR(100) NOT NULL,
    kelas VARCHAR(100) NOT NULL,
    bukti_pembayaran VARCHAR(255) NOT NULL,
    tanggal_daftar TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

INSERT INTO admin (username, password) VALUES ('admin', '$2y$10$2MyUEBYNOUJCz.uw/gHW4O5Vf49RNuvJsL4U8LUwo2JcBgsC5FDcS');
```

`$2y$10$2MyUEBYNOUJCz.uw/gHW4O5Vf49RNuvJsL4U8LUwo2JcBgsC5FDcS` didapat dari `echo password_hash('123', PASSWORD_DEFAULT);`
