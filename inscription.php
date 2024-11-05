<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription - Gestion de Bibliothèque</title>
  <style>
    body {
  font-family: Arial, sans-serif;
  margin: 0;
  padding: 0;
}

header {
  background-color: #333;
  color: #fff;
  padding: 20px;
  text-align : center ;
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
  max-width: 600px;
  margin: 0 auto;
  padding: 20px;
}

form {
  background-color: #f9f9f9;
  padding: 20px;
  border-radius: 5px;
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="text"],
input[type="email"],
input[type="tel"],
input[type="password"] {
  width: 100%;
  padding: 10px;
  margin-bottom: 20px;
  border: 1px solid #ccc;
  border-radius: 5px;
}

input[type="submit"] {
  background-color: #333;
  color: #fff;
  border: none;
  padding: 10px 20px;
  cursor: pointer;
  border-radius: 5px;
}

input[type="submit"]:hover {
  background-color: #555;
}

.error {
  color: red;
  margin-bottom: 10px;
}
footer {
      background-color: #333;
      color: #fff;
      text-align: center;
      padding: 20px;
    }
  </style>
</head>
<body>

  <header>
    <h1>Inscription</h1>
    <nav>
      <ul>
        <li><a href="accueil.php">Accueil</a></li>
        <li><a href="connexion.php">Connexion</a></li>

      </ul>
    </nav>
  </header>

  <section class="container">
    <h2>Inscrivez-vous pour accéder à notre bibliothèque en ligne</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="nom">Nom :</label>
      <input type="text" id="nom" name="nom" required><br><br>
      <label for="prenom">Prénom :</label>
      <input type="text" id="prenom" name="prenom" required><br><br>
      <label for="phone"> Numéro de téléphone : </label>
      <input type="tel" id="phone" name="phone" placeholder="00.000.000" maxlength="8" required/><br><br>
      <label for="email"> Adresse Email :</label>
      <input type="email" id="email" name="email" required><br><br>
      <label for="password"> Mot de passe :</label>
      <input type="password" id="password" name="password" required><br><br>
      <input type="submit" value="S'inscrire">
    </form>
    <p>Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
  </section>

  <footer>
    <p>&copy; <?php echo date("Y"); ?> Gestion de Bibliothèque . Tous droits réservés.</p>
  </footer>

  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password']; 

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "base_biblio";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
      die("Erreur de connexion à la base de données : " . $conn->connect_error);
    }

    $sql = "INSERT INTO utilisateurs (nom, prenom,num_telephone, ad_email, password ) VALUES ('$nom', '$prenom','$tel', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
      echo "<p>Inscription réussie !</p>";
    } else {
      echo "<p>Erreur lors de l'inscription : " . $conn->error . "</p>";
    }

    $conn->close();
  }
  ?>

</body>
</html>