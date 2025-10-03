<footer class="mt-20 border-t border-slate-200">
	<div class="mx-auto max-w-7xl px-4 py-10">
		<div class="grid grid-cols-1 md:grid-cols-3 gap-8">
			<div>
				<p class="font-semibold"><?php bloginfo('name'); ?></p>
				<p class="text-slate-600 mt-2">Ingeniería, seguridad y telecomunicaciones con resultados comprobados.</p>
			</div>
			<div><?php wp_nav_menu(['theme_location'=>'footer','container'=>false,'menu_class'=>'space-y-2']); ?></div>
			<div class="md:text-right">
				<p class="text-slate-600">&copy; <?php echo date('Y'); ?> SITEC</p>
			</div>
		</div>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>


