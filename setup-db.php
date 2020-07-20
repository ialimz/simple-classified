<html>

<body>
    <?php
    $con = mysqli_connect('localhost', 'root', 'mysql');
    if (!$con) {
        die('Could not connet: ' . mysqli_error($con));
    }

    //Setup Database
    if (mysqli_query($con, 'CREATE DATABASE Divar')) {
        echo 'Database Created';
    } else {
        echo 'Error Creating Database: ' . mysqli_error($con);
    }

    mysqli_select_db($con, 'Divar');

    //Setup Categories Table
    $categoriesTable = 'CREATE TABLE CATEGORIES (            
            SLUG VARCHAR(20),
            PRIMARY KEY(SLUG),
            TITLE VARCHAR(20),
            PARENT_SLUG VARCHAR(20) NOT NULL,
            FOREIGN KEY (PARENT_SLUG) REFERENCES CATEGORIES(SLUG)
            )';
    mysqli_query($con, $categoriesTable);

    if (mysqli_error($con)) {
        echo 'Error: ' . mysqli_error($con);
    }

    //Setup Posts Table
    $postTable = 'CREATE TABLE POSTS (
        ID INT NOT NULL AUTO_INCREMENT,
        PRIMARY KEY(ID),
        TITLE VARCHAR(20) NOT NULL,
        CATEGORY_SLUG VARCHAR(20) NOT NULL,
        FOREIGN KEY (CATEGORY_SLUG) REFERENCES CATEGORIES(SLUG),
        PRICE INT DEFAULT 0,
        DESCR TEXT NOT NULL            
        )';
    mysqli_query($con, $postTable);

    if (mysqli_error($con)) {
        echo 'Error: ' . mysqli_error($con);
    }

    //Initialize ROOT Category
    $root = 'INSERT INTO CATEGORIES VALUES("ROOT", "ریشه", "ROOT")';
    mysqli_query($con, $root);

    //Initialize CAR Category
    $car = 'INSERT INTO CATEGORIES VALUES("car", "خودرو", "ROOT")';
    mysqli_query($con, $car);

    //Initialize apartment Category
    $apartment = 'INSERT INTO CATEGORIES VALUES("apartment", "اپارتمان", "ROOT")';
    mysqli_query($con, $apartment);

    //Initialize barber Category
    $barber = 'INSERT INTO CATEGORIES VALUES("barber", "خدمات آرایشگاه", "ROOT")';
    mysqli_query($con, $barber);

    //Initialize car-fix Category
    $car_fix = 'INSERT INTO CATEGORIES VALUES("car_fix", "تعمیر ماشین", "ROOT")';
    mysqli_query($con, $car_fix);

    mysqli_close($con);
    ?>
</body>

</html>