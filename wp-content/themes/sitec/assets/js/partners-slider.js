(function(){
	function initSlider(root){
		if (!root) return;
		var track = root.querySelector('.sitec-partners-track');
		var prev = root.querySelector('.sitec-partners-prev');
		var next = root.querySelector('.sitec-partners-next');
		if (!track) return;

		var autoplay = root.getAttribute('data-autoplay') === 'true';
		var intervalMs = parseInt(root.getAttribute('data-interval') || '3000', 10);
		var timer = null;

		function getSlideWidth(){
			var slide = track.querySelector('.sitec-partners-slide');
			if (!slide) return 0;
			return slide.getBoundingClientRect().width + 24; // gap-6 ~= 24px
		}

		function scrollBySlides(dir){
			track.scrollBy({ left: dir * getSlideWidth(), behavior: 'smooth' });
		}

		function startAutoplay(){
			if (!autoplay) return;
			stopAutoplay();
			timer = setInterval(function(){ scrollBySlides(1); }, Math.max(1500, intervalMs));
		}
		function stopAutoplay(){ if (timer) { clearInterval(timer); timer = null; } }

		if (prev) prev.addEventListener('click', function(){ scrollBySlides(-1); });
		if (next) next.addEventListener('click', function(){ scrollBySlides(1); });

		// Pausa en hover para mejor UX
		root.addEventListener('mouseenter', stopAutoplay);
		root.addEventListener('mouseleave', startAutoplay);

		// Accesibilidad: flechas del teclado cuando el track tiene foco
		track.addEventListener('keydown', function(e){
			if (e.key === 'ArrowRight') { e.preventDefault(); scrollBySlides(1); }
			if (e.key === 'ArrowLeft') { e.preventDefault(); scrollBySlides(-1); }
		});

		startAutoplay();
	}

	document.addEventListener('DOMContentLoaded', function(){
		var sliders = document.querySelectorAll('.sitec-partners-slider');
		sliders.forEach(initSlider);
	});
})();


