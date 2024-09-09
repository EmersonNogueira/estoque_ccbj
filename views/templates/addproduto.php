<?php // Formulário para adicionar um produto?>
<div class="add-product-container">
        <h1>Cadastro de Novo Produto</h1>
        <form action="Produto/adicionarprod" method="post">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="local">Local:</label>
                <input type="text" id="local" name="local" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria:</label>
                <input type="text" id="categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="situacao">Situação:</label>
                <select id="situacao" name="situacao" required>
                    <option value="">Selecione-</option>
                    <option value="novo">Novo</option>
                    <option value="usado">Usado</option>
                </select>
            </div>
            <div class="form-group">
                <label for="saldo">Saldo Final:</label>
                <input type="number" id="saldo" name="saldo" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="custo">Custo:</label>
                <input type="number" id="custo" name="custo" step="0.01" required>
            </div>
            <div class="form-group">
                <label for="fornecedor">Fornecedor:</label>
                <input type="text" id="fornecedor" name="fornecedor" required>
            </div>
            <button type="submit" class="btn-submit">Cadastrar Produto</button>
        </form>
    </div>