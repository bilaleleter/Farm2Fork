<?php


require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\View\BackOfficeNadine\pages\dompdf\vendor\autoload.php';
use Dompdf\Dompdf;
use Dompdf\Options;

try {
    // Database connection
    require_once 'C:\xampp\htdocs\Farm2Fork MAIN BRANCH\Integration\Core\config.php';
    $pdo = Config::getConnexion();

    // Fetch data
    $sql = "SELECT * FROM recette";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        die("Database query failed: " . implode(", ", $stmt->errorInfo()));
    }

    $recettes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if (empty($recettes)) {
        die("No data found in the 'recette' table.");
    }

    // Configure Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $options->set('isRemoteEnabled', true);
    $dompdf = new Dompdf($options);

    // Build HTML content
    $html = <<<HTML
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <h1>Recette Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Description</th>
            <th>Difficulty</th>
            <th>Time</th>
        </tr>
    HTML;

    foreach ($recettes as $recette) {
        $html .= <<<HTML
        <tr>
            <td>{$recette['idr']}</td>
            <td>{$recette['nomr']}</td>
            <td>{$recette['descriptionr']}</td>
            <td>{$recette['difiiculte']}</td>
            <td>{$recette['tempsr']}</td>
        </tr>
        HTML;
    }

    $html .= '</table>';

    // Debug generated HTML (optional)
    // echo $html; exit;

    // Load HTML and render PDF
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();

    // Clean output buffer and stream PDF
    ob_end_clean();
    $dompdf->stream("recettes_file", array('Attachment' => 0));

} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
} catch (Exception $e) {
    die("General Error: " . $e->getMessage());
}
?>
