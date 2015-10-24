<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changePlayer/' . $playerData['id']); ?>

    <label for="title">Name</label>
    <input type="input" name="name" value="<?php echo $playerData['name'] ?>" /><br />

    <label for="number">背號</label>
    <input type="input" name="number" value="<?php echo $playerData['number'] ?>" /><br />

    <label for="grade">年級</label>
    <input type="input" name="grade" value="<?php echo $playerData['grade'] ?>" /><br />

    <input type="submit" name="submit" value="change" />

</form>
</div>