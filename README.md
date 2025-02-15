### 📌 **README.md (정리된 SQL 코드 - Admin 만들기까지)**  
```md
# 📌 Web Hacking Test - Database Setup

이 프로젝트는 웹 해킹 실습을 위한 **취약한 PHP 기반 게시판**입니다.  
이 문서는 **데이터베이스 및 테이블 생성**, **기본 계정 추가**, **Admin 계정 설정**까지의 SQL 명령어를 정리한 것입니다.  

---

## 📌 1️⃣ 데이터베이스 및 테이블 생성  
아래 명령어를 실행하여 **`bulletin_board`** 데이터베이스와 필요한 테이블을 생성하세요.  

```sql
-- 데이터베이스 생성 및 선택
CREATE DATABASE bulletin_board;
USE bulletin_board;
```

---

## 📌 2️⃣ `users` 테이블 (회원 관리)
회원 정보를 저장하는 `users` 테이블을 생성합니다.  
- `is_admin` 컬럼을 추가하여 **관리자 여부(0 = 일반 사용자, 1 = 관리자)** 를 구별합니다.  

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    is_admin TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 📌 3️⃣ `posts` 테이블 (게시판)
게시글을 저장하는 `posts` 테이블을 생성합니다.  
- `user_id`는 `users` 테이블과 연관되어 있으며, **작성자가 삭제되면 글도 삭제**되도록 설정합니다.  

```sql
CREATE TABLE posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

---

## 📌 4️⃣ 기본 계정 추가
회원가입을 거치지 않고, **기본 사용자 계정을 미리 추가**할 수 있습니다.  

```sql
-- 일반 사용자 계정 추가
INSERT INTO users (username, email, password, is_admin) 
VALUES ('testuser', 'test@example.com', 'password123', 0);
```

---

## 📌 5️⃣ Admin 계정 추가
아래 SQL을 실행하면 **Admin 계정**을 추가할 수 있습니다.  
- `is_admin` 값을 `1`로 설정하면 **모든 게시글을 수정/삭제할 수 있는 관리자 권한**을 갖게 됩니다.  

```sql
INSERT INTO users (username, email, password, is_admin) 
VALUES ('admin', 'admin@example.com', 'admin123', 1);
```

✅ **이제 `admin / admin123` 계정으로 로그인하면 관리자 권한을 가질 수 있습니다.**  
✅ **일반 사용자는 자신의 글만 수정/삭제 가능하며, Admin은 모든 글을 수정/삭제할 수 있습니다.**  



---
