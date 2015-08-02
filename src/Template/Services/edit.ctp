<?= $this->assign('title', ' - Editar Aula') ?>

<?= $this->Html->script('../lib/niceCharCounter/dist/jquery.niceCharCounter', ['inline' => false]) ?>

<?php
	$this->Html->scriptStart(['block' => true]);
		echo "$(function(){
			$('#description').niceCharCounter({
				max: 800,
				warningPercent: 10,
				warningColor: '#e67e22',
				text: '{{residual}} caractere(s) restante(s).',
				containerText: '#container-counter',
			});
		});";
	$this->Html->scriptEnd();
?>
<?php 
	$this->Html->addCrumb('Aulas', ['action' => 'index']);
	$this->Html->addCrumb('Editar Aula');
	echo $this->Html->getCrumbList();
?>
<br>

<?php
	echo $this->Form->create($service, ['novalidate' => true, 'horizontal' => true]);
			echo $this->Form->input('name', ['label' => 'Nome']);
		echo $this->Form->input('description', [
			'label' => 'Descrição',
			'type' => 'textarea'
		]);
		echo '<p id="container-counter" class="help-block"></p>';
		echo $this->Form->input('duration', [
			'label' => 'Duração',
			'help' => 'Duração da aula em minutos'
		]);
		echo '<hr>';
		echo $this->Form->input('is_active', ['label' => 'Ativo']);
		echo $this->Form->submit('Salvar Alterações', [
			'escape' => false,
			'bootstrap-type' => 'primary',
			'class' => 'pull-right'
		]);
	echo $this->Form->end();
?>	