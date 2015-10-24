<?php echo validation_errors(); ?>

<?php echo form_open('manage/deletePicture'); ?>

<label for="name">Picture Name</label><br>
<input type="text" name="name">

<input type="submit" value="Picture Delete">

</form>