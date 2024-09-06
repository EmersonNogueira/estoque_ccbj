<?php
//Criar um novo registro pegando os dados do prooduto selecionado
// Captura os dados do produto enviados via GET
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$fornecedor = isset($_GET['fornecedor']) ? $_GET['fornecedor'] : '';
$local = isset($_GET['local']) ? $_GET['local'] : '';
$categoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
$custo = isset($_GET['custo']) ? trim($_GET['custo']) : '';
$situacao = isset($_GET['situacao']) ? $_GET['situacao'] : '';
$saldo = isset($_GET['saldo_final']) ? $_GET['saldo_final'] : '';
?>

<div class="add-product-container">
    <h1>Registro de Produto</h1>
    <form action="Registro/processa_registro" method="POST">


        <div class="form-group">
            <label for="produto_nome">Nome do Produto:</label>
            <input type="text" id="produto_nome" name="produto_nome" value="<?php echo htmlspecialchars($nome); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="condicao_produto">Condição do Produto:</label>
            <input type="text" id="condicao_produto" name="condicao_produto" value="<?php echo htmlspecialchars($situacao); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="saldo_atual">Saldo Atual:</label>
            <input type="number" id="saldo_atual" name="saldo_atual" value="<?php echo htmlspecialchars($saldo); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="tipo_operacao">Tipo de Operação:</label>
            <select id="tipo_operacao" name="tipo_operacao" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <option value="compra">Compra</option>
                <option value="retirada">Retirada</option>
                <option value="devolucao">Devolução</option>
            </select>
        </div>

        <div class="form-group">
            <label for="tipo_operacao">Destino:</label>
            <select id="destino" name="destino" required>
                <option value="" disabled selected>Selecione o tipo</option>
                <option value="estoque">ESTOQUE</option>
                <option value="escola">ESCOLA</option>
                <option value="acao">AÇÃO CULTURAL</option>
                <option value="comunicacao">COMUNICAÇÃO</option>
                <option value="narte">NARTE</option>
            </select>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade do registro:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" required>
        </div>

        <div class="form-group">
            <label for="obs">Observação</label>
            <input type="text" id="obs" name="obs">
        </div>



        <!-- Campo oculto para o ID do produto -->
        <input type="hidden" id="produto_id" name="id" value="<?php echo htmlspecialchars($id); ?>">

        <button type="submit" class="btn-submit">Registrar</button>
    </form>
</div>
