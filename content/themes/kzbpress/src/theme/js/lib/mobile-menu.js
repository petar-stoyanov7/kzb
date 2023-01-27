const init = () => {
	const menuToggle = document.getElementById('mobile-activator');
	const menuContainer = document.getElementById('menu-container');
	if (!menuToggle || !menuContainer) {
		return;
	}

	menuToggle.addEventListener('click', (e) => {
		e.preventDefault();
		menuContainer.style.display = menuContainer.style.display === 'block' ? 'none' : 'block';
	});
}

window.addEventListener('load', init);
