<?= $this->assign('title', ' - Comunicados') ?>

<script>
    $(function(){
        $('button#btn-send-push').click(function(){
            var $this = $(this);
            var url = $this.data('url');
            var releaseId = $this.data('release-id');
            var $loader = $('#push-loader-' + releaseId);

            alert('Dependendo da quantidade de alunos cadastrados o envio das notificações pode demorar, não saia da página enquanto o envio não for concluído');

            $loader.fadeIn('fast');
            $.post(url, {id: releaseId}, function(result){
                location.reload();
            })
            .fail(function(){
                alert('As notificações não foram enviadas, favor tentar novamente.');
                $loader.fadeOut('fast');
            })
            .always(function(){
                // $loader.fadeOut('fast');
            });
        });
    });
</script>

<?php 
    $this->Html->addCrumb('Comunicados');
    echo $this->Html->getCrumbList();
?>

<div class="row row-add-button">
    <div class="col-md-12">
        <?= $this->Html->link('Criar Comunicado', [
            'action' => 'add'
        ], [
            'class' => 'btn btn-danger pull-right',
            'escape' => false
        ])?>  
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <form method="GET" class="form-inline">
            <div class="form-group">
                <input
                    class="form-control"
                    id="q"
                    name="q"
                    placeholder="Pesquisar pelo texto..."
                    type="text"
                    value="<?= $this->request->query('q')?>">
            </div>
            <div class="form-group">
                <label class="sr-" for="from">De</label>
                <input
                    class="form-control"
                    id="from"
                    name="from"
                    placeholder="De"
                    type="date"
                    value="<?= $this->request->query('from') ?>">
            </div>
            <div class="form-group">
                <label class="sr-" for="to">Até</label>
                <input
                    class="form-control" 
                    id="to"
                    name="to"
                    type="date"
                    value="<?= $this->request->query('to') ?>">
            </div>     
            <div class="form-group">
                <button type="submit" class="btn btn-default" type="button" title="Pesquisar">
                    <span class="glyphicon glyphicon-search"></span>
                </button>
            </div>
        </form>
    </div>
</div>
<hr>

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $tab == '1' ? 'active' : '' ?>">
        <?= $this->Html->link('Publicados', [ 'action' => 'index', '?' => ['tab' => '1']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '4' ? 'active' : '' ?>">
        <?= $this->Html->link('Destaques', [ 'action' => 'index', '?' => ['tab' => '4']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '2' ? 'active' : '' ?>">
        <?= $this->Html->link('Não publicados', [ 'action' => 'index', '?' => ['tab' => '2']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '3' ? 'active' : '' ?>">
        <?= $this->Html->link('Todos', ['action' => 'index','?' => ['tab' => '3']]) ?>
    </li>
</ul>

<br>
<div class="table-responsive">
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>Comunicado</th>
                <th style="width: 260px;" class="text-center">
                    Destaque
                </th>
                <th class="text-center">
                    Notificação Push
                </th>
                <th style="width: 80px;">
                    
                </th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($releases) > 0): ?>
                <?php foreach ($releases as $release): ?>
                    <tr>
                        <td>
                            <h4>
                                <?= h($release->title) ?>
                            </h4>
                            <em class="text-muted">
                                <?= $this->Time->timeAgoInWords(
                                    $release->created,
                                    [
                                        'format' => 'dd MMM',
                                        'end' => '+1 week'
                                    ]
                                ) ?>
                            </em>
                            <?= $this->TextBootstrap->labelBoolean($release->is_active,
                                'Publicado',
                                'Não Publicado'
                            ) ?>
                            <br>
                            <br>
                            <p class="text-align: justify; text-justify: inter-word;">
                                <?= h($release->text) ?>
                            </p>
                        </td>
                        <td class="text-center" style="vertical-align: middle">
                            <?php if ($release->destaque): ?>
                                <?php
                                    $dtInicioDestaque = ($release->dt_inicio_destaque) ? $release->dt_inicio_destaque->format('d/m H:i') : 'agora';
                                    $dtFimDestaque = ($release->dt_fim_destaque) ? $release->dt_fim_destaque->format('d/m H:i') : 'sempre';
                                ?>
                                De <span class="label label-danger"><?= $dtInicioDestaque ?></span> até <span class="label label-danger"><?= $dtFimDestaque ?></span>
                            <?php else: ?>
                                -
                            <?php endif ?>
                        </td>
                        <td class="text-center">
                            <?php if (!$release->dt_push): ?>
                                <em>Ainda não enviado.</em>
                            <?php else: ?>  
                                <span class="label label-success">Enviado <?= $release->dt_push->timeAgoInWords() ?></span>
                            <?php endif ?>
                            <div style="margin-top: 10px;">
                                <button
                                    <?= (!$release->is_active) ? 'disabled' : '' ?>
                                    type="button"
                                    id="btn-send-push"
                                    class="btn btn-default btn-xs"
                                    data-release-id="<?= $release->id ?>"
                                    data-url="<?= $this->Url->build(['controller' => 'PushNotification', 'action' => 'releases', '_ext' => 'json']); ?>">
                                    Enviar
                                </button>
                            </div>

                            <div
                                class="progress"
                                style="margin-top: 10px; display: none;"
                                id="push-loader-<?= $release->id?>">
                                <div
                                    class="progress-bar progress-bar-striped active"
                                    role="progressbar"
                                    style="width: 100%">
                                </div>
                            </div>

                        </td>
                        <td class="text-center" style="vertical-align: middle;">
                            <?php if ($me_id == $release->user_id): ?>
                                <?= $this->Html->link(
                                    '<span class="glyphicon glyphicon-pencil"></span>',
                                    ['action' => 'edit', $release->id], [
                                        'escape' => false,
                                        'class' => 'btn btn-default btn-xs',
                                        'title' => 'Editar'
                                    ])
                                ?>
                                <?= $this->Form->postLink(
                                    '<span class="glyphicon glyphicon-remove"></span>',
                                    ['action' => 'delete', $release->id], [
                                        'escape' => false,
                                        'confirm'=> 'Você realmente deseja deletar este comunicado? Esta operação não poderá ser desfeita.',
                                        'class' => 'btn btn-default btn-xs',
                                        'title' => 'Deletar'
                                    ])
                                ?>
                            <?php endif ?>
                        </td>
                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10"><em>Nenhum comunicado para exibir.</em></td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?= $this->element('Common/paginator') ?>

</div>
