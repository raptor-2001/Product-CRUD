<?php
  
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_crud','root','pratham@123');

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');

  $statement->execute();

  $products = $statement->fetchAll(PDO::FETCH_ASSOC);

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

  <title>Product CRUD</title>
</head>
<body>

  <!-- Title -->
  <h1>Product CRUD</h1>

  <p>
    <a href="create.php" class="btn btn-success">Create Product</a>
  </p>

  <!--Tables  -->
  <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Image</th>
      <th scope="col">Title</th>
      <th scope="col">Price</th>
      <th scope="col">Create Date</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>

  <?php 
    foreach($products as $i => $product){?>
    <tr>
      <th scope="row"> <?php echo $i+1?> </th> 
      <td>
        <img src= "<?php echo $product['image']?>" alt="<?php echo $product['title'] ?>" class="thumb-img">
      </td>
      <td><?php echo $product['title']?></td>
      <td><?php echo $product['price']?></td>
      <td><?php echo $product['create_date']?></td>
      <td>

      <a href="update.php?id=<?php echo $product['id']?>" type="button" class="btn btn-sm btn-outline-primary">Edit</a>

      <form method="post" action="delete.php"  class="d-inline-block">
        <input type="hidden" name="id" value="<?php echo $product['id']?>"/>
        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
      </form>
      
      </td>
    </tr>
  <?php }?>


  </tbody>
</table>


  
</body>
</html>