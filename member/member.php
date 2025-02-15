<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <title>회원가입</title>
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
        .signup-icon {
            font-size: 50px;
            margin-bottom: 10px;
            color: #28a745;
        }
    </style>
</head>
<body class="bg-light">

<div class="container">
    <div class="signup-icon">📝</div>
    <h2>회원가입</h2>

    <form action="member_ok.php" method="post">
        <div class="mb-3">
            <label class="form-label">아이디</label>
            <input type="text" name="username" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">이메일</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">비밀번호</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success w-100">회원가입</button>
    </form>

    <div class="mt-3">
        <a href="login.php" class="btn btn-outline-secondary w-100">로그인 페이지로 이동</a>
    </div>
</div>

</body>
</html>
