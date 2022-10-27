<?php
  
  $pdo = new PDO('mysql:host=localhost;port=3306;dbname=product_crud','root','pratham@123');

  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

  $statement = $pdo->prepare('SELECT * FROM products ORDER BY create_date DESC');

  $statement->execute();

  

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

  <!-- Title -->
  <h1>Product CRUD</h1>

  <!-- Form -->
  <form>
  <div class="form-group">   
    <label>Product Image</label><br>
    <input type="file">   
  </div>
  <div class="form-group">   
    <label>Product Title</label>
    <input type="text" class="form-control">   
  </div>
  <div class="form-group">   
    <label>Product Description</label>
    <textarea class="form-control"></textarea>  
  </div>
  <div class="form-group">   
    <label>Product Price</label>
    <input type="number" step='0.01' class="form-control">   
  </div> 
  <div class="form-group">
    <button class="btn btn-primary">SUBMIT</button>
  </div>
</form>

  
</body>
</html>