<?php
// Captura os dados do produto enviados via GET
$id = isset($_GET['id']) ? $_GET['id'] : '';
$nome = isset($_GET['nome']) ? $_GET['nome'] : '';
$situacao = isset($_GET['situacao']) ? $_GET['situacao'] : '';
$saldo = isset($_GET['saldo_final']) ? $_GET['saldo_final'] : '';
?>

<div class="add-product-container">
    <h1>Solicitar Produto</h1>
    <form action="Solicitacao/criarsolicitacao" method="POST" onsubmit="return validarQuantidade()">

        <div class="form-group">
            <label for="nome_produto">Nome do Produto:</label>
            <input type="text" id="nome_produto" name="nome_produto" value="<?php echo htmlspecialchars($nome); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="situacao_produto">Condição do Produto:</label>
            <input type="text" id="situacao_produto" name="situacao_produto" value="<?php echo htmlspecialchars($situacao); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="saldo_produto">Saldo Atual:</label>
            <input type="number" id="saldo_produto" name="saldo_produto" value="<?php echo htmlspecialchars($saldo); ?>" readonly>
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade que deseja do produto:</label>
            <input type="number" id="quantidade" name="quantidade" min="1" required>
        </div>

        <div class="form-group">
            <label for="destino">Destino:</label>
            <select id="destino" name="destino" required>
                <option value="" disabled selected>Selecione o destino</option>
                <option value="infra">INFRA</option>
                <option value="administrativo">ADMINISTRATIVO</option>
                <option value="escola">ESCOLA</option>
                <option value="acao">AÇÃO CULTURAL</option>
                <option value="comunicacao">COMUNICAÇÃO</option>
                <option value="narte">NARTE</option>
            </select>
        </div>

        <div class="form-group">
            <label for="solicitante">Seu nome:</label>
            <input type="text" id="solicitante" name="solicitante" required>
        </div>

        <div class="form-group">
            <label for="obs">Observação:</label>
            <input type="text" id="obs" name="obs">
        </div>

        <!-- Campo oculto para o ID do produto -->
        <input type="hidden" id="produto_id" name="produto_id" value="<?php echo htmlspecialchars($id); ?>">

        <button type="submit" class="btn-submit">Confirmar Solicitação</button>
    </form>
</div>

<script>
function validarQuantidade() {
    const saldo = parseInt(document.getElementById('saldo_produto').value, 10);
    const quantidade = parseInt(document.getElementById('quantidade').value, 10);

    if (isNaN(saldo) || isNaN(quantidade)) {
        alert('Verifique os valores inseridos.');
        return false;
    }

    if (quantidade > saldo) {
        alert('A quantidade solicitada não pode ser maior que o saldo disponível.');
        return false;
    }
    return true;
}
</script>
