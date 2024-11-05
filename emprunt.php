<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunt de livre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }

        h1 {
            text-align: center;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .success-message {
            margin-top: 10px;
            padding: 10px;
            background-color: #dff0d8;
            border: 1px solid #c3e6cb;
            color: #155724;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Emprunt de livre</h1>
    <form id="empruntForm" action="" method="post">
        <label for="userName">Nom complet :</label>
        <input type="text" id="userName" name="userName" required><br>
        
        <label for="userEmail">Email :</label>
        <input type="email" id="userEmail" name="userEmail" required><br>
        
        <label for="bookTitle">Titre du livre :</label>
        <input type="text" id="bookTitle" name="bookTitle" required><br>

        <label for="returnDate">Date de retour prévue :</label>
        <input type="date" id="returnDate" name="returnDate" required><br>

        <input type="submit" value="Emprunter" id="borrowButton">
    </form>

    <p><a href="catalogue.php">Retourner au catalogue</a>.</p>

    <div id="successMessage" class="success-message" style="display: none;">
        Emprunt enregistré avec succès.
    </div>

    <script>
        document.getElementById('empruntForm').addEventListener('submit', function(event) {

            event.preventDefault();


            var formData = new FormData(this);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', this.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {

                    document.getElementById('successMessage').style.display = 'block';

                    document.getElementById('empruntForm').reset();
                }
            };
            xhr.send(formData);
        });
    </script>

    <?php

      if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $userName = $_POST['userName'];
        $userEmail = $_POST['userEmail'];
        $bookTitle = $_POST['bookTitle'];
        $returnDate = $_POST['returnDate'];


        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "base_biblio";

        $conn = new mysqli($servername, $username, $password, $dbname);


        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        $sql = "INSERT INTO emprunts (Nom, email, Titre_livre, date_retour)
                VALUES ('$userName', '$userEmail', '$bookTitle', '$returnDate')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>document.getElementById('successMessage').style.display = 'block';</script>";
        } else {
            echo "<p>Erreur lors de l'enregistrement de l'emprunt : " . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
