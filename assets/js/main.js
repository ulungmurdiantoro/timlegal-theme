document.addEventListener('DOMContentLoaded', function () {
	// popup
	var popup = document.getElementById('popup');
	if (popup) {
		var closePopup = function () {
			popup.classList.remove('show');
		};
		setTimeout(function () {
			popup.classList.add('show');
		}, 900);

		var closeBtn = document.getElementById('popup-close');
		var closeLater = document.getElementById('popup-close-later');
		var closeLink = popup.querySelector('.popup-close-link');
		if (closeBtn) closeBtn.addEventListener('click', closePopup);
		if (closeLater) closeLater.addEventListener('click', closePopup);
		if (closeLink) closeLink.addEventListener('click', closePopup);
	}

	// tabs
	var tabbar = document.getElementById('tabbar');
	if (tabbar) {
		tabbar.querySelectorAll('button').forEach(function (btn) {
			btn.addEventListener('click', function () {
				tabbar.querySelectorAll('button').forEach(function (b) {
					b.classList.remove('active');
				});
				btn.classList.add('active');
				var tab = btn.dataset.tab;
				var panelUmum = document.getElementById('panel-umum');
				var panelSigaret = document.getElementById('panel-sigaret');
				if (panelUmum) panelUmum.style.display = tab === 'umum' ? 'block' : 'none';
				if (panelSigaret) panelSigaret.style.display = tab === 'sigaret' ? 'block' : 'none';
			});
		});
	}
});
