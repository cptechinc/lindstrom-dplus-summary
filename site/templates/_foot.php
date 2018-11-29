		<footer class="bg-lindstrom">
			<div class='container'>
				<strong class="text-white">Session ID: <?= session_id(); ?></strong>
			</div>
			<!-- /.container -->
		</footer>
		<?php include ('./_ajax-modal.php'); ?>
		<?php foreach($config->scripts->unique() as $script) : ?>
			<script src="<?= $script; ?>"></script>
		<?php endforeach; ?>
	</body>
</html>
