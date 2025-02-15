<?php
include "../db.php";

$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// ✅ 중복 아이디 검사
$check_sql = "SELECT * FROM users WHERE username = '$username' OR email = '$email'";
$check_result = mysqli_query($conn, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    echo "<script>alert('이미 사용 중인 아이디 또는 이메일입니다. 다른 값을 입력하세요.'); location.href='member.php';</script>";
    exit;
}

// ✅ 회원가입 진행
$sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
mysqli_query($conn, $sql);

echo "<script>alert('회원가입이 완료되었습니다.'); location.href='login.php';</script>";
?>
