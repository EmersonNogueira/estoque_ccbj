<div class="container">
    <h1>Listagem de Produtos</h1>
    <?php if (isset($_SESSION['mensagem_confirmacao'])): ?>
        <script type="text/javascript">
            window.onload = function() {
                alert('<?php echo htmlspecialchars($_SESSION['mensagem_confirmacao']); ?>');
            };
        </script>
        <?php unset($_SESSION['mensagem_confirmacao']); // Limpa a mensagem após exibir ?>
    <?php endif; ?>
    <div class="top-bar">
        <form method="GET" action="/estrutura_mvc_base/Produto/" class="search-form">
            <input type="text" name="search" placeholder="Buscar por nome" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input">
            <button type="submit" class="search-button">Buscar</button>
        </form>
        <div class="action-buttons">
            <a href="/estrutura_mvc_base/Produto/produtosolicitar" class="btn-add-new">Solicitar_Produtos</a>
            <a href="/estrutura_mvc_base/Produto/add" class="btn-add-new">Adicionar Novo Produto</a>
        </div>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Local</th>
                <th>Categoria</th>
                <th>Situação</th>
                <th>Saldo Final</th>
                <th>Custo</th>
                <th>Fornecedor</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>
            <?php if (isset($produtos) && !empty($produtos)): ?>
                <?php foreach ($produtos as $row): ?>
                    <?php
                        $nome = htmlspecialchars($row['nome']);
                        $local = htmlspecialchars($row['local']);
                        $categoria = htmlspecialchars($row['categoria']);
                        $situacao = htmlspecialchars($row['situacao']);
                        $saldo = htmlspecialchars($row['saldo_final']);
                        $custo = htmlspecialchars($row['custo']);
                        $fornecedor = htmlspecialchars($row['fornecedor']);
                    ?>
                    <tr>
                        <td><?php echo $nome; ?></td>
                        <td><?php echo $local; ?></td>
                        <td><?php echo $categoria; ?></td>
                        <td><?php echo $situacao; ?></td>
                        <td><?php echo $saldo; ?></td>
                        <td><?php echo $custo; ?></td>
                        <td><?php echo $fornecedor; ?></td>
                        <td>
                            <button class="btn-register" onclick="window.location.href='/estrutura_mvc_base/Produto/registroprod?id=<?php echo htmlspecialchars($row['id']); ?>&nome=<?php echo htmlspecialchars($nome); ?>&local=<?php echo htmlspecialchars($local); ?>&categoria=<?php echo htmlspecialchars($categoria); ?>&situacao=<?php echo htmlspecialchars($situacao); ?>&custo=<?php echo htmlspecialchars($custo); ?>&fornecedor=<?php echo htmlspecialchars($fornecedor); ?>&saldo_final=<?php echo htmlspecialchars($saldo); ?>'">
                                Registro
                            </button>

                            <button class="btn-edit" onclick="window.location.href='/estrutura_mvc_base/Produto/editarprod?id=<?php echo htmlspecialchars($row['id']); ?>&nome=<?php echo htmlspecialchars($nome); ?>&local=<?php echo htmlspecialchars($local); ?>&categoria=<?php echo htmlspecialchars($categoria); ?>&situacao=<?php echo htmlspecialchars($situacao); ?>&custo=<?php echo htmlspecialchars($custo); ?>&fornecedor=<?php echo htmlspecialchars($fornecedor); ?>'">
                                Editar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Nenhum produto encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
