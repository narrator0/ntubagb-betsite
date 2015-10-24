<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changeCup/' . $cupData['id']); ?>

    <label for="name">name</label>
    <input type="input" name="name" value="<?php echo $cupData['name'] ?>" /><br />

    <label for="year">西元年</label>
    <input type="year" name="year" value="<?php echo $cupData['year'] ?>" /><br />

    <input type="submit" name="submit" value="Change" />

</form>
</div>
