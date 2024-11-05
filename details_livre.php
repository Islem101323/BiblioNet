<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails du Livre</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f9f9f9;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 20px;
      text-align: center;
    }

    header h1 {
      margin: 0;
    }

    nav ul {
      list-style-type: none;
      padding: 0;
    }

    nav ul li {
      display: inline;
      margin-right: 20px;
    }

    nav ul li a {
      color: #fff;
      text-decoration: none;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .livre {
      margin-top: 20px;
    }

    .livre h2 {
      margin-top: 0;
    }

    .livre p {
      margin-bottom: 10px;
    }

    .livre img {
      max-width: 100%;
      height: auto;
      margin-top: 20px;
    }

    footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 10px 0;
      position: fixed;
      bottom: 0;
      width: 100%;
    }
  </style>
</head>
<body>

<header>
  <h1>Détails du Livre</h1>
  <nav>
    <ul>
      <li><a href="catalogue.php">Catalogue</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <?php
  if(isset($_GET['id'])) {

    $id_livre = $_GET['id'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_biblio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $sql = "SELECT * FROM livre WHERE ID_livre = $id_livre";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      echo "<div class='livre'>";
      echo "<h2>" . $row["Titre_livre"] . "</h2>";
      echo "<p><strong>Auteur:</strong> " . $row["Auteur"] . "</p>";
      echo "<p><strong>ISBN:</strong> " . $row["ISBN"] . "</p>";
      echo "<p><strong>Catégorie:</strong> " . $row["Categorie"] . "</p>";
      echo "<p><strong>Description:</strong> " . $row["description"] . "</p>";

      echo "<p><a href='/pr/pdf/" . $row["fichier_pdf"] . "'>Télécharger le fichier PDF</a></p>";

      echo "<img src='/pr/image/" . $row["image"] . "' alt='" . $row["Titre_livre"] . "'>";
      echo "</div>";
    } else {
      echo "Aucun livre trouvé avec cet identifiant.";
    }


    $conn->close();
  } else {
    echo "Identifiant du livre non spécifié.";
  }
  ?>
</div>

<footer>
  <p>&copy; <?php echo date("Y"); ?> Gestion de Bibliothèque. Tous droits réservés.</p>
</footer>

</body>
</html>