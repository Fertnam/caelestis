$(document).ready(function() {
	let isMobileMenuOpen = false,
		isMobileMenuOpening = false;

	//Событие при клике на кнопку
	$("#mobile-menu-button-id").on("click", () => {
		if (!isMobileMenuOpening) {
			isMobileMenuOpening = true;

			$("#mobile-menu-id").slideToggle(500, () => {
				isMobileMenuOpening = false;
			});
		}
	});
})