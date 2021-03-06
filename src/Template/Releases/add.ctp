<?= $this->Html->script('../lib/nice-char-counter/dist/nice-char-counter', ['inline' => false]) ?>
<?= $this->Html->script('releases/form.js', ['inline' => false]) ?>

<?= $this->assign('title', ' - Criar Comunicado') ?>

<?php 
	$this->Html->addCrumb('Comunicados', ['action' => 'index']);
    $this->Html->addCrumb('Criar Comunicados');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($release, [
    'horizontal' => true,
    'novalidate' => true,
    'templates' => [
        'dateWidget' => '{{day}}{{month}}{{year}}{{hour}}{{minute}}'
    ]
]) ?>
<?php

?>
    <?= $this->Form->input('title', [
        'label' => 'Título'
    ]) ?>
    <?= $this->Form->input('text', [
        'label' => 'Texto',
        'type' => 'textarea',
        'rows' => 8,
        'maxlength' => false
    ]) ?>  
    <div class="row">
    	<div class="col-md-6 col-md-offset-2">
    		<p id="container-counter" class="help-block"></p>		
    	</div>
    </div>

    <hr>

    <?= $this->Form->input('destaque', ['label' => 'Destaque', 'type' => 'checkbox']) ?>
    <div id="container-destaque" style="display: none;">
        <div class="row">
            <div class="col-md-9 col-md-offset-2">
                <p class="help-block">
                    <?= $this->Html->icon('warning-sign') ?> Horários de início e término do destque não são obrigatórios, caso não sejam preenchidos o comunicado ficará como destaque até que a opção seja desmarcada.
                </p>       
            </div>
        </div>
        <?= $this->Form->input('dt_inicio_destaque', [
            'label' => 'Data de Início',
            'type' => 'date',
            'empty' => true
        ]) ?>
        
        <?= $this->Form->input('dt_inicio_destaque', [
            'label' => 'Horário de Início',
            'type' => 'time',
            'empty' => true
        ]) ?>
        <?= $this->Form->input('dt_fim_destaque', [
            'label' => 'Data do Fim',
            'type' => 'date',
            'empty' => true
        ]) ?>
        <?= $this->Form->input('dt_fim_destaque', [
            'label' => 'Horário do Fim',
            'type' => 'time',
            'empty' => true
        ]) ?>
    </div>

    <hr>
    <?= $this->Form->input('is_active', ['label' => 'Publicar']) ?>
    <hr>

	<?= $this->Form->submit('Criar Comunicado') ?>
<?= $this->Form->end() ?>