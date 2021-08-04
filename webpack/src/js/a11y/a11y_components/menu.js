(function () {
	// Menu Desktop
	var submenus = document.querySelectorAll('.submenu-dropdown');
	submenus.forEach(function (submenu) {
		var submenuLinks = submenu.querySelectorAll('ul > li > a');
		submenuLinks.forEach(function (submenuLink) {
			submenuLink.addEventListener('focus', (e) => { submenu.classList.add('submenu-dropdown--active'); });
			submenuLink.addEventListener('blur', (e) => { submenu.classList.remove('submenu-dropdown--active'); });
		});
	});
})();
