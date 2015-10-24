<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changePicture/' . $pictureData['id']); ?>

    <label for="title">Title</label>
    <input type="input" name="name" value="<?php echo $pictureData['name'] ?>" /><br />

    <label for="size">How many pictures in this album?</label>
    <input type="input" name="size" value="<?php echo $pictureData['size'] ?>" /><br />

    <input type="submit" name="submit" value="Change" />

</form>
</div>