<?php // Exibindo as Solicitações ?>
<style>
    .hidden-column {
        display: none;
    }
</style>

<div class="container">
    <h1>Listagem de Solicitações</h1>
    <div class="top-bar">
        <form method="GET" action="/estrutura_mvc_base/Solicitacao/" class="search-form">
            <input type="text" name="search" placeholder="Buscar por solicitação" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input">
            <button type="submit" class="search-button">🔍</button>
        </form>
        <a href="/estrutura_mvc_base/Solicitacao/add" class="btn-add-new">Adicionar Nova Solicitação</a>
    </div>
    
    <table>
        <thead>
            <tr>
                <th class="hidden-column">ID</th>
                <th>Setor</th>
                <th>Solicitante</th>
                <th class="hidden-column">ID do Produto</th>
                <th>Produto</th>
                <th>Situação Produto</th>
                <th>Saldo atual do produto</th>
                <th>Quantidade Pedida</th>
                <th>OBS</th>
                <th class="hidden-column">Status</th> <!-- Ocultando a coluna de status -->
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($solicitacoes) && !empty($solicitacoes)): ?>
                <?php foreach ($solicitacoes as $row): ?>
                    <?php
                        $id_sol = htmlspecialchars($row['id']);
                        $setor = htmlspecialchars($row['setor']);
                        $solicitante = htmlspecialchars($row['solicitante']);
                        $id = htmlspecialchars($row['produto_id']);
                        $nome_produto = htmlspecialchars($row['nome_produto']);
                        $situacao_produto = htmlspecialchars($row['situacao_produto']);
                        $saldo_atual = htmlspecialchars($row['saldo_atual']);
                        $obs = htmlspecialchars($row['obs']);
                        $status = htmlspecialchars($row['status']);
                        $quantidadePedida = htmlspecialchars($row['quantidade_pedida']);

                        // Verifica se o status é igual a "aguardando atendimento"
                        if ($status == 'aguardando atendimento'):
                    ?>
                    <tr>
                        <form method="POST" action="Registro/finalizar">
                            <td class="hidden-column"><?php echo $id_sol; ?></td>
                            <td><?php echo $setor; ?></td>
                            <td><?php echo $solicitante; ?></td>
                            <td class="hidden-column"><?php echo $id; ?></td>
                            <td><?php echo $nome_produto; ?></td>
                            <td><?php echo $situacao_produto; ?></td>
                            <td><?php echo $saldo_atual; ?></td>
                            <td><?php echo $quantidadePedida; ?></td>
                            <td><?php echo $obs; ?></td>
                            <td class="hidden-column"><?php echo $status; ?></td>
                            <td>
                                <input type="hidden" name="id_sol" value="<?php echo $id_sol; ?>">
                                <input type="hidden" name="destino" value="<?php echo $setor; ?>">
                                <input type="hidden" name="solicitante" value="<?php echo $solicitante; ?>">
                                <input type="hidden" name="id" value="<?php echo $id; ?>">
                                <input type="hidden" name="nome_produto" value="<?php echo $nome_produto; ?>">
                                <input type="hidden" name="situacao_produto" value="<?php echo $situacao_produto; ?>">
                                <input type="hidden" name="saldo_atual" value="<?php echo $saldo_atual; ?>">
                                <input type="hidden" name="obs" value="<?php echo $obs; ?>">
                                <input type="hidden" name="status" value="<?php echo $status; ?>">
                                <input type="hidden" name="quantidade" value="<?php echo $quantidadePedida; ?>">
                                <input type="hidden" name="tipo_operacao" value="retirada">
                                <button type="submit" class="btn-edit">Finalizar</button>
                            </td>
                        </form>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">Nenhuma solicitação encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
