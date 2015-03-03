<<<<<<< HEAD
<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Html->link('Adicionar cliente', ['action' => 'add'], ['class' => 'btn btn-danger pull-right'])?>
<br style="clear: both;">
<hr>
<table class="table table-hover table-condensed table-bordered">
    <thead>
        <tr>
            <th style="width: 100px"><?= $this->Paginator->sort('registration', 'Matrícula') ?></th>
            <th style=""><?= $this->Paginator->sort('name', 'Nome') ?></th>
            <th style="width: 100px" class="text-center"><?= $this->Paginator->sort('status') ?></th>
            <th style="width: 90px" class="text-center"></th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= h($customer->registration) ?></td> 
                <td><?= h($customer->name) ?></td>     
                <td class="text-center">
                    <?= $customer->status ? '<span class="label label-success">Ativo</span>': '<span class="label label-danger">Inativo</span>'; ?>
                </td>      
                <td class="text-center">
                    <div class="btn-group">
                        <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-th-list"></span>',
                                [
                                    'controller' => 'cards',
                                    'action' => 'customer',
                                    $customer->id
                                ],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => 'Ver fichas'
                                ])
                        ?>
                        <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-pencil"></span>',
                                ['action' => 'edit', $customer->id],
                                [
                                    'escape' => false,
                                    'class' => 'btn btn-default btn-xs',
                                    'title' => 'Editar'
                                ])
                        ?>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($customers) == 0): ?>
            <tr>
                <td colspan="6">Nenhum cliente cadastrado ainda.</td>
            </tr>
        <?php endif ?>
=======
<?= $this->Html->link('Adicionar Aluno', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('Nome') ?></th>
            <th><?= $this->Paginator->sort('Nº de Registro') ?></th>
            <th><?= $this->Paginator->sort('Chave de Acesso') ?></th>
            <th><?= $this->Paginator->sort('status','Status') ?></th>            
            <th class="actions"><?= __('Ações') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($customers as $customer): ?>
        <tr>
            <td><?= h($customer->name) ?></td>
            <td><?= h($customer->registration) ?></td>
            <td><?= h($customer->access_key) ?></td>
            <td><?= $customer->status ? '<span class="label label-success">Ativo</span>': '<span class="label label-danger">Inativo</span>' ?></td>
            <td class="actions">
                <?= $this->Html->link(__('Ver'), ['action' => 'view', $customer->id]) ?>
                <?= $this->Html->link(__('Editar'), ['action' => 'edit', $customer->id]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
>>>>>>> 0a64914aee841e1ebe137e26f52d47c52bfc84c8
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
