<?php
/**
 * Consent Manager simple (opt-in) para analytics/ads/chat.
 * Muestra un banner básico y guarda preferencia en localStorage + cookie.
 */

add_action('wp_footer', function(){
	?>
	<div id="sitec-consent" class="fixed inset-x-0 bottom-0 z-50 hidden">
		<div class="mx-auto max-w-7xl px-4 py-4">
			<div class="rounded-lg bg-white shadow-lg border border-slate-200 p-4 md:flex md:items-center md:justify-between">
				<p class="text-slate-700 mb-3 md:mb-0">Este sitio usa cookies para analítica y mejorar la experiencia. ¿Aceptas?</p>
				<div class="flex gap-2">
					<button id="sitec-consent-accept" class="rounded-md bg-emerald-500 px-4 py-2 text-white">Aceptar</button>
					<button id="sitec-consent-deny" class="rounded-md border border-slate-300 px-4 py-2">Rechazar</button>
				</div>
			</div>
		</div>
	</div>
	<script>
	(function(){
		var k='sitec_consent';
		function setConsent(val){
			try{localStorage.setItem(k,val);}catch(e){}
			document.cookie = k+'='+val+';path=/;max-age='+(60*60*24*180);
		}
		function getConsent(){
			try{var v=localStorage.getItem(k); if(v) return v;}catch(e){}
			var m=document.cookie.match(new RegExp('(?:^|; )'+k+'=([^;]*)'));
			return m?m[1]:'';
		}
		function show(){ document.getElementById('sitec-consent').classList.remove('hidden'); }
		function hide(){ document.getElementById('sitec-consent').classList.add('hidden'); }
		var current=getConsent();
		if(!current){ show(); }
		document.getElementById('sitec-consent-accept').addEventListener('click', function(){ setConsent('granted'); hide(); document.dispatchEvent(new Event('sitec:consent-granted')); });
		document.getElementById('sitec-consent-deny').addEventListener('click', function(){ setConsent('denied'); hide(); document.dispatchEvent(new Event('sitec:consent-denied')); });
		// Exponer utilidad global
		window.sitecConsent = { get:getConsent };
	})();
	</script>
	<?php
});


