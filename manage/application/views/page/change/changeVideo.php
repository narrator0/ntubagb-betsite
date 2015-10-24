<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changeVideo/' . $videoData['id']); ?>

    <label for="title">Title</label>
    <input type="input" name="title" value="<?php echo $videoData['title'] ?>" /><br />

    <label for="Youtube id">Youtube Link</label>
    <input type="input" name="link" value="<?php echo $videoData['link'] ?>" /><br />

    <input type="submit" name="submit" value="Change" />

</form>
</div>