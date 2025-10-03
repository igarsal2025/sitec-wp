<?php /* Template Name: Contacto */ ?>
<?php get_header(); ?>
<main id="page-contact" class="py-16 md:py-20">
	<div class="mx-auto max-w-3xl px-4">
		<header class="mb-8">
			<h1 class="text-3xl md:text-4xl font-bold leading-tight">Conéctese con Nuestros Expertos: Su Proyecto Comienza Aquí</h1>
			<p class="mt-2 text-slate-600">Respuesta garantizada en menos de 2 horas hábiles. Consultoría inicial sin costo.</p>
		</header>
		<form class="grid grid-cols-1 gap-4" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" enctype="multipart/form-data">
			<?php wp_nonce_field('sitec_contact','sitec_contact_nonce'); ?>
			<input type="hidden" name="action" value="sitec_contact_submit">
			<?php $rc_site = trim((string) get_option('recaptcha_site_key')); if ($rc_site): ?>
			<input type="hidden" name="g-recaptcha-response" id="g-recaptcha-response">
			<script src="https://www.google.com/recaptcha/api.js?render=<?php echo esc_attr($rc_site); ?>"></script>
			<script>grecaptcha.ready(function(){grecaptcha.execute('<?php echo esc_js($rc_site); ?>',{action:'contact'}).then(function(token){var el=document.getElementById('g-recaptcha-response'); if(el){ el.value=token; }});});</script>
			<?php endif; ?>
			<label class="block">
				<span class="text-sm">Nombre Completo*</span>
				<input class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" type="text" name="name" placeholder="Ej. Juan Pérez González" required>
			</label>
			<label class="block">
				<span class="text-sm">Email Corporativo*</span>
				<input class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" type="email" name="email" placeholder="juan.perez@empresa.com" required>
			</label>
			<label class="block">
				<span class="text-sm">Teléfono con WhatsApp*</span>
				<input class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" type="tel" name="phone" placeholder="+52 747 123 4567" required>
				<small class="text-slate-500">Incluya código de área</small>
			</label>
			<label class="block">
				<span class="text-sm">Empresa/Organización</span>
				<input class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" type="text" name="company" placeholder="Nombre de su empresa">
			</label>
			<label class="block">
				<span class="text-sm">Sector/Industria*</span>
				<select class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" name="sector" required>
					<option value="">Seleccione...</option>
					<option>Gobierno Federal</option>
					<option>Gobierno Estatal</option>
					<option>Gobierno Municipal</option>
					<option>Educación</option>
					<option>Salud</option>
					<option>Industrial/Manufactura</option>
					<option>Retail/Comercial</option>
					<option>Hotelería/Turismo</option>
					<option>Banca/Financiero</option>
					<option>Otro</option>
				</select>
			</label>
			<label class="block">
				<span class="text-sm">Servicio de Interés*</span>
				<div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
					<?php $services = ['Videovigilancia y Seguridad','Control de Acceso','Telecomunicaciones y Redes','Cableado Estructurado','Radiocomunicación','Electrificación','Energía Solar','Data Center','Consultoría','Mantenimiento','Otro']; foreach($services as $srv): ?>
					<label class="flex items-center gap-2"><input type="checkbox" name="interest[]" value="<?php echo esc_attr($srv); ?>" /> <span><?php echo esc_html($srv); ?></span></label>
					<?php endforeach; ?>
				</div>
			</label>
			<label class="block">
				<span class="text-sm">Servicio</span>
				<input class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" type="text" name="service">
			</label>
			<label class="block">
				<span class="text-sm">Presupuesto Estimado</span>
				<select class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" name="budget">
					<option>Menos de $100,000 MXN</option>
					<option>$100,000 - $500,000 MXN</option>
					<option>$500,000 - $1,000,000 MXN</option>
					<option>$1,000,000 - $5,000,000 MXN</option>
					<option>Más de $5,000,000 MXN</option>
					<option>Por definir</option>
				</select>
			</label>
			<label class="block">
				<span class="text-sm">Urgencia del Proyecto*</span>
				<div class="mt-2 grid grid-cols-1 sm:grid-cols-2 gap-2">
					<?php $urgs=['Urgente (1-2 semanas)','Corto plazo (1 mes)','Mediano plazo (2-3 meses)','Largo plazo (3+ meses)','Solo requiero información']; foreach($urgs as $u): ?>
					<label class="flex items-center gap-2"><input type="radio" name="urgency" value="<?php echo esc_attr($u); ?>" required /> <span><?php echo esc_html($u); ?></span></label>
					<?php endforeach; ?>
				</div>
			</label>
			<label class="block">
				<span class="text-sm">Adjunto</span>
				<input class="mt-1 w-full" type="file" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg">
			</label>
			<label class="block">
				<span class="text-sm">Mensaje/Descripción del Proyecto*</span>
				<textarea class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" name="message" rows="6" maxlength="500" placeholder="Describa brevemente su proyecto, ubicación y requerimientos específicos..." required></textarea>
			</label>
			<label class="block">
				<span class="text-sm">Adjuntar Archivo</span>
				<input class="mt-1 w-full" type="file" name="attachment" accept=".pdf,.doc,.docx,.xls,.xlsx,.png,.jpg,.jpeg,.dwg,.zip">
				<small class="text-slate-500">Formatos: PDF, DOC, DOCX, DWG, ZIP (max 25MB)</small>
			</label>
			<label class="block">
				<span class="text-sm">¿Cómo nos conoció?</span>
				<select class="mt-1 w-full rounded-md border border-slate-300 px-3 py-2" name="source">
					<option>Búsqueda en Google</option>
					<option>Recomendación</option>
					<option>Redes sociales</option>
					<option>Evento/Feria</option>
					<option>Cliente anterior</option>
					<option>Otro</option>
				</select>
			</label>
			<label class="block">
				<span class="text-sm">Política de Privacidad*</span>
				<label class="mt-2 flex items-center gap-2"><input type="checkbox" name="privacy" value="1" required> <span>He leído y acepto la política de privacidad</span></label>
			</label>
			<button class="mt-2 inline-flex items-center justify-center rounded-md bg-emerald-500 px-5 py-3 font-medium text-white hover:bg-emerald-600" type="submit">Enviar</button>
		</form>
	</div>
</main>
<?php get_footer(); ?>


