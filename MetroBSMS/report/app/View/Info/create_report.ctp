
<?php $stop=array(); $answ=array();?>
<table>
    <tr>
        <td>Bus Stop ID</td>
        <td>Answer</td>
    </tr>
    <?php if($reportList==NULL):?>
        <tr>
            <td>No Bus Stops</td>
        </tr>
    <?php elseif(count($reportList[0])<2):?> 
        <?php foreach($reportList as $key => $value): ?>
        <tr>
            <td>
                <?php echo $stop[]=$value;?>
            </td>
            <td><?php $answ[]="All Chosen";?>All Chosen</td>
        </tr>
        <?php endforeach;?>
    <?php elseif(count($reportList[0])==2):?>
         <?php foreach($reportList as $item): ?>
        <tr>
            <td>
                <?php echo $stop[]=$item['AssetData']['asset_id'];?>
            </td>
            <td>
                <?php echo $answ[]=$item['Value']['description'];?>
            </td>
        <?php endforeach;?>
     <?php elseif(count($reportList[0])==3):?>
            <?php foreach($reportList as $item): ?>
        <tr>
            <td>
                <?php echo $stop[]=$item['StopId'];?>
            </td>
            <td>
                <?php echo $answ[]=$item['Answer'];?>
            </td>
        <?php endforeach;?>
    <?php endif;?>
</table>

<?php 
    $stopData=base64_encode(serialize($stop));
    $answDta=base64_encode(serialize($answ));
 

    echo $this->Html->link("New Report", array(
                            'controller' => 'Info','action'=> 'index', ), 
                         array( 'class' => 'button'));

    echo $this->Form->create(null, array(
                        'url' => array(
                            'controller' => 'Info', 'action' => 'view_pdf', 'ext' => 'pdf'
                        )
 )); 
 
       
        
?>
      <input type="hidden" value=<?php echo $stopData; ?> name="data1">
      <input type="hidden" value=<?php echo $answDta; ?> name="data2">
<?php echo $this->Form->end(__('Export to PDF'), array('action' => 'view_pdf',  )); ?>

<?php 
    echo $this->Form->create(null, array(
                        'url' => array('controller' => 'Info', 'action' => 'createcsv','ext'=>'csv', 
                        )
    )); 
 
       
        
?> 
      <input type="hidden" value=<?php echo $stopData; ?> name="data1">
      <input type="hidden" value=<?php echo $answDta; ?> name="data2">
 <?php echo $this->Form->end(__('Export to CSV'), array('action' => 'createcsv',  )); ?>