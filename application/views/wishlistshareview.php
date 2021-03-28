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

    <script src="/CodelgniterWishList/js/wishlistShareScript.js" type="text/javascript"></script>
    <link href="/CodelgniterWishList/assets/css/styleWishlist.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body style="background-image:url(/CodelgniterWishList/assets/images/bg4.jpg)" class="bg">
<div class="wish-list-container">
    <input type="button" style="float:right;margin-top:20px;" class="btn btn-danger" id="logout" value="Logout">
    <input type="hidden" id="wishListNameValue" value="<?php echo $this->session->userdata('sharedToUser'); ?>">
    <div class="page-header">
        <h3 id="wishListName"></h3>
        <div>
            <div style="clear:both;"></div>

            <p id="wishListDesc"></p>

            <table class="table table-bordered table-hover" id="items">
                <caption>Wish list items</caption>
                <thead class="thead-dark">
                <tr>
                    <th>Title</th>
                    <th>Price</th>
                    <th>URL</th>
                    <th>Priority</th>
                </tr>
                </thead>
                <tbody class="items-share-list"></tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/template" class="items-share-list-template">
    <td><span class="title"><%= title %></span></td>
    <td><span class="price"><%= price %></span></td>
    <td><span class="url"><%= url %></span></td>
    <td><span class="priorityDescription"><%= priorityDescription%></span></td>
</script>
</body>
</html>