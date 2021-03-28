$(document).ready(function () {
    $('#createWishlistSection').hide();
    var User = Backbone.Model.extend({
        defaults: {
            username: '',
            password: '',
            name: '',
            wishlist_name: '',
            wishlist_desc: '',
            wishlist_occasion: ''
        }
    });
    var Users = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/user'
    });

    var users = new Users();
    var registeredUser = new User();
    var currentUserName;
    var userArray;

    users.fetch({

    success: function (response) {
        console.log(response.toJSON());
        userArray = response.toJSON();
        currentUserName = $('#wishListNameValue').val();
        var currentUser;
        for (var i = 0; i < userArray.length; i++) {
            if (userArray[i].username == currentUserName) {
                currentUser = userArray[i];
                break;
            }
        }
        if (currentUser) {
            $('#wishListName').html(currentUser.wishlist_name);
            $('#wishListDesc').html(currentUser.wishlist_desc);
            $('#wishListUserName').html(currentUser.name);
        }
    }
});
    // user registration
    $('#RegisterBtn').on('click', function () {
        var username = $('#registerUsername').val()
        var password = $('#registerPassword').val();
        var confirmPassword = $('#registerConfirmPassword').val();
        var name = $('#registerName').val();
        var invalid = false;
        if (name && username && password && confirmPassword && password == confirmPassword) {
            for (var i = 0; i < userArray.length; i++) {
                if (userArray[i].username == username) {
                    invalid = true;
                    break;
                }
            }
            if (invalid) {
                Swal.fire({
                    title: 'User Exists',
                    text: 'The username has already been used for this website. Please try again or login!',
                    type: 'error',
                    confirmButtonText: 'Okay'
            })
            } else {
                registeredUser.set({
                    'username': username,
                    'password': password,
                    'name': name
            });
                $('#register').hide();
                $('#createWishlistSection').show();
            }
        } else {
            Swal.fire({
                 icon: 'error',
                 title: 'Fields Invalid',
                 text: 'Some of the fields have not been entered correctly.Please try again!'

        })
        }
    });
    // registering the wish list creation
    $('#CreateWishlistBtn').on('click', function () {
        var name = $('#wishlistName').val()
        var desc = $('#wishlistDesc').val();
        var occasion = $('#wishlistOccasion').val();
        if (name && desc && occasion) {
            registeredUser.set({
                'wishlist_name': name,
                'wishlist_desc': desc,
                'wishlist_occasion': occasion
            });
            users.add(registeredUser);
            registeredUser.save(null, {
                success: function (response) {
                    console.log(response.toJSON());
                    window.location.href =
                        "http://localhost/CodelgniterWishList/index.php/login";
                },
                error: function (error, args) {
                    console.log(error);
                    console.log(args);
                }
            });
        }
    });
});