<?php echo validation_errors(); ?>

<?php echo form_open('manage/addPlayer'); ?>

    <label for="title">Name</label>
    <input type="input" name="name" /><br />

    <label for="number">背號</label>
    <input type="input" name="number" /><br />

    <label for="grade">年級</label>
    <input type="input" name="grade" /><br />

    <input type="submit" name="submit" value="add player" />

</form>