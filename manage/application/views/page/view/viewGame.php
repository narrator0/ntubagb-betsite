<div class="container">
<h3 class="warning">Warning!! If you delete any game data it will also delete all related data!!</h3>
<table>
	<caption>
		<stronge><label class="data-title"><?php echo $title ?></label></stronge>
		<a href="/web/manage/index.php/manageController/create<?php echo ucfirst($dataName) ?>/<?php echo $cupId ?>" class="btn btn-success">
			<span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
		</a>
	</caption>
	<thead>
		<tr>	
			<th>id</th>
			<th>cup_id</th>
			<th>date</th>
			<th>vs</th>
			<th>our_point</th>
			<th>enemy_point</th>
			<th colspan="3">manage</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($data as $dataRow) : ?>
			<tr>
				<?php foreach ($dataRow as $value) : ?>
					<td><?php echo $value ?></td>
				<?php endforeach ; ?>
				<td>
					<a href="/web/manage/index.php/manageController/changeGame/<?php echo $dataRow['id'] ?>/<?php echo $dataRow['cup_id'] ?>">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<a class="delete-btn" href="/web/manage/index.php/manageController/deleteGame/<?php echo $dataRow['cup_id'] ?>/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
					</a>
				</td>
				<td>
					<a class="delete-btn" href="/web/manage/index.php/manageController/viewStatistic/<?php echo $dataRow['id'] ?>">
						<span class="glyphicon glyphicon-circle-arrow-right" aria-hidden="true"></span>
					</a>
				</td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

	

</div>