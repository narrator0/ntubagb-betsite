<?php echo validation_errors(); ?>

<?php echo form_open('manage/uploadVideo'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="Youtube id">Youtube ID</label>
    <input type="input" name="link" /><br />

    <input type="submit" name="submit" value="Video Upload" />

</form>