<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>게시판 홈</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    .container {
      max-width: 800px;
      margin: 80px auto;
      padding: 20px;
      text-align: center;
      background: #fff;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }
    .header {
      font-size: 32px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .btn-group {
      display: flex;
      justify-content: center;
      gap: 10px;
    }
    @media (max-width: 600px) {
      .btn-group {
        flex-direction: column;
      }
    }
  </style>
</head>
<body class="bg-light">

  <div class="container">
    <div class="header">📌 게시판에 오신 것을 환영합니다!</div>
    <p>원하는 메뉴를 선택하세요.</p>
    <div class="btn-group">
      <a href="board/board.php" class="btn btn-primary btn-lg">📋 게시판 바로가기</a>
      <a href="member/login.php" class="btn btn-success btn-lg">🔑 로그인</a>
      <a href="member/member.php" class="btn btn-info btn-lg">📝 회원가입</a>
    </div>
  </div>

</body>
</html>
