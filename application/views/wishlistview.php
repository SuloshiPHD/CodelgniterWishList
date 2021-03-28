<!DOCTYPE html>
<html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wishlist</title>

    <script src="/CodelgniterWishList/js/jquery-3.5.1.min.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/underscore.js" type="text/javascript"></script>
    <script src="/CodelgniterWishList/js/backbone.js" type="text/javascript"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="/CodelgniterWishList/js/sweetalert.js"></script>
    <script src="/CodelgniterWishList/js/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="/CodelgniterWishList/js/sweetalert2.min.css">


    <script src="/CodelgniterWishList/js/wishlistScript.js" type="text/javascript"></script>
    <link href="/CodelgniterWishList/assets/css/styleWishlist.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href='https://fonts.googleapis.com/css?family=Sofia' rel='stylesheet'>

</head>
<body style="background-image:url(/CodelgniterWishList/assets/images/bg4.jpg)" class="bg">
<div class="wish-list-container">
    <input type="button" style="float:right;" class="btn btn-danger" id="logout" value="Logout">
    <input type="hidden" id="wishListNameValue" value="<?php echo $this->session->userdata('loginSession'); ?>">
    <div class="page-header">
        <h3 id="wishListName"></h3>
        <div>
            <div style="clear:both;"></div>
            <p id="wishListDesc"></p>
            <button id="shareList" style="margin-bottom:20px;" class="btn btn-success">Share Wishlist</button>
            <table class="table table-bordered table-hover" id="items">
                <caption>Wish list items</caption>
                <thead class="thead-dark" id="items">
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>URL</th>
                    <th>Priority</th>
                    <th>Action</th>
                </tr>
                <tr>
                    <td><input class="form-control title-input"
                               placeholder="Enter title..."></td>
                    <td><input class="form-control price-input"
                               placeholder="Enter price..."></td>
                    <td><input class="form-control url-input"
                               placeholder="Enter input..."></td>
                    <td>
                        <select class="form-control priorityDescription-input">
                            <option value="High">High</option>
                            <option value="Medium">Medium</option>

                            <option value="Low">Low</option>
                        </select>
                    </td>
                    <td>
                        <button class="btn btn-primary add-item">Add</button>
                    </td>
                </tr>
                </thead>
                <tbody class="items-list"></tbody>
            </table>
        </div>
        <script type="text/template" class="items-list-template">
            <td style="vertical-align:middle"><span class="title"><%=title %></span></td>
            <td style="text-align:right; vertical-align:middle;"><span class="price"><%= price %></span></td>
            <td style="vertical-align:middle"><span class="url"><%= url %></span></td>
            <td style="vertical-align:middle">
                <span class="priorityDescription"><%= priorityDescription %></span></td>
            <td style="vertical-align:middle">
                <button class="btn btn-warning edit-item">Edit</button>
                <button class="btn btn-danger delete-item">Delete</button>
                <button class="btn btn-success update-item" style="display:none">Update</button>
                <button class="btn btn-danger cancel" style="display:none">Cancel</button>
            </td>
        </script>
</body>
</html>