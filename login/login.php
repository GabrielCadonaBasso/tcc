<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Tcc</title>

    <?php
        include_once '../functions.php';

        verificaSessaologin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST'){
            $email_user = $_POST['email_user'] ?? '';
            $password_user = $_POST['password_user'] ?? ''; 
        
            if(!$email_user || !$password_user){
                echo "Preencha todos os campos.";
                exit;
            }

            $dados = [
                'email_user' => $email_user,
                'password_user' => $password_user
            ];

            $usuario = executarSelect(
                "SELECT * FROM users WHERE email_user = :email_user AND password_user = :password_user",
                ['email_user' => $email_user, 'password_user' => $password_user]
            );
            
            if($usuario){
                iniciaSessao($email_user, $password_user);
                header('Location: ../pagina_inicial/pagina_inicial.php');
            }else{
                $msgErro = "Email ou senha incorretos.";       
            }
        }
    ?>
</head>

<body>
    <div class="square">
        <h1>Login</h1>

        <?php
            apresentaErro($msgErro);
        ?>

        <form action="" class="form-login" method="POST">
            <input type="email" name="email_user" id="" placeholder="e-mail" class="input-text">
            <input type="password" name="password_user" id="" placeholder="senha" class="input-text">

            <div class="div-button">
                <a href="" class="link">
                    <button type="submit" class="button-default">logar</button>
                </a>
                <a href="../cadastro/cadastro.php" class="link">
                    <button type="button" class="button-default">cadastrar</button>
                </a>
            </div>
        </form>
    </div>
</body>

</html>