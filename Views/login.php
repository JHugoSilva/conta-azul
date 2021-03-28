<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>assets/css/login.css">
</head>
<body>
    <div class="loginarea">
        <form action="" method="post">
            <input type="email" name="email" placeholder="Digite seu E-mail">
            <input type="password" name="password" placeholder="Digite sua Senha">
            <input type="submit" value="Entrar">
            <?php if(isset($error) && !empty($error)):?>
                <div class="warning">
                    <?= $error ?>
                </div>
            <?php endif;?>
        </form>
    </div>
</body>
</html>