$(document).ready(function() {
	let isServerListOpening = false,
        isServerListClosing = false;

	//Выпадение подсписка серверов при наведении курсора мыши
    $("#navigation > ul").on("mouseenter.serversList", "li:has(#servers-ul-list-id)", () => {
        if (!isServerListOpening && !isServerListClosing) {
            isServerListOpening = true;

            $("#servers-ul-list-id").show("fade", {}, 450, () => {
                isServerListOpening = false;
            });
        }
    });

	//Скрытие подсписка серверов при отведении курсора мыши от этого подсписка
    $("#navigation > ul").on("mouseleave.serversList", "#servers-ul-list-id", function() {
        if (!isServerListOpening && !isServerListClosing) {
            isServerListClosing = true;

            $(this).hide("drop", {direction: "down"}, 450, () => {
                isServerListClosing = false;
            });
        }
    });
});