<section class="section">
	<div class="container mt-5">
		<div class="row">
			<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
				<div class="card card-primary">
					<div class="card-header">
						<h4> Bem-vindo ao SIGE Park Now</h4>
					</div>

					<!--Trazendo informação de sucesso e erro-->
					<?php if ($message = $this->session->flashdata('sucesso')): ?>

						<div class="row">

							<div class="col-md-12">

								<!-- Alerta -->
								<div class="alert alert-success alert-dismissible show fade">

									<div class="alert-body">
										<!-- Printar a mensagem -->
										<strong><i class="fas fa-smile"></i>&nbsp;<?php echo $message; ?>
										</strong>
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>
									</div>

								</div>

							</div>

						</div>

					<?php endif; ?>

					<!--Trazendo informação de erro-->

					<?php if ($message = $this->session->flashdata('error')): ?>

						<div class="row">

							<div class="col-md-12">

								<!-- Alerta -->
								<div class="alert alert-danger alert-dismissible show fade">

									<div class="alert-body">
										<!-- Printar a mensagem -->
										<strong>&nbsp;<?php echo $message; ?>
										</strong>
										<button class="close" data-dismiss="alert">
											<span>&times;</span>
										</button>
									</div>

								</div>

							</div>

						</div>

					<?php endif; ?>


					<div class="card-body">
						<form method="POST" action="<?php echo base_url('login/auth'); ?>" class="needs-validation"
							  novalidate="">

							<div class="form-group">
								<label>Email</label>
								<input type="email" class="form-control" name="email" required autofocus>
							</div>

							<div class="form-group">

								<label>Senha</label>
								<input type="password" class="form-control" name="password" required>
							</div>

							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
									Entrar
								</button>
							</div>
						</form>

					</div>
				</div>

			</div>
		</div>
	</div>
</section>

