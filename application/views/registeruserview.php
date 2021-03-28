<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration</title>

    <script src="/CodelgniterWishList/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/underscore.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/backbone.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/CodelgniterWishList/js/sweetalert.js"></script>
    <script src="/CodelgniterWishList/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="/CodelgniterWishList/js/sweetalert2.min.css">


    <script src="/CodelgniterWishList/js/registerUserScript.js" type="text/javascript"></script>
    <link href="/CodelgniterWishList/assets/css/styleRegister.css" rel="stylesheet">


</head>
<body style="background-image:url(/CodelgniterWishList/assets/images/bg4.jpg)" class="bg">

<div class="registerdetailsContent">
    <div id="register" class="registerSection">
        <div class="registerForm">
            <div class="registerCaption">
                <h2>User Registration</h2>
            </div>
            <div class="imgcontainer">
                <img src="/CodelgniterWishList/assets/images/login_icon.png" alt="LoginIcon" class="loginicon">
            </div>
            <div class="container">
                <div class="formInput">
                    <label for="username">Full Name: </label>
                    <input id="registerName" type="text"
                           name="username" placeholder="Enter Full Name" required>
                </div>
                <div class="formInput">
                    <label for="username">Username: </label>
                    <input id="registerUsername"
                           type="text" name="username" placeholder="Enter Username" required>
                </div>
                <div class="formInput">
                    <label for="password">Password: </label>
                    <input id="registerPassword"
                           type="password" name="password" placeholder="Enter Password" required>
                </div>

                <div class="formInput">
                    <label for="password">Password: </label>

                    <input id="registerConfirmPassword"
                           type="password" name="confirmPassword"
                           placeholder="Confirm Password" required>
                </div>
                <br>
                <button class="btn btn-success" id="RegisterBtn"
                        style="padding-left:30px; padding-right:30px;"
                        value="Register">Register
                </button>


                <br><br>
                <a href="/CodelgniterWishList/index.php/Login">Already have an account? Click here to Login!</a>
                <div class="clear"></div>
            </div>
        </div>
    </div>

    <div id="createWishlistSection" class="loginSection">
        <div class="loginForm">
            <div class="formHeader">
                <h2>Create WishList</h2>
            </div>
            <div class="imgcontainer">
                <img src="/CodelgniterWishList/assets/images/login_icon.png" alt="LoginIcon" class="loginicon">
            </div>
            <div class="container">
            <div class="formInput">
                <label for="wishlistName">Name of the wishlist: </label>
                <input  id="wishlistName" type="text"
                       name="wishlistName" placeholder="Enter Wishlist Name...." required>
            </div>
            <div class="formInput">
                <label for="wishlistDesc">Wishlist description: </label>
                <input  id="wishlistDesc" type="text"
                       name="wishlistDesc" placeholder="Enter Wishlist Description..." required>
            </div>
            <div class="formInput">
                <label for="wishlistOccasion">What's the Occasion:</label>
                <input id="wishlistOccasion"
                       type="text" name="wishlistOccasion" placeholder="Enter name of the Occasion..." required>
            </div>
            <br>
            <button class="btn btn-success" id="CreateWishlistBtn" class="CreateWishlistBtn"
                    style="padding-left:30px; padding-right:30px;">Create Wishlist
            </button>
            <br><br>
            <div class="clear"></div>
            </div>
        </div>
    </div>
</div>

</html>
