<?php if ($this->router->fetch_class() != 'login'): ?>
	<footer class="main-footer">

		<div class="footer-left"><a href="#">Custumizado por: Osvaldo QUETA</a></a></div>

		<div class="footer-right"></div>

	</footer>
<?php endif; ?>

<!-- General JS Scripts -->
<script src="<?php echo base_url('public/'); ?>assets/js/app.min.js"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?php echo base_url('public/'); ?>assets/js/scripts.js"></script>
<!-- Custom JS File -->
<script src="<?php echo base_url('public/'); ?>assets/js/custom.js"></script>
<script src="<?php echo base_url('public/'); ?>assets/bootbox/bootbox.min.js"></script>


<!--	Verificar se existe-->
<?php if (isset($scripts)): ?>

	<?php foreach ($scripts as $script): ?>
		<script src="<?php echo base_url('public/' . $script); ?>"></script>
	<?php endforeach; ?>

<?php endif; ?>

<script>

	//Chamando evento do Bootbox
	$('.delete').on("click", function (event) {

		event.preventDefault();

		//Chamando a url do botão confirma
		var redirect = $(this).attr('href');

		bootbox.confirm({
			title: $(this).attr('data-confirm'),
			//Centralizar o modal
			centerVertical: true,
			message: "<p class='text-danger'> Esta operação não poderá ser revertida</p>",
			buttons: {
				confirm: {
					label: 'Sim. pode excluír',
					className: 'btn-danger'
				},
				cancel: {
					label: 'Não, cancelar',
					className: 'btn-primary'
				}
			},
			callback: function (result) {

				if (result) {
					window.location.href = redirect;
				}

			}
		});

	});


</script>

</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>
