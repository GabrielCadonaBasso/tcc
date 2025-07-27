<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tcc</title>
    <?php
        require_once '../functions.php';
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $name_user  = $_POST['name_user'] ?? '';
            $email_user = $_POST['email_user'] ?? '';
            $password_user = $_POST['password_user'] ?? ''; 
        
            if(!$name_user || !$email_user || !$password_user){
                echo "Preencha todos os campos.";
                exit;
            }

            $dados = [
                'name_user' => $name_user,
                'email_user' => $email_user,
                'password_user' => $password_user
            ];

            $usuario = executarSelect(
                "SELECT * FROM users WHERE email_user = :email_user AND password_user = :password_user",
                ['email_user' => $email_user, 'password_user' => $password_user]
            );
            
            if(!$usuario){
                if (executarInsert('users', $dados)) {
                    header('Location: ../login/login.php');
                } else {
                    $msgErro = "Erro ao cadastrar usuário.";
                }
            }else{
                $msgErro = "Usuário já cadastrado.";       
            }
        }
    ?>
</head>

<body>
    <div class="square">
        <h1>Cadastro</h1>
        
        <?php
            apresentaErro($msgErro);
        ?>

        <form action="" class="form-login" method="POST">
            <input type="text" name="name_user" id="" placeholder="nome" class="input-text" required>
            <input type="email" name="email_user" id="" placeholder="e-mail" class="input-text" required>
            <input type="password" name="password_user" id="" placeholder="senha" class="input-text" required>

            <div class="div-button">
                <a href="" class="link">
                    <button type="submit" class="button-default">cadastrar</button>
                </a>
                <a href="../login/login.php" class="link">
                    <button type="button" class="button-default">voltar</button>
                </a>
            </div>
        </form>
    </div>
</body>

</html>