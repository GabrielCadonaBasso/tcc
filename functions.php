<?php
$msgErro = "";

function conectarBanco() {
    $host = 'localhost';
    $dbname = 'banco';
    $usuario = 'root';
    $senha = '';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $usuario, $senha);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    } catch (PDOException $e) {
        die("Erro na conexão com o banco: " . $e->getMessage());
    }
}

function executarInsert($tabela, $dados) {
    $pdo = conectarBanco();

    $colunas = implode(", ", array_keys($dados));
    $valores = ":" . implode(", :", array_keys($dados));

    $sql = "INSERT INTO $tabela ($colunas) VALUES ($valores)";
    $stmt = $pdo->prepare($sql);

    return $stmt->execute($dados);
}

function executarUpdate($tabela, $dados, $condicao, $paramsCondicao) {
    $pdo = conectarBanco();

    $set = [];
    foreach ($dados as $coluna => $valor) {
        $set[] = "$coluna = :$coluna";
    }
    $setClause = implode(", ", $set);

    $sql = "UPDATE $tabela SET $setClause WHERE $condicao";
    $stmt = $pdo->prepare($sql);

    // Junta os dados do update com os parâmetros da condição
    return $stmt->execute(array_merge($dados, $paramsCondicao));
}

function executarDelete($tabela, $condicao, $params) {
    $pdo = conectarBanco();
    $sql = "DELETE FROM $tabela WHERE $condicao";
    $stmt = $pdo->prepare($sql);
    return $stmt->execute($params);
}

function executarSelect($sql, $params = []) {
    $pdo = conectarBanco();
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function apresentaErro($msgErro){
    if ($msgErro !== "") {
        echo "<p class='msg-Erro'>$msgErro</p>";
    }  
}

?>
