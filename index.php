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

// comando che connette al database
$pdo = new PDO($dsn, $user, $pass, $options);

//Implementazione Search in Navbar
$search = $_GET['search'] ?? '';

if (!empty($search)) {
    $stmt = $pdo->prepare("SELECT * FROM libri WHERE titolo LIKE ?");
    $stmt->execute(["%$search%"]);
} else {
    $stmt = $pdo->query('SELECT * FROM libri');
}

// Se viene passato un id nella richiesta, elimino il libro corrispondente
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM libri WHERE id = :id";

    try {
        $stmt_delete = $pdo->prepare($sql);
        $stmt_delete->execute(['id' => $id]);
       
        header("Location: index.php");
        exit();
    } catch (PDOException $e) {
        echo "Errore nell'eliminazione del libro: " . $e->getMessage();
    }
}

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>libreria</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./style.css">
  </head>
  <body>

  <!-- NAVBAR -->
  <nav class="navbar bg-body-secondary">
    <div class="container-fluid">
      <a class="navbar-brand fs-4 text-primary">Libreria in PHP</a>
      <a class="nav-link fs-5" href="./index.php">Home</a>
      <a class="nav-link me-3 fs-5" href="./aggiungi.php">Add Libro</a>
      <form action="./index.php" method="GET" class="d-flex" role="search">
        <input class="form-control" name="search" type="search" placeholder="Cerca per titolo..." aria-label="Search" value="<?= $search ?>">
        <button class="btn btn-info" type="submit">Search</button>
      </form>
    </div>
  </nav>

  <!-- CARD LIBRI -->
  <div class="container">
    <h1 class="text-center mt-4">Database libri</h1>
    <div>
      <a href="/Progetto-settimanale-php1/aggiungi.php" class="btn btn-success mt-2"><i class="bi bi-plus-square-dotted me-2"></i> Aggiungi libro</a>
    </div>
    <div class="row mt-2 gy-2">
      <?php foreach ($stmt as $row) { ?>
      <div class="col-4">
        <div class="card">
          <div class="card-body">
            <p><?= $row['id'] ?></p>
            <h3 class="card-title text-center mb-4"><?= $row['titolo'] ?></h3>
            <h6 class="card-subtitle ms-2 mb-2 text-secondary"><?= $row['autore'] ?></h6>
            <p class="card-text text-secondary my-2 ms-2"><?= $row['anno_pubblicazione'] ?></p>
            <p class="card-text text-end me-3 text-secondary-emphasis"><?= $row['genere'] ?></p>
            
            <!-- BOTTONI DINAMICI -->
            <div class="btn-group d-flex justify-content-center mt-4 mx-3" role="group" aria-label="Basic mixed styles example">
              <a href="/Progetto-settimanale-php1/modifica.php?id=<?= $row['id'] ?>" class="btn btn-warning mt-2 me-2"><i class="bi bi-pen me-2"></i> Modifica</a>
              <a href="/Progetto-settimanale-php1/index.php?id=<?= $row['id'] ?>" class="btn btn-danger mt-2"><i class="bi bi-trash me-2"></i> Elimina</a>
            </div>
          </div>
        </div>
      </div>
      <?php } ?>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
