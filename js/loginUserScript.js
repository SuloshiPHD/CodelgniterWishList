//initializing a user class
$(document).ready(function () {
    //dealing with one particular row (one user entry)
    var UserEntry = Backbone.Model.extend({
        defaults: {
            username: '',
            password: '',
            name: '',
            wishlist_name: '',
            wishlist_desc: '',
            wishlist_occasion: ''
        }
    });

    //creting a one particular login
    var LoginEntry = Backbone.Model.extend({
        defaults: {
            username: '',
            password: ''
        }
    });
    //multiple users
    /**
     *  objects created using the same Model constructor
     */
    var UsersEntry = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/user'
    });

    //multiple logins
    var LoginsEntry = Backbone.Collection.extend({
        url: 'http://localhost/CodelgniterWishList/index.php/api/login'
    });

    //creating objects
    var currentloggedUserName;
    var setOfuserArray;
    var allusers = new UsersEntry();
    var logins = new LoginsEntry();
    var sigleUser = new UserEntry();


    //populating the created object (fetch -> GET data from server using (GET))
    allusers.fetch({
        success: function (response) {
            console.log(response.toJSON());
            setOfuserArray = response.toJSON();
            currentloggedUserName = $('#wishListNameValue').val();
            var currentUserEntry;
            for (var i = 0; i < setOfuserArray.length; i++) {
                if (setOfuserArray[i].username == currentloggedUserName) {
                    currentUserEntry = setOfuserArray[i];
                    break;
                }
            }
            if (currentUserEntry) {
                $('#wishListName').html(currentUserEntry.wishlist_name);
                $('#wishListDesc').html(currentUserEntry.wishlist_desc);
                $('#wishListUserName').html(currentUserEntry.name);
            }
        }
    });
    // Logging in to application
    $('#LoginBtn').on('click', function () {
        var username = $('#loginUname').val()
        var password = $('#loginPassword').val();
        var invalid = false;
        if (username && password) {
            var login = new LoginEntry({
                username: username,
                password: password
            });
            //add a new user to the collection
            logins.add(login);
            /**
             * save() - send new data to server using POST or update data using PUT
             * no_id -> POST , with id -> PUT
             * id attribute is not implemented, thus post is called
             */
            login.save(null, {
                success: function (response) {
                    var resp = response.toJSON();
                    if (resp.true) {
                        window.location.href =
                            "http://localhost/CodelgniterWishList/index.php/wishlist";
                    } else {
                        window.location.href =
                            "http://localhost/CodelgniterWishList/index.php/login";
                    }
                },
                error: function (error, args) {
                    console.log(error);
                    console.log(args);
                }
            });
        } else {
            Swal.fire({
                title: 'Fields Invalid',
                text: 'Some of the fields have not been entered correctly.Please try again!',
                type: 'error',
                confirmButtonText: 'OK'
        })
        }
    });
});
