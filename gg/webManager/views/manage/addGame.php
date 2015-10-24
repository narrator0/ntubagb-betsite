<?php echo validation_errors(); ?>

<?php echo form_open('manage/addGame'); ?>

    <!--drop-down list for cup-->
    <label for="cup">請選擇盃賽</label>
    <select name="cup" class="cupList">
        <?php foreach ($cupData as $cupDataItem): ?>
            <option value='<?php echo $cupDataItem['id']?>'><?php echo  $cupDataItem['name'] ?></option>
        <?php endforeach; ?>
    </select>
    <br>

    <label for="date">日期</label>
    <input type="date" name="date" /><br />

    <label for="vs">對手</label>
    <input type="input" name="vs" /><br />

    <label for="our_point">我們的分數</label>
    <input type="input" name="our_point" /><br />

    <label for="enemy_point">對手的分數</label>
    <input type="input" name="enemy_point" /><br />

    <input type="submit" name="submit" value="add game" />

</form>