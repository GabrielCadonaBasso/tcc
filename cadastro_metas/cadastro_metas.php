<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema</title>
    <link rel="stylesheet" href="style.css">

    <?php
    include_once '../functions.php';

    verificaSessao();
    ?>
</head>

<body>
    <nav>
        <div class="hamburger" onclick="toggleMenu()">
            <div></div>
            <div></div>
            <div></div>
        </div>

        <div class="menu" id="menu">
            <a href="../pagina_inicial/pagina_inicial.php" class="metas">METAS</a>
            <a href="#home" class="cadastrar-metas">CADASTRAR META</a>
        </div>

        <a href="../logout/logout.php"><button class="logout">Sair</button></a>
    </nav>

    <div class="container">
        <div class="square">
            
        </div>
    </div>

    <script>
        function toggleMenu() {
            document.getElementById("menu").classList.toggle("active");
        }
    </script>
</body>

</html>