<?php
	/**
	 * Вычислить смещение
	 *
	 * @param int $page Номер страницы
	 * @param int $count Количество записей на одну страницу
	 *
	 * @return int Смещение
	 */
	function compute_offset(int $page, int $count) : int {
		return ($page != 0) ? (($page - 1) * $count) : 0;
	}
?>