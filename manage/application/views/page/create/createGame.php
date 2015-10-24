<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/createGame/' . $cupId); ?>


    <label for="date">日期</label>
    <input type="date" name="date" /><br />

    <label for="vs">對手</label>
    <input type="input" name="vs" /><br />

    <label for="our_point">我們的分數</label>
    <input type="input" name="our_point" /><br />

    <label for="enemy_point">對手的分數</label>
    <input type="input" name="enemy_point" /><br />

    <input type="submit" name="submit" value="Create" />

</form>
</div>