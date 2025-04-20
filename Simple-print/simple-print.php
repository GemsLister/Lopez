<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '../../vendor/autoload.php';
    require_once __DIR__ . '../../includes/db.php';

    $mpdf = new \Mpdf\Mpdf();

    // Fetch products from the database
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $html = '
    <html>
        <head>
            <style>
                body {
                    font-family: sans-serif;
                }
                table {
                    width: 100%;
                    border-collapse: collapse;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
                .signature {
                    margin-top: 50px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            <h2>Product List</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>';
    
    $count = 1;
    foreach ($products as $product) {
        $html .= '
                    <tr>
                        <td>' . $count++ . '</td>
                        <td>' . htmlspecialchars($product['productName']) . '</td>
                        <td>' . htmlspecialchars($product['category']) . '</td>
                        <td>' . htmlspecialchars($product['price']) . '</td>
                        <td>' . htmlspecialchars($product['stock']) . '</td>
                    </tr>';
    }

    $html .= '
                </tbody>
            </table>
            <div class="signature">
                <p>======================================================</p>
                <p><strong>General Manager</strong></p>
            </div>
        </body>
    </html>';

    // Set footer and output PDF
    $mpdf->SetHTMLFooter('<div style="text-align: left;">Page {PAGENO} of {nbpg}</div>');
    $mpdf->WriteHTML($html);
    $mpdf->Output('', 'I');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Print</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Simple-print/simple-scratch-style.css">
</head>
<body class="p-5">
    <form method="POST">
        <button class="btn btn-primary" type="submit">Print Products</button>
    </form>
</body>
</html>

<!-- <

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once __DIR__ . '../../vendor/autoload.php';
    require_once __DIR__ . '../../includes/db.php';  // Correct path to db.php
    $mpdf = new \Mpdf\Mpdf();

    // Set content type for PDF
    header('Content-Type: application/pdf');

    // Fetch products from the database
    $stmt = $pdo->query("SELECT * FROM products");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $count = 1;

    // Initialize HTML variable
    $html = '
    <html>
        <head>
            <style>
                table {
                    width: 100%;
                    border-collapse: collapse;
                }
                th, td {
                    border: 1px solid black;
                    padding: 8px;
                    text-align: left;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>
        </head>
        <body>
            <h4>Product List</h4>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                    </tr>
                </thead>
                <tbody>
    ';

    // Populate table with product data
    foreach ($products as $product) {
        $html .= '
            <tr>
                <td>' . $count++ . '</td>
                <td>' . htmlspecialchars($product['productName']) . '</td>
                <td>' . htmlspecialchars($product['category']) . '</td>
                <td>' . htmlspecialchars($product['price']) . '</td>
                <td>' . htmlspecialchars($product['stock']) . '</td>
            </tr>
        ';
    }

    $html .= '
                    </tbody>
                </table>
                <div class="signature">
                    <p>======================================================</p>
                    <p><strong>General Manager</strong></p>
                </div>
            </body>
    </html>
    ';

    // Set PDF footer
    $mpdf->SetHTMLFooter('<footer class="text-start">Page {PAGENO}/{nbpg}</footer>');
    
    // Write HTML to PDF
    $mpdf->WriteHTML($html);
    $mpdf->Output('', 'I');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Print</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../Simple-print/simple-scratch-style.css">
</head>
<body>
    <form action="" method="POST">
        <button class="btn btn-primary" type="submit">Print products</button>
    </form>
</body>
</html> -->