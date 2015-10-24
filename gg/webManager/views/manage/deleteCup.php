<?php echo validation_errors(); ?>

<?php echo form_open('manage/deleteCup'); ?>

    
    <!--drop-down list for cup-->
    <label for="cup">請選擇盃賽</label>
    <select name="cup" class="cupList">
    	<?php foreach ($cupData as $cupDataItem): ?>
    		<option value='<?php echo $cupDataItem['id']?>'><?php echo  $cupDataItem['name'] ?></option>
    	<?php endforeach; ?>
    </select>
    <br>

    <input type="submit" name="submit" value="delete cup" />

</form>