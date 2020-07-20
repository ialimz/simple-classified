<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <?php
    $con = mysqli_connect('localhost', 'root', 'mysql');
    if (!$con) {
        die('Could not connet: ' . mysqli_error($con));
    }
    mysqli_select_db($con, 'Divar');

    $query = "SELECT POSTS.TITLE, CATEGORIES.TITLE as CAT_NAME, PRICE, DESCR
              FROM POSTS INNER JOIN CATEGORIES ON POSTS.CATEGORY_SLUG = CATEGORIES.SLUG
              ORDER BY ID DESC";
    $result = mysqli_query($con, $query) or die('Could not connet: ' . mysqli_error($con));
    ?>

    <div class="header-label-center">Posts</div>


    <div class="posts-container">
        <?php
        while ($row = mysqli_fetch_array($result)) {
            echo "<div class='post-cell'>
                    <div class='post-cell-label'>Title: " . $row['TITLE'] . "</div>
                    <div class='post-cell-label'>Category: " . $row['CAT_NAME'] . "</div>
                    <div class='post-cell-label'>Price: " . $row['PRICE'] . "</div>
                    <div class='post-cell-label'>Description: " . $row['DESCR'] . "</div>
                </div>";
        }
        ?>
    </div>

    <div class="button">
        <a href="create_post.php">Create Post</a>
    </div>
</body>

</html>