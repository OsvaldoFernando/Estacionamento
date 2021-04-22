<div class="main-wrapper main-wrapper-1">

	<!--NAVBAR-->
	<?php $this->load->view('layout/navbar'); ?>

	<!--SIDEBAR-->
	<?php $this->load->view('layout/sidebar'); ?>

	<!-- Main Content -->
	<div class="main-content">
		<section class="section">
			<div class="section-body">

				<!-- DataTable -->
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">

								<ol class="breadcrumb">

									<!--Trazer a página do Home-->
									<li class="breadcrumb-item">
										<a data-toggle="tooltip" title="Home" href="<?php echo base_url('/'); ?>">
											<i class="fas fa-home"></i>
										</a>
									</li>

									<!--Trazer a página anterior-->
									<li class="breadcrumb-item">
										<a data-toggle="tooltip"
										   title="Listar <?php echo $this->router->fetch_class(); ?>"
										   href="<?php echo base_url($this->router->fetch_class()); ?>">Listar
											&nbsp;<?php echo $this->router->fetch_class(); ?></a>
									</li>

									<!--Trazer a página corrente-->
									<li data-toggle="tooltip" class="breadcrumb-item active" aria-current="page">
										<?php echo $titulo; ?>
									</li>

								</ol>
							</div>

							<div class="card-body">
								<!--Título-->
								<h2> <?php echo $titulo; ?></h2><br>

								<!--Data última alteração-->
								<?php echo(isset($forma) ? '<i class="fas fa-calendar &nbsp; "></i>&nbsp; Data da última alteração:&nbsp; ' . formata_data_banco_com_hora($forma->forma_pagamento_data_alteracao) : ''); ?>

								<!-- Formulário									-->
								<form name="form_core" method="post"><br>

									<div class="form-group row">

										<div class=" col-md-8 mb-20">
											<label>Nome da forma de pagamento</label>
											<input type="text" class="form-control" name="forma_pagamento_nome"
												   value="<?php echo(isset($forma) ? $forma->forma_pagamento_nome : set_value('forma_pagamento_nome')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('forma_pagamento_nome', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class=" col-md-4 mb-20">
											<label>Ativa</label>
											<select class="form-control" name="forma_pagamento_ativa">

												<?php if (isset($forma)): ?>

													<option value="0" <?php echo($forma->forma_pagamento_ativa == 0 ? 'selected' : '') ?> >
														Não
													</option>
													<option value="1" <?php echo($forma->forma_pagamento_ativa == 1 ? 'selected' : '') ?> >
														Sim
													</option>

												<?php else: ?>

													<option value="0">Não</option>
													<option value="1">Sim</option>

												<?php endif; ?>

											</select>


										</div>

									</div>

									<?php if (isset($forma)): ?>

										<div class="form-group row">

											<div class=" col-md-12">
												<input type="hidden" class="form-control" name="forma_pagamento_id"
													   value="<?php echo $forma->forma_pagamento_id; ?>">
											</div>

										</div>

									<?php endif; ?>

									<div class="card-footer text-right">

										<button class="btn btn-primary">Enviar</button>
										<a class="btn btn-info"
										   href="<?php echo base_url($this->router->fetch_class()); ?>">Voltar</a>

									</div>

								</form>

								<div class="table-responsive">

								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</section>

		<!--			SIDEBAR CONFIGURAÇOES-->
		<?php $this->load->view('layout/sidebar_configuracoes'); ?>

	</div>
