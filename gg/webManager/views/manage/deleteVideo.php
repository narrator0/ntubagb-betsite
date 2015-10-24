<?php echo validation_errors(); ?>

<?php echo form_open('manage/deleteVideo'); ?>

<label for="link">Video Youtube ID</label><br>
<input type="text" name="id">

<input type="submit" value="Video Delete">

</form>