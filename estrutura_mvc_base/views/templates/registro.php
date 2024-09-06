<?php //Exibição dos registro ?>
<div class="container">
    <h1>Listagem de Registros</h1>
    <form method="GET" action="/estrutura_mvc_base/Registro/" class="search-form">
            <input type="text" name="search" placeholder="Buscar por produto" value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" class="search-input">
            <button type="submit" class="search-button">Buscar</button>
    </form>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Produto</th>
                <th>Tipo de Operação</th>
                <th>Quantidade</th>
                <th>Destino</th>
                <th>Observações</th>
                <th>Data e Hora</th>

            </tr>
        </thead>
        <tbody>
            <?php if (isset($registro) && !empty($registro)):?>
                <?php foreach ($registro as $row): ?>
                    <?php
                        $id = htmlspecialchars($row['id']);
                        $nome_prod = htmlspecialchars($row['NomeProduto']);
                        $tipo = htmlspecialchars($row['tipo']); // Corrigido aqui
                        $quantidade = htmlspecialchars($row['quantidade']);
                        $destino = htmlspecialchars($row['destino']);
                        $obs = htmlspecialchars($row['obs']);
                        $data = htmlspecialchars($row['data']);


                    ?>
                    <tr>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $nome_prod; ?></td>
                        <td><?php echo $tipo; ?></td> <!-- Corrigido aqui -->
                        <td><?php echo $quantidade; ?></td>
                        <td><?php echo $destino; ?></td>
                        <td><?php echo $obs; ?></td>
                        <td><?php echo $data; ?></td>

                    </tr>
                <?php endforeach;?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Nenhuma operação encontrada.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
