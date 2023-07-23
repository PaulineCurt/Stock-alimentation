<?php

// 1. Connexion à la base de données SQL (PHPmyAdmin)
$pdo = new PDO("mysql:host=localhost;dbname=alimentation", "root", "", 
[
    // Retourne un tableau indéxé par les noms des colonnes 'fetch_assoc'
    // Tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);
// Si on clique sur le bouton "edit"
if(isset($_POST['submit'])) {

    //Récupère l'ID qui est dans l'url (car il n'est pas modifiable)
    $id = $_GET['id'];
    // Récupère les données modifier du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

// Execute la requette
$update = $pdo->prepare("UPDATE products SET title = ?, description = ?, image = ?, price = ?, quantity = ? WHERE id = ? ");
$update->execute([$title,$description,$image,$price,$quantity,$id]);

// Renvoie sur la page d'origine
header("Location: index.php");

}   





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<style>
    form {
    padding: 25px;
    background-color: #7DA686;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
   }
</style>
<body>

<form action="" method="POST">
        <input type="text" placeholder="title" name="title" value="<?php echo $_GET['title']?>">
        <textarea name="description" id="" cols="20" rows="10" placeholder="description"><?php echo $_GET['description']?></textarea>
        <input type="text" placeholder="Url image" name='image' value="<?php echo $_GET['image']?>">
        <input type="number" placeholder="What a price?" name="price" value="<?php echo $_GET['price']?>">
        <input type="numer" placeholder="quantity" name="quantity" value="<?php echo $_GET['quantity']?>">
        <input type="submit" name="submit" value="edit">  
   </form>

   
</body>
</html>