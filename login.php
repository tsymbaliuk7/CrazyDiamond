
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="http://localhost/CrazyDiamond/style.css">
    <link rel="stylesheet" href="bootstrap-grid.min.css">
    <title>Реєстрація | Crazy Diamond Barber Shop</title>
</head>
<body>
<div class="lines">
    <div class="line1"></div>
    <div class="line2"></div>
</div>
<div class="container">
        <form class="sign-in d-flex flex-column justify-content-center align-items-center" method="POST">
            <h1>Реєстрація</h1>
            <label>
                <input type="text" name="login" class="text_bar" placeholder="Логін" required>
            </label>
            <label>
                <input type="password" name="password" class="text_bar" placeholder="Пароль" required>
            </label>
            <div class="massage">
            <?php
            session_start();
            require 'connect_db.php';
            if(isset($_POST['login']) && isset($_POST['password'])){
                $error=[];
                $login = htmlspecialchars($_POST['login']);
                $password = htmlspecialchars($_POST['password']);
                if(!preg_match("/^[a-zA-Z0-9]/",$login)){
                    $error[] = "Логін може містити тільки латинські літери та цифри";
                }
                if(strlen($login) < 3){
                    $error[] = "Логін повинен бути не менше 3 символів";
                }
                if(strlen($password) < 5){
                    $error[] = "Пароль повинен бути не менше 5 символів";
                }
                $query = mysqli_query($connect, "SELECT id FROM users WHERE username='".mysqli_real_escape_string($connect, $login)."'");
                if(mysqli_num_rows($query) > 0) {
                    $error[] = "Користувач з таким логіном уже існує";
                }
                if(count($error) == 0){
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $sql = "INSERT INTO users (username, password) VALUES ('$login', '$password')";
                    mysqli_query($connect, $sql);
                    $connect->close();
                    $_SESSION['login']=$login;
                    header('Location: index.php?page=Main_author');
                    exit();
                }
                else {
                    foreach ($error as $err){
                        echo "<p>$err</p>";
                    }
                }
            }
            ?>
            </div>
            <button class="button1">Зареєструватись</button>
        </form>
    </div>
</div>
<div class="lines">
    <div class="line1"></div>
    <div class="line2"></div>
</div>
</body>
</html>