> 💡 **TAUTAN** <br>
> <br>
> 📄 Dokumentasi (Blogspot): [Blogspot](https://5025241239.blogspot.com/2025/12/tugas-13-pweb-news-portal-data-diri.html) <br>
<br>

Database:
```sql
CREATE DATABASE news_portal;
USE news_portal;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50),
  password VARCHAR(255),
  fullname VARCHAR(100)
);

CREATE TABLE categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100),
  slug VARCHAR(120)
);

CREATE TABLE news (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(200),
  slug VARCHAR(220),
  content TEXT,
  image VARCHAR(255),
  category_id INT,
  author_id INT,
  status ENUM('draft','published'),
  published_at DATETIME,
  created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO categories (name,slug) VALUES
('Technology','technology'),
('Politics','politics'),
('Sports','sports');
```
