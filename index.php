<?php 

// 1. Connexion à la base de données SQL (PHPmyAdmin)
$pdo = new PDO("mysql:host=localhost;dbname=alimentation", "root", "", 
[
    // Retourne un tableau indéxé par les noms des colonnes 'fetch_assoc'
    // Tableau associatif
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);


// Déclaration des variables afficher dans le tableau
// Quand je clique sur submit tu me créer les variables suivantes
if(isset($_POST['submit'])){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];


// Envoyer vers PDO (ma base de données)
    $insert = $pdo->prepare('INSERT INTO products(title,description,image,price,quantity) 
                            VALUES(?,?,?,?,?)');
    $insert->execute([$title,$description,$image,$price,$quantity]);

}


// 2. Chercher les produits dans SQL (PHPmyAdmin)
// prepare = prépare la requette SQL
$select = $pdo->prepare("SELECT * FROM products");
// Execute la requette
$select->execute();
// fetchALL pour récupéré tous les produits
$data = $select->fetchALL();

// var_dump($data);

// foreach($data as $result) {
//     var_dump($result['title']);
// }

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
    body {
        margin: 0;
        font-family: 'Lucida Sans';
    }
    .header {
        background: coral;
        padding: 25px;
        display: flex;
        justify-content: center;
        align-items: center;
        color: white;
    }
   img {
    width: 80px;
   }
   td {
    text-align: center;
    padding: 10px;
    width: 500px;
   }
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

    <div class="header">
        <h1>Alimentation</h1>
    </div>

    <form action="" method="POST">
        <input type="text" placeholder="title" name="title">
        <textarea name="description" id="" cols="20" rows="10" placeholder="description"></textarea>
        <input type="text" placeholder="Url image" name='image'>
        <input type="number" placeholder="What a price?" name="price">
        <input type="numer" placeholder="quantity" name="quantity">
        <input type="submit" name="submit" value="Add">  
   </form>

    <div>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        
        <tbody>
            <?php 
                 foreach($data as $result) {
            ?>
        <tr>            
            <td>
                <img src=" <?php echo $result['image'] ?>">
            </td>
                <td>
                    <?php echo $result['title'] ?>
                </td>
                    <td>
                       <?php echo $result['description'] ?>
                    </td>
                        <td>
                            <?php echo $result['price'] ?>$
                        </td>
                            <td>
                                x<?php echo $result['quantity'] ?>
                            </td>
                                <td>
                                    <a href="edit.php?id=<?php echo $result['id']?>&title=<?php echo $result['title']?>&description=<?php echo $result['description']?>&price=<?php echo $result['price']?>&quantity=<?php echo $result['quantity']?>&image=<?php echo $result['image']?>">Edit</a>
                                </td>
                                    <td>
                                        <a href="delete.php?id=<?php echo $result['id']?>">Delete</a>
                                     </td>
         </tr>
            <?php
                }   
            ?>
        </tbody>
        </table>
    </div>
</body>
</html>