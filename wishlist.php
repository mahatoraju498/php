<?php
@include 'config.php';
if(isset($_POST['add_to_cart'])){
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");
    if(mysqli_num_rows($select_cart) >0){
          $message[] = 'product already added to cart';
}else{
          $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
          $message[] = 'product added to cart succesfully';
       }
    }
   if(isset($_POST['add_to_wishlist'])){
      $product_name = $_POST['product_name'];
      $product_price = $_POST['product_price'];
      $product_image = $_POST['product_image'];
      $product_quantity = 1;
      $select_wishlist = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name'");
      if(mysqli_num_rows($select_wishlist) >0){
         $message[] = 'product already added to wishlist';
}else{
         $insert_product = mysqli_query($conn, "INSERT INTO `wishlist`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
         $message[] = 'product added to wishlistsuccesfully';
      }
   }
   if(isset($_GET['remove'])){
      $remove_id = $_GET['remove'];
mysqli_query($conn, "DELETE FROM `wishlist` WHERE id = '$remove_id'");
      header('location:wishlist.php');
   };
   if(isset($_GET['delete_all'])){
mysqli_query($conn, "DELETE FROM `wishlist`");
      header('location:wishlist.php');
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>wishlist</title>
<!-- font awesome cdn link  -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
?>
<div class="container">
<section class="products">
<h1 class="heading">wishlist</h1>
<div class="box-container">
<?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`");
      if(mysqli_num_rows($select_products) >0){
while($fetch_product = mysqli_fetch_assoc($select_products)){
      ?>
<form action="" method="post">
<div class="box">
<img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="" style="width:400px">
<h3><?php echo $fetch_product['name']; ?></h3>
<div class="price">Rs.<?php echo $fetch_product['price']; ?></div>
<input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
<input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
<input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
<a href ="/add_to_cart.php"><input type="submit" class="btn" value="add to cart" name="add_to_cart"></a>

<td><a href="wishlist.php?remove=<?php echo $fetch_product['id']; ?>" onclick="return confirm('remove item from cart?')" class="btn">remove</a></td>
</div>
</form>
<?php
         };
      };
      ?>
</div>
</section>

</div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>
</html>
