<?php
include 'config.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit; // Add exit to stop further execution
}

if (isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $price = $_POST['price'];
    $image = $_FILES['image']['name'];
    $quantity = $_POST['quantity'];
    $description = mysqli_real_escape_string($conn, $_POST['description']); // Fetch description from form submission

    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = 'uploaded_img/' . $image;

    // Check if the product name already exists
    $select_product_name_query = "SELECT name FROM `products` WHERE name = '$name'";
    $select_product_name = mysqli_query($conn, $select_product_name_query) or die('query failed');

    if ($select_product_name && mysqli_num_rows($select_product_name) > 0) {
        $message[] = 'Product name already exists';
    } else {
        // Insert the product into the database
        $insert_product_query = "INSERT INTO `products` (name, price, image,quantity,description) VALUES ('$name', '$price', '$image', '$quantity','$description')";
        if (mysqli_query($conn, $insert_product_query)) {
            // Move uploaded file to designated folder
            move_uploaded_file($image_tmp_name, $image_folder);
            echo "Product added successfully.";
        } else {
            echo "Error: " . $insert_product_query . "<br>" . mysqli_error($conn);
        }
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    $delete_image_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
    $fetch_delete_image = mysqli_fetch_assoc($delete_image_query);
    unlink('uploaded_img/' . $fetch_delete_image['image']);
    mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
    header('location:admin_products.php');
}

if (isset($_POST['update_product'])) {

    $update_p_id = $_POST['update_p_id'];
    $update_name = mysqli_real_escape_string($conn, $_POST['update_name']);
    $update_price = $_POST['update_price'];
    $update_quantity= $_POST['update_quantity'];
    $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);

    $query = "UPDATE `products` SET name = '$update_name', price = '$update_price',quantity = '$update_quantity', description = '$update_description' WHERE id = '$update_p_id'";
    $result = mysqli_query($conn, $query);

    // Check if the query was successful
    if ($result) {
        echo "Product updated successfully.";
    } else {
        echo "Error updating product: " . mysqli_error($conn);
    }


    $update_image = $_FILES['update_image']['name'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_folder = 'uploaded_img/' . $update_image;
    $update_old_image = $_POST['update_old_image'];

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'image file size is too large';
        } else {
            mysqli_query($conn, "UPDATE `products` SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
            move_uploaded_file($update_image_tmp_name, $update_folder);
            unlink('uploaded_img/' . $update_old_image);
        }
    }


    header('location:admin_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head> 
<body>
   
<?php include 'admin_header.php'; ?>

<!-- product CRUD section starts  -->

<section class="add-products">

    <h1 class="title">shop products</h1>

    <form action="" method="post" enctype="multipart/form-data">
        <h3>add product</h3>
        <input type="text" name="name" class="box" placeholder="enter product name" required>
        <input type="number" min="0" name="price" class="box" placeholder="enter product price" required>
        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box" required>
        <input type="number" name="quantity" min="0" placeholder="Enter the books quantity" class="box" required>
        <textarea name="description" class="box" placeholder="enter product description"></textarea>
        <input type="submit" value="add product" name="add_product" class="btn">
    </form>

</section>

<!-- product CRUD section ends -->

<!-- show products  -->

<section class="show-products">
    <table>
        <tr>
            <th>Image</th>
            <th>Name</th> 
            <th>Quantity</th>
            <th>Price</th>
            <th>Actions</th>
        </tr>
        <?php
        $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
        if (mysqli_num_rows($select_products) > 0) {
            while ($fetch_products = mysqli_fetch_assoc($select_products)) {
        ?>
        <tr>
            <td><img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt=""></td>
            <td><?php echo $fetch_products['name']; ?></td>
            <td><?php echo $fetch_products['quantity']; ?></td>

            <td>Rs.<?php echo $fetch_products['price']; ?>/-</td>
            <td>  
                <a href="admin_products.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">Update</a>
                <a href="admin_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('Delete this product?');">Delete</a>
            </td>
        </tr>
        <?php
            }
        } else {
            echo '<tr><td colspan="4">No products added yet!</td></tr>';
        }
        ?>
    </table>
</section>

<section class="edit-product-form">
    <?php
    if (isset($_GET['update'])) {
        $update_id = $_GET['update'];
        $update_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
        if (mysqli_num_rows($update_query) > 0) {
            while ($fetch_update = mysqli_fetch_assoc($update_query)) {
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
        <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
        <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
        <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
        <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>"  class="box" required placeholder="enter product price">
        <input type="number" name="update_quantity" value="<?php echo $fetch_update['quantity']; ?>" class="box" required placeholder="enter product quantity"> <!-- Add description input field -->
        <input type="text" name="update_description" value="<?php echo $fetch_update['description']; ?>" class="box" required placeholder="enter product description"> <!-- Add description input field -->
        <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
      
        <input type="submit" value="update" name="update_product" class="btn">
        <input type="reset" value="cancel" id="close-update" class="option-btn">
    </form>
    <?php
            }
        }
    } else {
        echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
    }
    ?>
</section>

<!-- custom admin js file link  -->
<script src="admin_script.js"></script>


</body>
</html>
