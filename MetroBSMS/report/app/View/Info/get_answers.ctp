
<?php if (count($infotypes)!=0): ?>
    <label for="InfoAnswersId2">Select Section</label>
    <select id="InfoAnswersId2" name="data[Info][InfoType_id]" required>
        <option value="">[Select]</option>
        <?php foreach ($infotypes as $item): ?>
             <option value="<?php echo $item['InfoType']['id']; ?>"><?php echo $item['InfoType']['description']; ?></option>
        <?php endforeach; ?>
    </select>

    <?php if($valueType["Info"]['domain_value_type_id']==0 ): ?>
        <label for="InfoAnswersId1">Select Value</label>
        <select id="InfoAnswersId" name="data[Info][Answers_id]" required>
          <option value="">[Select]</option>
          <?php foreach ($answers as $key => $value): ?>
              <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
          <?php endforeach; ?>
        </select>

    <?php elseif($valueType["Info"]['domain_value_type_id']==1 ):?>
            <?php echo $this->Form->input('Answers_id', array(
                'multiple' => 'multiple',
                'type' => 'select',
                'label'=>'Select Answer(s)'
            ));
            ?>

            <input type="radio" value="0" name="data[Info][AnyAll]" checked>Any<br /><br>
            <input type="radio" value="1" name="data[Info][AnyAll]">All
        
    <?php elseif($valueType["Info"]['domain_value_type_id']==2 ):?>
        <label for="OperatorId">Select Operator</label>
        <select id="OperatorId" name="data[Info][Operator]" required>
            <option value="">[Select]</option>
            <option value="0"> > </option>
            <option value="1"> => </option>
            <option value="2"> = </option>
            <option value="3"> < </option>
            <option value="4"> >= </option>
        </select>
        <input type="text" name="data[Info][Answer]" required pattern="^[0-9]?[0-9]+'([0-9]|1[01])(&quot;|'')$">
      <?php elseif($valueType["Info"]['domain_value_type_id']==3 ):?>
         <label for="OperatorId">Select Operator</label>
         <select id="OperatorId" name="data[Info][Operator]" required>
            <option value="">[Select]</option>
            <option value="0"> > </option>
            <option value="1"> => </option>
            <option value="2"> = </option>
            <option value="3"> < </option>
            <option value="4"> >= </option>
         </select>
        <input type="range" name="data[Info][Answer]" required min="0" max="100" oninput = "this.form.amountInput.value=this.value">
         <output name = "amountInput" ></output>
    <?php endif;?>
    <input type="hidden" value="<?php echo $valueType['Info']['domain_value_type_id'] ?>" name="data[Info][AnswType]">
<?php  else : ?>
<p>No asnwers on that question</p>
<?php endif; ?>