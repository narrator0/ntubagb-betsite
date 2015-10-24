<?php echo validation_errors(); ?>

<?php echo form_open('manage/uploadPicture'); ?>

    <label for="title">Title</label>
    <input type="input" name="name" /><br />

    <label for="size">How many pictures in this album?</label>
    <input type="input" name="size" /><br />

    <input type="submit" name="submit" value="Picture Upload" />

</form>