<div class="container">

<?php echo validation_errors(); ?>

<?php echo form_open('manageController/changeStatistic/' . $data['cup_id'] . '/' . $data['game_id'] . '/' . $data['player_id'] . '/' . $data['id']); ?>
    
    <label for="2p-in">兩分進球</label>
    <input type="text" name="兩分進球" value="<?php echo $data['兩分進球'] ?>" /><br>

    <label for="2p-out">兩分失手</label>
    <input type="text" name="兩分失手" value="<?php echo $data['兩分失手'] ?>"  /><br>

    <label for="3p-in">三分進球</label>
    <input type="text" name="三分進球" value="<?php echo $data['三分進球'] ?>"  /><br>

    <label for="3p-out">三分失手</label>
    <input type="text" name="三分失手" value="<?php echo $data['三分失手'] ?>"  /><br>

    <label for="ft-in">罰球進球</label>
    <input type="text" name="罰球進球" value="<?php echo $data['罰球進球'] ?>"  /><br>

    <label for="ft-out">罰球失手</label>
    <input type="text" name="罰球失手" value="<?php echo $data['罰球失手'] ?>"  /><br>

    <label>防守籃板</label>
    <input type="text" name="防守籃板" value="<?php echo $data['防守籃板'] ?>"  /><br>

    <label>進攻籃板</label>
    <input type="text" name="進攻籃板" value="<?php echo $data['進攻籃板'] ?>"  /><br>

    <label>失誤</label>
    <input type="text" name="失誤" value="<?php echo $data['失誤'] ?>"  /><br>

    <label>助攻</label>
    <input type="text" name="助攻" value="<?php echo $data['助攻'] ?>"  /><br>

    <label>抄截</label>
    <input type="text" name="抄截" value="<?php echo $data['抄截'] ?>"  /><br>

    <label>阻攻</label>
    <input type="text" name="阻攻" value="<?php echo $data['阻攻'] ?>"  /><br>

    <label>犯規</label>
    <input type="text" name="犯規" value="<?php echo $data['犯規'] ?>"  /><br>

    <input type="submit" name="submit" value="Change" />

</form>

</div>
