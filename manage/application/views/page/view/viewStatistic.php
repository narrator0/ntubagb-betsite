<table>
	<caption>
		<stronge><label class="data-title"><?php echo $title ?></label></stronge>
		<a href="/web/manage/index.php/manageController/create<?php echo ucfirst($dataName) ?>" class="btn btn-success">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</a>
	</caption>
	<thead>
		<tr>
			<th>id</th>
			<th>cup_id</th>
			<th>game_id</th>
			<th>球員名稱</th>
			<th>兩分進球</th>
			<th>兩分失手</th>
			<th>三分進球</th>
			<th>三分失手</th>
			<th>罰球進球</th>
			<th>罰球失手</th>
			<th>防守籃板</th>
			<th>進攻籃板</th>
			<th>失誤</th>
			<th>助攻</th>
			<th>抄截</th>
			<th>阻攻</th>
			<th>犯規</th>
			<th>效率</th>
			<th colspan="2">manage</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $dataRow) : ?>
			<tr>
				<?php foreach ($dataRow as $value) : ?>
					<td><?php echo $value ?></td>
				<?php endforeach ; ?>
				<td>
					<a href="/web/manage/index.php/manageController/change<?php echo ucfirst($dataName) . '/' . $dataRow['cup_id'] . '/' . $dataRow['game_id'] . '/' . $dataRow['player_id'] . '/' . $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<a href="/web/manage/index.php/manageController/deleteStatistic/<?php echo $gameId ?>/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

