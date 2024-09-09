<?php //mostrar os produtos disponivel para solicitar ?>
<div class="container">
    <h1>Solicitação de Produtos</h1>
    
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Categoria</th>
                <th>Situação</th>
                <th>Saldo</th>
                <th>Ação</th>
            </tr>
        </thead>
        <tbody>

            <?php if (isset($produtos) && !empty($produtos)): ?>
                <?php echo '<pre>'; print_r($row); echo '</pre>'; ?>

                <?php foreach ($produtos as $row): ?>
                    <?php
                        $nome = htmlspecialchars($row['nome']);
                        $categoria = htmlspecialchars($row['categoria']);
                        $situacao = htmlspecialchars($row['situacao']);
                        $saldo = htmlspecialchars($row['saldo_final']);
                    ?>
                    <tr>
                        <td><?php echo $nome; ?></td>
                        <td><?php echo $categoria; ?></td>
                        <td><?php echo $situacao; ?></td>
                        <td><?php echo $saldo; ?></td>
                        <td>
                            <button class="btn-edit" onclick="window.location.href='/estrutura_mvc_base/Solicitacao/solicitar?id=<?php echo htmlspecialchars($row['id']); ?>&nome=<?php echo htmlspecialchars($nome); ?>&categoria=<?php echo htmlspecialchars($categoria); ?>&situacao=<?php echo htmlspecialchars($situacao); ?>&saldo_final=<?php echo htmlspecialchars($saldo); ?>'">
                                Solicitar
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Nenhum produto encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
