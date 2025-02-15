<?php
session_start();
include "../db.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['is_admin'] = $row['is_admin']; // ✅ Admin 여부 세션 저장

        header("Location: ../board/board.php");
        exit;
    } else {
        echo "<script>alert('로그인 실패. 아이디 또는 비밀번호를 확인하세요.'); history.back();</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>로그인</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            max-width: 500px;
            margin: 80px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .login-icon {
            font-size: 50px;
            margin-bottom: 10px;
            color: #007bff;
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="login-icon">🔑</div>
    <h2>로그인</h2>

    <form action="login.php" method="post">
        <div class="mb-3">
            <label class="form-label">아이디</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">비밀번호</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">로그인</button>
    </form>

    <div class="mt-3">
        <a href="member.php" class="btn btn-outline-secondary w-100">회원가입</a>
    </div>
</div>

</body>
</html>
