<?php
//Formulário para editar um produto puxando os dados selecionado do produto selecionado!!!!

// Captura os dados do produto enviados via GET
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$fornecedor = isset($_GET['fornecedor']) ? $_GET['fornecedor'] : '';
$local = isset($_GET['local']) ? $_GET['local'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$custo = isset($_GET['custo']) ? trim($_GET['custo']) : '';
$situacao = isset($_GET['situacao']) ? $_GET['situacao'] : '';
?>

<div class="add-product-container">
    <h1>Editar Produto</h1>
    <form action="Produto/atualizar" method="post">

        <!-- Campo oculto para ID -->
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($nome); ?>" required>
        </div>
        <div class="form-group">
            <label for="local">Local:</label>
            <input type="text" id="local" name="local" value="<?php echo htmlspecialchars($local); ?>" required>
        </div>
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" id="categoria" name="categoria" value="<?php echo htmlspecialchars($categoria); ?>" required>
        </div>
        <div class="form-group">
            <label for="situacao">Situação:</label>
            <select id="situacao" name="situacao" required>
                <option value="">Selecione-</option>
                <option value="novo" <?php echo ($situacao == 'novo') ? 'selected' : ''; ?>>Novo</option>
                <option value="usado" <?php echo ($situacao == 'usado') ? 'selected' : ''; ?>>Usado</option>
            </select>
        </div>

        <div class="form-group">
            <label for="custo">Custo:</label>
            <input type="number" id="custo" name="custo" step="0.01" value="<?php echo htmlspecialchars($custo); ?>" required>
        </div>
        <div class="form-group">
            <label for="fornecedor">Fornecedor:</label>
            <input type="text" id="fornecedor" name="fornecedor" value="<?php echo htmlspecialchars($fornecedor); ?>" required>
        </div>
        <button type="submit" class="btn-submit">Salvar Alterações</button>
    </form>
</div>
