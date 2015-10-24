<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/createVideo'); ?>

    <label for="title">Title</label>
    <input type="input" name="title" /><br />

    <label for="Youtube id">Youtube Link</label>
    <input type="input" name="link" /><br />

    <input type="submit" name="submit" value="Create" />

</form>
</div>