<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changeGame/' . $data['id'] . '/' . $data['cup_id']); ?>


    <label for="date">日期</label>
    <input type="date" name="date" value="<?php echo $data['date'] ?>" /><br />

    <label for="vs">對手</label>
    <input type="input" name="vs" value="<?php echo $data['vs'] ?>" /><br />

    <label for="our_point">我們的分數</label>
    <input type="input" name="our_point" value="<?php echo $data['our_point'] ?>" /><br />

    <label for="enemy_point">對手的分數</label>
    <input type="input" name="enemy_point" value="<?php echo $data['enemy_point'] ?>" /><br />

    <input type="submit" name="submit" value="Change" />

</form>
</div>