<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/estrutura_mvc_base/stylelogin.css?v=1.0">
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form method="POST" action="Login/logar">
            <div class="form-group">
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
            <label for="tipo">Tipo de Usuário:</label>
                <select id="tipo" name="tipo" required>
                    <option value="admin">Admin</option>
                    <option value="infra">Infra</option>
                    <option value="solicitante">Solicitante</option>
                </select>
            </div>
            <button type="submit" class="btn-submit">Entrar</button>
            <?php if (isset($error)): ?>
                <p class="error-message"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>
        </form>
    </div>
</body>
</html>
