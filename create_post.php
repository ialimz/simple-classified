<html>

<head>
    <link rel="stylesheet" href="form-style.css">
</head>

<body>
    <?php
    $con = mysqli_connect('localhost', 'root', 'mysql');
    if (!$con) {
        die('Could not connet: ' . mysqli_error($con));
    }
    mysqli_select_db($con, 'Divar');

    $query = "SELECT * FROM CATEGORIES WHERE SLUG != 'ROOT' AND PARENT_SLUG = 'ROOT'";
    $result = mysqli_query($con, $query) or die('Could not connet: ' . mysqli_error($con));


    if ($_POST['title'] && $_POST['cat'] && $_POST['price'] && $_POST['desc']) {
        $title = $_POST['title'];
        $cat = $_POST['cat'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];


        $query = "INSERT INTO POSTS VALUES(NULL, '$title', '$cat', '$price', '$desc')";

        mysqli_query($con, $query);

        if (mysqli_error($con)) {
            echo 'Error: ' . mysqli_error($con);
        } else {
            phpAlert("آگهی شما با موفقیت ثبت شد.");
        }
    } else {
        phpAlert("لطفا اطلاعات ضروری را وارد کنید.");
    }

    function phpAlert($msg) {
        echo '<script type="text/javascript">alert("' . $msg . '")</script>';
    }

    ?>

    <div class="form-style-2">
        <div class="form-style-2-heading">Submit your post</div>
        <form action="" method="post" id="post_form">
            <label for="field1"><span>Title <span class="required">*</span></span><input type="text" class="input-field" name="title" value="" /></label>
            <label for="field4"><span>Category <span class="required">*</span></span><select name="cat" class="select-field">
                    <?php
                    while ($row = mysqli_fetch_array($result)) {
                        echo "<option value=" . $row['SLUG'] . ">" . $row['TITLE'] . "</option>";
                    }
                    ?>
                </select></label>
            <label for="field1"><span>Price <span class="required">*</span></span><input type="text" class="input-field" name="price" value="" /></label>
            <label for="field5"><span>Description <span class="required">*</span></span><textarea name="desc" class="textarea-field" placeholder="Write posts's description"></textarea></label>
            <label><span> </span><input type="submit" value="Submit" /></label>
        </form>
    </div>
</body>

</html>