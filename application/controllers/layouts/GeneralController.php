<?php
	namespace controllers\layouts;

	use components\Logger;
	use models\article\Model as ArticleModel;
	use models\pernamentbanlist\Model as PernamentBanlistModel;
	use models\tempbanlist\Model as TempBanlistModel;
	use factories\Pagination as PaginationFactory;
	use factories\LayoutData as LayoutDataFactory;
	use components\view\General as View;
	use components\Router;
	use components\exceptions\template\PageNotFound as PageNotFoundException;

	/**
	 * Класс контроллера, описывающий загрузку страниц сайта для шаблона General
	 *
	 * @version 1.0 Alpha
	 */
	class GeneralController {
		/**
		 * Загрузить страницу без дополнительных данных
		 *
		 * @access public
		 *
		 * @param string $pageName Имя страницы
		 */
		public function actionBasic(string $pageName) {
			$data['basic'] = LayoutDataFactory::getForGeneral();
				
			$View = new View($pageName);
			$View->generate($data);
		}

		/**
		 * Загрузить главную страницу со статьями
		 *
		 * @access public
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество записей на странице
		 */
		public function actionIndex(int $page = 1, int $limitCount = ArticleModel::SHOW_BY_DEFAULT) {
			$Pagination = PaginationFactory::getByArticles($page, $limitCount);
			$page = $Pagination->getCurrentPage();

			$data['basic'] = LayoutDataFactory::getForGeneral();
			$data['articles'] = ArticleModel::getArticlesByPage($page, $limitCount);

			$View = new View('index');
			$View->generate($data, $Pagination);
		}

		/**
		 * Загрузить страницу с пернаментными банами
		 *
		 * @access public
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество записей на странице
		 */
		public function actionPernamentBans(int $page = 1, int $limitCount = PernamentBanlistModel::SHOW_BY_DEFAULT) {
			$Pagination = PaginationFactory::getByPernamentBans($page, $limitCount);
			$page = $Pagination->getCurrentPage();

			$data['basic'] = LayoutDataFactory::getForGeneral();
			$data['bans'] = PernamentBanlistModel::getBansByPage($page, $limitCount);

			$View = new View('banlist/pernaments');
			$View->generate($data, $Pagination);
		}

		/**
		 * Загрузить страницу с временными банами
		 *
		 * @access public
		 *
		 * @param int $page Номер страницы
		 * @param int $limitCount Количество записей на странице
		 */
		public function actionTempBans(int $page = 1, int $limitCount = TempBanlistModel::SHOW_BY_DEFAULT) {
			$Pagination = PaginationFactory::getByTempBans($page, $limitCount);
			$page = $Pagination->getCurrentPage();

			$data['basic'] = LayoutDataFactory::getForGeneral();
			$data['bans'] = TempBanlistModel::getBansByPage($page, $limitCount);

			$View = new View('banlist');
			$View->generate($data, $Pagination);
		}
	}
?>