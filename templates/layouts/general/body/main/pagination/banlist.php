<?php
	if (!is_null($data['bans'])) {
		foreach($data['bans'] as $ban) {
?>
			<tr>
				<td><img src="/application/components/skin.php?user=<?= $ban['banned_user'] ?>&mode=3&size=24" alt="Голова"><?= $ban['banned_user'] ?></td>
				<td aria-label="Заблокировал"><img src="/application/components/skin.php?user=<?= $ban['admin'] ?>&mode=3&size=24" alt="Голова"><?= $ban['admin'] ?></td>
				<td aria-label="Начало"><?= $ban['start'] ?></td>
				<td aria-label="Окончание"><?= $ban['end'] ?></td>
				<td aria-label="Причина"><?= $ban['reason'] ?></td>
			</tr>
<?php
		}
	} else {
?>
		<p class="error">Банов нет</p>
<?php
	}
?>