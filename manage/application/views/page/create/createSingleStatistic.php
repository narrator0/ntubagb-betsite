<div class="container">
<?php echo validation_errors(); ?>

<?php echo form_open('manageController/createSingleStatistic/' . $gameId); ?>
	


    <label>請選擇選手</label>
    <select name="playerId">
    	<?php foreach ($playerData as $playerDataItem): ?>
    		<option value='<?php echo $playerDataItem['id']?>'><?php echo  $playerDataItem['name'] ?></option>
    	<?php endforeach; ?>
    </select>
    <br>
    

    <label for="2p-in">兩分進球</label>
    <input type="text" name="兩分進球" /><br>

    <label for="2p-out">兩分失手</label>
    <input type="text" name="兩分失手" /><br>

    <label for="3p-in">三分進球</label>
    <input type="text" name="三分進球" /><br>

    <label for="3p-out">三分失手</label>
    <input type="text" name="三分失手" /><br>

    <label for="ft-in">罰球進球</label>
    <input type="text" name="罰球進球" /><br>

    <label for="ft-out">罰球失手</label>
    <input type="text" name="罰球失手" /><br>

    <label>防守籃板</label>
    <input type="text" name="防守籃板" /><br>

    <label>進攻籃板</label>
    <input type="text" name="進攻籃板" /><br>

    <label>失誤</label>
    <input type="text" name="失誤" /><br>

    <label>助攻</label>
    <input type="text" name="助攻" /><br>

    <label>抄截</label>
    <input type="text" name="抄截" /><br>

    <label>阻攻</label>
    <input type="text" name="阻攻" /><br>

    <label>犯規</label>
    <input type="text" name="犯規" /><br>

    <input type="submit" name="submit" value="add data" />

</form>




</div>