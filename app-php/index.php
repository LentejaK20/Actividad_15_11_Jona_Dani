<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Nombres</title>
    <style>
        body { font-family: sans-serif; margin: 2rem; background-color: #f4f4f4; }
        h1 { color: #333; }
        .container { background-color: #fff; padding: 1rem 2rem; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .error { color: red; font-weight: bold; }
        ul { list-style-type: disc; padding-left: 20px; }
        li { font-size: 1.2rem; margin-bottom: 0.5rem; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Nombres del Grupo (desde la Base de Datos)</h1>
        <?php
        $dbHost = getenv('DB_HOST');
        $dbName = getenv('DB_NAME');
        $dbUser = getenv('DB_USER');
        $dbPass = getenv('DB_PASSWORD');

        try {
            $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";
            $pdo = new PDO($dsn, $dbUser, $dbPass, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);

            $stmt = $pdo->prepare("SELECT nombre FROM nombres ORDER BY nombre");
            $stmt->execute();
            $nombres = $stmt->fetchAll();

            if (count($nombres) > 0) {
                echo "<ul>";
                foreach ($nombres as $row) {
                    echo "<li>" . htmlspecialchars($row['nombre']) . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No se encontraron nombres en la base de datos.</p>";
            }

        } catch (PDOException $e) {
            echo "<p class='error'>Error al conectar a la base de datos: " . htmlspecialchars($e->getMessage()) . "</p>";
        }
        ?>
    </div>
</body>
</html>