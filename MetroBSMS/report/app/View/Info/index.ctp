
 <?php 
    echo $this->Form->create(NULL, array(
    'url' => array(
        'controller' => 'Info', 'action' => 'createReport')
     ));
	echo $this->Form->input('Info_id',
        array(
            'label' => 'Select Field','empty'=>'[Select]')
     );
?>
<div id="block"></div>
<?php
$this->Js->get('#InfoInfoId')->event('change', 
	$this->Js->request(array(
		'controller'=>'Info',
		'action'=>'getAnswers'
		), array(
		'update'=>'#block',
		'async' => true,
		'method' => 'post',
		'dataExpression'=>true,
		'data'=> $this->Js->serializeForm(array(
			'isForm' => true,
			'inline' => true
			))
		))
	);
?>
<?php echo $this->Form->end("Create"); ?>
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

