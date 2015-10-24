<?php echo validation_errors(); ?>

<?php echo form_open('manage/fixVideo/1'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?php echo $videoData['title'] ?>" /><br />

    <label for="Youtube id">Youtube ID</label>
    <input type="input" name="link" value="<?php echo explode('/embed/', $videoData['link'])[1] ?>" /><br />

    <input type="submit" name="submit" value="change" />

</form>