<?php
header('Access-Control-Allow-Headers: Content-Type');

?>
<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login</title>
    <script src="/CodelgniterWishList/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/underscore.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/backbone.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/CodelgniterWishList/js/sweetalert.js"></script>
    <script src="/CodelgniterWishList/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="/CodelgniterWishList/js/sweetalert2.min.css">




    <script src="/CodelgniterWishList/js/loginUserScript.js" type= "text/javascript" ></script>
    <link href="/CodelgniterWishList/assets/css/styleLogin.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


</head>
<body style="background-image:url(/CodelgniterWishList/assets/images/bg4.jpg)" class="bg">

<div class="logincontent">
    <div class="sectionlogin">
        <div class="logindetails">
            <div class="loginheader">
                <h2>User Login</h2>
            </div>
            <div class="imgcontainer">
                <img src="/CodelgniterWishList/assets/images/login_icon.png" alt="LoginIcon" class="loginicon">
            </div>

            <div class="container">
                <div class="formInput">
                    <div class="input-container">
                        <label for="uname"><b>Username:</b></label>
                        <i class="fa fa-user icon"></i>
                        <input type="text" id="loginUname" placeholder="Enter Username" name="username" required>
                    </div>
                </div>
                <div class="formInput">
                    <div class="input-container">
                        <label for="psw"><b>Password:</b></label>
                        <i class="fa fa-key icon"></i>
                        <input type="password" id="loginPassword" placeholder="Enter Password" name="password" required>
                    </div>
                </div>
                <button class="btn btn-success" name ="LoginBtn"
                        id="LoginBtn" style="paddingleft:30px; padding-right:30px;"
                        type="submit"
                        value="Login">Login
                </button>
                <br><br>
                <a href="/CodelgniterWishList/index.php/Register">
                    Please, click here to start your Registration,If you do not have an account!</a>

                <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

