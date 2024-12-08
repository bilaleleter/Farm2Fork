<?php
require_once 'C:\xampp\htdocs\dashboard\recettenadine\controleur\recetteControler.php'; 
require_once 'C:/xampp/htdocs/dashboard/recettenadine/config.php';

 

$results = [];
$message = '';

if (isset($_GET['query']) && !empty($_GET['query'])) {
    $query = htmlspecialchars($_GET['query']); // Sanitize user input

    $controller = new recettes(); // Instantiate the controller
    try {
        // Fetch results from the controller
        $results = $controller->searchRecettes($query);

        if (empty($results)) {
            $message = 'No results found for "' . htmlspecialchars($query) . '".';
        }
    } catch (Exception $e) {
        $message = 'Error: ' . $e->getMessage();
    }
} else {
    $message = 'Please enter a search query.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Recipes</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .search-form { margin-bottom: 20px; }
        ul { list-style-type: none; padding: 0; }
        li { margin-bottom: 10px; }
    </style>
</head>
<body>
    <h1>Search Recipes</h1>

    <!-- Search Form -->
    <form method="GET" action="search.php" class="search-form">
        <input 
            type="text" 
            name="query" 
            class="form-control" 
            placeholder="Type here to search..." 
            value="<?= isset($_GET['query']) ? htmlspecialchars($_GET['query']) : '' ?>" 
            required
        >
        <button type="submit">Search</button>
    </form>

    <!-- Display Results or Message -->
    <?php if (!empty($message)): ?>
        <p><?= $message ?></p>
    <?php endif; ?>

    <?php if (!empty($results)): ?>
        <h2>Search Results:</h2>
        <ul>
            <?php foreach ($results as $result): ?>
                <li>
                    <strong><?= htmlspecialchars($result['nomr']) ?></strong>: 
                    <?= htmlspecialchars($result['descriptionr']) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</body>
</html>