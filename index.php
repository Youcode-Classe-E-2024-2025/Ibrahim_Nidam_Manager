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
    <section id="login-signup">
        <div class="container">
            <input type="checkbox" id="flip">
            <div class="cover">
                <div class="front">
                    <img src="Assets/images/Login - Signup/wp5583540-black-captain-america-phone-wallpapers.jpg" alt="">
                    <div class="text">
                    <span class="text-1">Every new Movie is a <br> new adventure</span>
                </div>
            </div>
                <div class="back">
                    <img class="backImg" src="Assets/images/Login - Signup/e78660d2797e865858f9ecdff8f3ad26.jpg" alt="">
                    <div class="text">
                        <span class="text-1">Dopamine Level will go <br> through the roof</span>
                    </div>
                </div>
            </div>
            <div class="forms">
                <div class="form-content">
                    <div class="login-form">
                        <div class="title">Login</div>
                        <form id="login" action="Assets/includes/login.php" method="post">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <svg class="icon-login" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                                    <input id="login-email" type="email" placeholder="Enter your email" required>
                                </div>
                                <div class="input-box">
                                    <svg class="icon-login" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                                    <input id="login-pass" type="password" placeholder="Enter your password" required>
                                    <img id="login-toggle" class="password-toggle" src="Assets/images/icons/eye visibility off.svg" alt="Toggle Visibility">
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
                        <form id="signup" action="Assets/includes/signup.php" method="post">
                            <div class="input-boxes">
                                <div class="input-box">
                                    <svg class="icon-login" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M480-480q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM160-160v-112q0-34 17.5-62.5T224-378q62-31 126-46.5T480-440q66 0 130 15.5T736-378q29 15 46.5 43.5T800-272v112H160Zm80-80h480v-32q0-11-5.5-20T700-306q-54-27-109-40.5T480-360q-56 0-111 13.5T260-306q-9 5-14.5 14t-5.5 20v32Zm240-320q33 0 56.5-23.5T560-640q0-33-23.5-56.5T480-720q-33 0-56.5 23.5T400-640q0 33 23.5 56.5T480-560Zm0-80Zm0 400Z"/></svg>
                                    <input id="signup-name" type="text" placeholder="Enter your name" required>
                                </div>
                                <div class="input-box">
                                    <svg class="icon-login" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h640q33 0 56.5 23.5T880-720v480q0 33-23.5 56.5T800-160H160Zm320-280L160-640v400h640v-400L480-440Zm0-80 320-200H160l320 200ZM160-640v-80 480-400Z"/></svg>
                                    <input id="signup-email" type="email" placeholder="Enter your email" required>
                                </div>
                                <div class="input-box">
                                    <svg class="icon-login" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px"><path d="M240-80q-33 0-56.5-23.5T160-160v-400q0-33 23.5-56.5T240-640h40v-80q0-83 58.5-141.5T480-920q83 0 141.5 58.5T680-720v80h40q33 0 56.5 23.5T800-560v400q0 33-23.5 56.5T720-80H240Zm0-80h480v-400H240v400Zm240-120q33 0 56.5-23.5T560-360q0-33-23.5-56.5T480-440q-33 0-56.5 23.5T400-360q0 33 23.5 56.5T480-280ZM360-640h240v-80q0-50-35-85t-85-35q-50 0-85 35t-35 85v80ZM240-160v-400 400Z"/></svg>
                                    <input id="signup-pass" type="password" placeholder="Enter your password" required>
                                    <img id="signup-toggle" class="password-toggle" src="Assets/images/icons/eye visibility off.svg" alt="Toggle Visibility">
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
    </section>
    <script src="Assets/js/app.js"></script>
</body>
</html>