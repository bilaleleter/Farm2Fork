<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Gestion Feedback - Tableau de Bord</title>

    <!-- Fonts and icons -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fdf2e7;
            color: #1c5739;
        }

        main {
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th,
        table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #1c5739;
            color: #fdf2e7;
        }

        textarea {
            width: 100%;
            resize: none;
            padding: 8px;
        }

        .btn-sm {
            padding: 5px 10px;
        }

        .sidenav {
            width: 250px;
            background-color: #fff;
            height: 100%;
            position: fixed;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        .main-content {
            margin-left: 260px;
        }
        /* Formulaire de recherche */
form.row.g-3 {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

/* Pagination */
.pagination .page-item.active .page-link {
    background-color: #1c5739;
    border-color: #1c5739;
    color: #fff;
}

.pagination .page-item .page-link {
    color: #1c5739;
}

.pagination .page-item .page-link:hover {
    background-color: #e8f5e9;
    border-color: #1c5739;
    color: #1c5739;
}

    </style>
    
</head>

<body class="g-sidenav-show bg-gray-100">
    <!-- Sidebar -->
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2" id="sidenav-main">
        <div class="sidenav-header">
            <a class="navbar-brand px-4 py-3 m-0" href="index.php">
                <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="logo">
                <span class="ms-1 text-sm text-dark">Gestion des Commandes</span>
            </a>
        </div>
        <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
            <ul class="navbar-nav">
            <li class="nav-item">
                    <a class="nav-link text-dark" href="\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeUser\template\pages\user_management.php">
                        <i class="material-symbols-rounded">receipt_long</i>
                        <span class="nav-link-text ms-1">Retourner au dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="commande.php">
                        <i class="material-symbols-rounded">receipt_long</i>
                        <span class="nav-link-text ms-1">Commandes</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="livraison.php">
                        <i class="material-symbols-rounded">local_shipping</i>
                        <span class="nav-link-text ms-1">Livraisons</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="suivi-livraison.php">
                        <i class="material-symbols-rounded">track_changes</i>
                        <span class="nav-link-text ms-1">Suivi Livraison</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark" href="historique.php">
                        <i class="material-symbols-rounded">dashboard</i>
                        <span class="nav-link-text ms-1">Historique</span>
                    </a>
                </li>
                <li class="nav-item">
                   <a class="nav-link text-dark" href="gestion_feedback.php">
                        <i class="material-symbols-rounded">comments</i>
                        <span class="nav-link-text ms-1">Feedbacks</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl">
            <div class="container-fluid py-1 px-3">
                <h3>Gestion des Feedbacks</h3>
            </div>
        </nav>

        <?php
        // Connexion à la base de données
        $dsn = 'mysql:host=localhost;dbname=farm2forkdb;charset=utf8';
        $username = 'root';
        $password = '';

        try {
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }

        // Suppression d'un commentaire
        if (isset($_POST['delete_feedback'])) {
            $id = $_POST['feedback_id'];
            $stmt = $pdo->prepare("DELETE FROM feedback WHERE id = ?");
            $stmt->execute([$id]);
            echo "<script>alert('Commentaire supprimé avec succès.');</script>";
        }

        // Répondre à un commentaire
        if (isset($_POST['respond_feedback'])) {
            $feedback_id = $_POST['feedback_id'];
            $admin_response = $_POST['admin_response'];

            $stmt = $pdo->prepare("UPDATE feedback SET admin_response = ? WHERE id = ?");
            $stmt->execute([$admin_response, $feedback_id]);
            echo "<script>alert('Réponse ajoutée avec succès.');</script>";
        }


        // Pagination
$limit = 5; // Nombre de feedbacks par page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Filtrage et recherche
$filter_rating = isset($_GET['rating']) ? (int)$_GET['rating'] : null;
$search_term = isset($_GET['search']) ? trim($_GET['search']) : null;

// Construire les conditions pour la requête SQL
$conditions = [];
if ($filter_rating) {
    $conditions[] = "rating = $filter_rating";
}
if ($search_term) {
    $conditions[] = "comment LIKE '%$search_term%'";
}

$where_clause = count($conditions) > 0 ? "WHERE " . implode(' AND ', $conditions) : '';

// Requête SQL pour récupérer les feedbacks filtrés
$sql = "SELECT * FROM feedback $where_clause ORDER BY created_at DESC LIMIT $start, $limit";
$stmt = $pdo->query($sql);
$feedbacks = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Compter le nombre total de feedbacks pour la pagination
$count_sql = "SELECT COUNT(*) FROM feedback $where_clause";
$total_feedbacks = $pdo->query($count_sql)->fetchColumn();
$total_pages = ceil($total_feedbacks / $limit);

        ?>



<form method="GET" class="row g-3 mb-4">
    <div class="col-md-4">
        <label for="rating" class="form-label">Filtrer par note :</label>
        <select name="rating" id="rating" class="form-select">
            <option value="">Toutes les notes</option>
            <?php for ($i = 1; $i <= 5; $i++): ?>
                <option value="<?= $i ?>" <?= ($filter_rating == $i) ? 'selected' : '' ?>>
                    <?= $i ?> étoile<?= ($i > 1) ? 's' : '' ?>
                </option>
            <?php endfor; ?>
        </select>
    </div>
    <div class="col-md-6">
        <label for="search" class="form-label">Rechercher :</label>
        <input type="text" name="search" id="search" class="form-control" 
               placeholder="Rechercher un commentaire..." 
               value="<?= htmlspecialchars($search_term) ?>">
    </div>
    <div class="col-md-2 d-flex align-items-end">
        <button type="submit" class="btn btn-primary w-100">Appliquer</button>
    </div>
</form>


        <!-- Tableau des feedbacks -->
        <section class="overview">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Note</th>
                    <th>Commentaire</th>
                    <th>Réponse de l'Admin</th>
                    <th>Réponse de client</th>

                    <th>Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($feedbacks as $feedback): ?>
                    <tr>
                        <td><?= htmlspecialchars($feedback['id']) ?></td>
                        <td><?= htmlspecialchars($feedback['rating']) ?></td>
                        <td><?= htmlspecialchars($feedback['comment']) ?></td>
                        <td><?= htmlspecialchars($feedback['admin_response'] ?? 'Aucune réponse') ?></td>
                        <td><?= htmlspecialchars($feedback['client_response'] ?? 'Aucune réponse') ?></td>

                        <td><?= htmlspecialchars($feedback['created_at']) ?></td>
                        <td>
                            <!-- Supprimer un commentaire -->
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="feedback_id" value="<?= $feedback['id'] ?>">
                                <button type="submit" name="delete_feedback" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>

                            <!-- Répondre à un commentaire -->
                            <form method="POST" style="display:inline;">
                                <textarea name="admin_response" placeholder="Réponse..."></textarea>
                                <input type="hidden" name="feedback_id" value="<?= $feedback['id'] ?>">
                                <button type="submit" name="respond_feedback" class="btn btn-primary btn-sm">Répondre</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <nav aria-label="Pagination des feedbacks">
    <ul class="pagination justify-content-center">
        <?php for ($i = 1; $i <= $total_pages; $i++): ?>
            <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                <a class="page-link" 
                   href="?page=<?= $i ?>&rating=<?= $filter_rating ?>&search=<?= htmlspecialchars($search_term) ?>">
                   <?= $i ?>
                </a>
            </li>
        <?php endfor; ?>
    </ul>
</nav>


        </section>
    </main>
</body>

</html>
