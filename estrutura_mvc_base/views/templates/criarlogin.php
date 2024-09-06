<?php //Criar Login ?>
<div class="container">
    <h1>Cadastro de Usuário</h1>
    <form method="POST" action="Login/usuario">
        <div class="form-group">
            <label for="nome">Usuário:</label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <div class="form-group">
            <label for="tipo">Tipo de Usuário:</label>
            <select id="tipo" name="tipo" required>
                <option value="admin">Admin</option>
                <option value="infra">Infra</option>
                <option value="solicitante">Solicitante</option>
            </select>
        </div>
        <button type="submit" class="btn-submit">Cadastrar</button>
    </form>
</div>
