<?php
  
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_crud','root','pratham@123');

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

  $id = $_GET['id'] ?? null;

  if(!$id){
     header('Location: index.php');
     exit;
  }

  $statement = $pdo->prepare('SELECT * FROM products WHERE id = :id');
  $statement->bindValue(':id',$id);
  $statement->execute();
  $product = $statement->fetch(PDO::FETCH_ASSOC);

  $errors=[];
  $title=$product['title'];
  $description=$product['description'];
  $price = $product['price'];

  if($_SERVER['REQUEST_METHOD']==='POST'){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $date = date('Y-m-d H:i:s');

    $image = $_FILES['image'] ?? null;
    $imagePath = $product['image'];

    

    if(is_dir('images')){
      mkdir('images');
    }

    if($image && $image['tmp_name']){

      if($product['image']){
        unlink($product['image']);
      }
      
      $imagePath = 'images/'.randomString(8).$image['name'];
      mkdir(dirname($imagePath));
      move_uploaded_file($image['tmp_name'], $imagePath);

    }

    if(!$title){
      $errors[]='Product title is required';
    }
    if(!$price){
      $errors[]='Product price is required';
    }

    if(empty($errors)){

      // use this
      $statement = $pdo->prepare("UPDATE INTO products SET title = :title, image = :image, description = :description, price = :price, WHERE id = :id ");
      
      $statement->bindValue(':title',$title);
      $statement->bindValue(':image',$imagePath);
      $statement->bindValue(':description',$description);
      $statement->bindValue(':price',$price);
      $statement->bindValue(':price',$id);
      $statement->bindValue(':date',$date);
      $statement->execute();

      header('Location: index.php');
  
    }



  }

  
  function randomString($n){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $str = '';
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $str .= $characters[$index];
    }

    return $str;
}

  // $pdo->prepare("INSERT INTO products (title, image, description,price,create_date) VALUES ('$title','','$description',$price,$date)");
  
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">


  <!-- BOOTSTRAP CDN -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

  <!-- CSS LINK -->
  <link rel="stylesheet" href="app.css">

  <title>Create new Product</title>
</head>
<body>

<p>
  <a href="index.php" class="btn btn-sm btn-secondary">Go Back To Products Page</a>
</p>

  <!-- Title -->
  <h1>Update <?php echo $product['title']?></h1>



  <!-- Alert message -->
  <?php if(!empty($errors)):?>
    <div class="alert alert-danger">
      <?php foreach($errors as $error):?>
        <div><?php echo $error?></div>
      <?php endforeach;?>
    </div>
  <?php endif;?>

  <!-- Form -->
  <form accept="" method="post" enctype="multipart/form-data">

    <?php if($product['image']):?>
      <img class="update-img" src="<?php echo $product['image']?>">
    <?php endif; ?>

    <div class="form-group">   
      <label>Product Image</label><br>
      <input type="file" name="image">   
    </div>

    <div class="form-group">   
      <label>Product Title</label>
      <input type="text" class="form-control" name="title" value="<?php echo $title?>">   
    </div>

    <div class="form-group">   
      <label>Product Description</label>
      <textarea class="form-control" name="description"
      ><?php echo $description?></textarea>  
    </div>

    <div class="form-group">   
      <label>Product Price</label>
      <input type="number" step='0.01' class="form-control" name="price" value="<?php echo $price?>">   
    </div> 

    <div class="form-group">
      <button class="btn btn-primary">SUBMIT</button>
    </div>

</form>

  
</body>
</html>