<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="an application that let's you add movies to your watchlist"/>
        <meta name="keywords" content="movies, manager, reviews" />
        <meta name="author" content="Ibrahim Nidam"/>

        <title>Movie Manager</title>
        
        <link rel="stylesheet" href="Assets/css/styles.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    </head>
<body>
    <div class="container">
        <input type="checkbox" id="flip">
        <div class="cover">
            <div class="front">
                <img src="Assets/images/wp5583540-black-captain-america-phone-wallpapers.jpg" alt="">
                <div class="text">
                    <span class="text-1">Every new Movie is a <br> new adventure</span>
                </div>
            </div>
            <div class="back">
                <img class="backImg" src="Assets/images/e78660d2797e865858f9ecdff8f3ad26.jpg" alt="">
                <div class="text">
                    <span class="text-1">Dopamine Level will go <br> through the roof</span>
                </div>
            </div>
        </div>
        <div class="forms">
            <div class="form-content">
                    <div class="login-form">
                    <div class="title">Login</div>
                    <form id="login" action="#" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input id="login-email" type="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input id="login-pass" type="password" placeholder="Enter your password" required>
                            </div>
                                <div class="text"><a href="#">Forgot password?</a></div>
                                <div class="button input-box">
                                <input type="submit" value="Sumbit" name="login">
                            </div>
                            <div class="text sign-up-text">Don't have an account? <label for="flip">Sigup now</label></div>
                        </div>
                    </form>
                </div>
                <div class="signup-form">
                    <div class="title">Signup</div>
                    <form id="signup" action="#" method="post">
                        <div class="input-boxes">
                            <div class="input-box">
                                <i class="fas fa-user"></i>
                                <input id="signup-name" type="text" placeholder="Enter your name" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-envelope"></i>
                                <input id="signup-email" type="email" placeholder="Enter your email" required>
                            </div>
                            <div class="input-box">
                                <i class="fas fa-lock"></i>
                                <input id="signup-pass" type="password" placeholder="Enter your password" required>
                            </div>
                            <div class="button input-box">
                                <input type="submit" value="Sumbit" name="signup">
                            </div>
                            <div class="text sign-up-text">Already have an account? <label for="flip">Login now</label></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="Assets/js/app.js"></script>
</body>
</html>