<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>Magebit</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/main.css" />
</head>
<body>
    <header>
    </header>

    <main>
        <div class="container">
            <div id="main">
                <div class="col-md-6 donthave_acc">
                    <div class="row donthave_acc_title">
                        <p>Don't have an account?</p>
                    </div>
                    <div class="row donthave_acc_text">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do elusmod tempor incididunt ut labore et dolore magna alique.</p>
                    </div>
                    <div class="row">
                        <button id="signup">SIGN UP</button>
                    </div>
                </div>
                <div class="col-md-6 have_acc">
                    <div class="row have_acc_title">
                        <p>Have an account?</p>
                    </div>
                    <div class="row have_acc_text">
                        <p>Lorem ipusm dolor sit amet consectetur adipisicing elit.</p>
                    </div>
                    <div class="row">
                        <button id="login">LOGIN</button>
                    </div>
                </div>

                <div id="slider">
                    <div id="signupform">

                            <?php
                                if(isset($_POST['signup'])){
                                    if(empty($_POST['name'])) {
                                    $name_error = "Please write the name."; 
                                    } 
                                    if(empty($_POST['email'])) {
                                    $email_error = "Please write the email."; 	
                                    } 
                                    if(empty($_POST['password'])) {
                                    $password_error = "Please write the password."; 	
                                    } else {

                                $db = mysqli_connect('localhost', 'root', '', 'magebit');
                                    if (isset($_POST['signup'])) {
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $pasword = $_POST['password'];

                                        $sql_n = "SELECT * FROM users WHERE name='$name'";
                                        $sql_e = "SELECT * FROM users WHERE email='$email'";
                                        $res_n = mysqli_query($db, $sql_n);
                                        $res_e = mysqli_query($db, $sql_e);

                                    if (mysqli_num_rows($res_n) > 0) {
                                        $name_error = "Sorry - username already taken"; 
                                            
                                        }
                                    if (mysqli_num_rows($res_e) > 0){
                                        $email_error = "Sorry - email already taken"; 
                                            
                                    } else {
                                        $query = "INSERT INTO users (name, email, password) 
                                                VALUES ('$name', '$email', '$pasword')";
                                        $results = mysqli_query($db, $query);
                                        header('Location: welcome.php');
                                        exit();
                                        }
                                    }
                                }
                            }

                            ?>

                        <label>Sign Up</label>
                        <img id="logoS" src="./img/logo.jpg" alt="logo">
                        <form method="POST">
                            <input type="name" name="name" id="name" placeholder="Name*">
                                <div <?php if (isset($name_error)): ?> class="form_error" <?php endif ?> >
                                <?php if (isset($name_error)): ?>
                                <span><?php echo $name_error; ?></span>
                                <?php endif ?>
                                </div>
                            <input type="email" name="email" id="email" placeholder="Email*">
                                <div <?php if (isset($email_error)): ?> class="form_error" <?php endif ?> >
                                <?php if (isset($email_error)): ?>
                                <span><?php echo $email_error; ?></span>
                                <?php endif ?>
                                </div>
                            <input type="password" name="password" id="password" placeholder="Password*">
                                <div <?php if (isset($password_error)): ?> class="form_error" <?php endif ?> >
                                <?php if (isset($password_error)): ?>
                                <span><?php echo $password_error; ?></span>
                                <?php endif ?>
                                </div>
                            <button type="submit" name="signup">SIGN UP</button>
                        </form>
                    </div>

                    <div id="loginform">

                            <?php
                                if(isset($_POST['login'])){
                                    if(empty($_POST['email'])) {
                                    $log_email_error = "Please write the email."; 	
                                    } else {
                                    
                                    $servername = "localhost";
                                    $username = "root";
                                    $password = "";
                                    $dbname = "magebit";
                                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                                    $email = $_POST['email'];
                                    $pasword = $_POST['password'];
                                    $result = mysqli_query($conn, 'SELECT * FROM users where email="'.$email.'" and password="'.$pasword.'"');
                                    if(mysqli_num_rows($result)==1){
                                        $_SESSION['email'] = $email;
                                        header('Location: welcome.php');
                                    } else {
                                        $acc_error = "Account Doesnt exist.";
                                    }
                                }
                            }
                            ?>

                        <label>Login</label>
                        <img id="logoL" src="./img/logo.jpg" alt="logo">
                        <form method="POST">
                                <div <?php if (isset($acc_error)): ?> class="form_error" <?php endif ?> >
                                <?php if (isset($acc_error)): ?>
                                <span><?php echo $acc_error; ?></span>
                                <?php endif ?>
                                </div>
                            <input type="email" name="email" id="email" placeholder="Email*" >
                                <div <?php if (isset($log_email_error)): ?> class="form_error" <?php endif ?> >
                                <?php if (isset($log_email_error)): ?>
                                <span><?php echo $log_email_error; ?></span>
                                <?php endif ?>
                                </div>
                            <input type="password" name="password" id="password" placeholder="Password*" >
                            <button type="submit" name="login">LOGIN</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer">
            <p>ALL RIGHTS RESERVED "MAGEBIT" 2018.</p>
        </div>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>

        $(document).ready(function(){
            $("#signup").click(function(sign){
                $("#slider").animate({left:"25%"},900);

                var log = document.getElementById("loginform");
                log.style.visibility = "hidden";
                log.style.transition = "visibility 0.5s linear 0s,opacity 0.5s linear 0s";
                log.style.opacity = 0;
                
                var sig = document.getElementById("signupform");
                sig.style.visibility = "visible";
                sig.style.transition = "visibility 0.5s linear 0s,opacity 0.5s linear 0.3s";
                sig.style.opacity = 1;

                var fog = document.getElementById("forgotform");
                fog.style.visibility = "hidden";
            });
            $("#login").click(function(log){
                $("#slider").animate({left:"70%"},900);

                var sig = document.getElementById("signupform");
                sig.style.visibility = "hidden";
                sig.style.transition = "visibility 0.5s linear 0s,opacity 0.5s linear 0s";
                sig.style.opacity = 0;

                var log = document.getElementById("loginform");
                log.style.visibility = "visible";
                log.style.transition = "visibility 0.5s linear 0s,opacity 0.5s linear 0.3s";
                log.style.opacity = 1;

                var fog = document.getElementById("forgotform");
                fog.style.visibility = "hidden";
            });
        });

    </script>

</body>
</html>