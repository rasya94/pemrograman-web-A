> 💡 **TAUTAN** <br>
> <br>
> 📄 Dokumentasi (Blogspot): [Blogspot](https://5025241239.blogspot.com/2025/12/pweb-pertemuan-15.html) <br>
<br>

Database:
```sql
CREATE DATABASE IF NOT EXISTS sekolah;
USE sekolah;

CREATE TABLE IF NOT EXISTS siswa (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nis VARCHAR(50) NOT NULL,
  nama_siswa VARCHAR(255) NOT NULL,
  jenis_kelamin VARCHAR(10) NOT NULL,
  kelas VARCHAR(50) NOT NULL
);

INSERT INTO siswa (nis, nama_siswa, jenis_kelamin, kelas) VALUES
('1001','Ahmad Santoso','L','XII'),
('1002','Siti Aminah','P','XII'),
('1003','Budi Hartono','L','XII'),
('1004','Dewi Lestari','P','XII');
```
