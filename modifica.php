<?php
// connessione al database
// preparazione della query
// esecuzione della query
// usare i dati


$host = 'localhost';
$db   = 'gestione_libreria';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];


$pdo = new PDO($dsn, $user, $pass, $options);

// Recupero l'iD del libro da modificare
$id = isset($_GET['id']) ? $_GET['id'] : null;

// Controllo se il metodo di richiesta è POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $titolo = $_POST['titolo'];
    $autore = $_POST['autore'];
    $anno_pubblicazione = $_POST['anno_pubblicazione'];
    $genere = $_POST['genere'];

    $sql = "UPDATE libri SET titolo = :titolo, autore = :autore, anno_pubblicazione = :anno_pubblicazione, genere = :genere WHERE id = :id";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'id' => $id,
            'titolo' => $titolo,
            'autore' => $autore,
            'anno_pubblicazione' => $anno_pubblicazione,
            'genere' => $genere,
        ]);
        echo "Dati aggiornati correttamente.";
    } catch (PDOException $e) {
        echo "Errore nell'aggiornamento dei dati nel database: " . $e->getMessage();
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aggiungi libro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="./style.css">
</head>
<body>
    
    <!-- NAVBAR -->
    <nav class="navbar bg-body-secondary">
        <div class="container-fluid">
        <a class="navbar-brand fs-4">Libreria in PHP</a>
        <a class="nav-link fs-5" href="./index.php">Home</a>
        <a class="nav-link fs-5 me-3" href="./aggiungi.php">Add Libro</a>
        <form class="d-flex" role="search">
        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-info" type="submit">Search</button>
        </form>
    </div>
</nav>



<div class="container">
    <h1 class="text-center mt-4">Modifica</h1>
    <p class="text-center text-secondary py-1">Compila tutti i campi e clicca invia per modificare il libro selezionato</p>
    <div class="row justify-content-center mt-4">
        <div class="col-md-6">
            <form method="POST">
            <input type="hidden" name="id" value="<?= $id ?>">
                <div class="mb-3">
                    <label for="titolo" class="form-label">Titolo</label>
                    <input type="text" class="form-control" id="titolo" name="titolo" placeholder="Inserisci il titolo del libro">
                </div>
                <div class="mb-3">
                    <label for="autore" class="form-label">Autore</label>
                    <input type="text" class="form-control" id="autore" name="autore" placeholder="Inserisci l'autore">
                </div>
                <div class="mb-3">
                    <label for="anno_pubblicazione" class="form-label">Anno di pubblicazione</label>
                    <input type="text" class="form-control" id="anno_pubblicazione" name="anno_pubblicazione" placeholder="Inserisci l'anno di pubblicazione">
                </div>
                <div class="mb-3">
                    <label for="genere" class="form-label">Genere</label>
                    <input type="text" class="form-control" id="genere" name="genere" placeholder="Inserisci il genere">
                </div>
                <button type="submit" class="btn btn-primary w-100">Invia</button>
                <?php
                if (!empty($errors)) {
                    echo '<div class="alert alert-danger mt-3" role="alert">';
                    foreach ($errors as $error) {
                        echo $error . '<br>';
                    }
                    echo '</div>';
                }
                ?>
            </form>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>