	<div class="main-wrapper main-wrapper-1">

<!--NAVBAR-->
		<?php $this->load->view('layout/navbar');?>

<!--SIDEBAR-->
		<?php $this->load->view('layout/sidebar');?>

		<!-- Main Content -->
		<div class="main-content">
			<section class="section">
				<div class="section-body">


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

				</div>
			</section>

<!--			SIDEBAR CONFIGURAÇOES-->
			<?php $this->load->view('layout/sidebar_configuracoes');?>

		</div>
