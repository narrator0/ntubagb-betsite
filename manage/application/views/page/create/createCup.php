<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/createCup'); ?>

    <label for="name">name</label>
    <input type="input" name="name" /><br />

    <label for="year">西元年</label>
    <input type="year" name="year" /><br />

    <input type="submit" name="submit" value="Create" />

</form>
</div>
