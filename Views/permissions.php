<h3>Permissions</h3>

<div class="tabarea">
    <div class="tabitem activetab">Grupo de Permissões</div>
    <div class="tabitem">Permissões</div>
</div>

<div class="tabcontent">
    <div class="tabbody" style="display: block;">
        <h1>Grupo de Permissões</h1>
    </div>
    <div class="tabbody" style="display: none;">
        <a href="<?= BASE_URL; ?>permissions/add">
            Adicionar Permissões
        </a>
        <table border="0" width="100%">
            <tr>
                <th>Nome da Permissão</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($permissions_list as $row):?>
            <tr>
                <td><?= $row['name']?></td>
                <td>
                    <a href="<?= BASE_URL; ?>permissions/delete/<?= $row['id']?>">
                        Excluir
                    </a>
                </td>
            </tr>
            <?php endforeach;?>
        </table>
    </div>
</div>