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
										<a data-toggle="tooltip" data-placement="bottom" title="Home"
										   href="<?php echo base_url('/'); ?>">
											<i class="fas fa-home"></i>
										</a>
									</li>

									<!--Trazer a página corrente-->
									<li data-toggle="tooltip" data-placement="bottom" class="breadcrumb-item active"
										aria-current="page">
										<?php echo $titulo; ?>
									</li>

								</ol>
							</div>

							<div class="card-body">
								<!--Título-->
								<h2> <?php echo $titulo; ?></h2><br>


								<!--============================== Mensagem de sucesso ************************************************************ -->

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


								<!--Data última alteração-->
								<?php echo(isset($sistema) ? '<i class="fas fa-calendar &nbsp; "></i>&nbsp; Data da última alteração:&nbsp; ' . formata_data_banco_com_hora($sistema->sistema_data_alteracao) : ''); ?>

								<!-- Formulário									-->
								<form name="form_index" method="post"><br>

									<div class="form-group row">

										<div class=" col-md-6 mb-20">
											<label>Razão social</label>
											<input type="text" class="form-control" name="sistema_razao_social"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_razao_social : set_value('sistema_razao_social')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_razao_social', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class=" col-md-6 mb-20">
											<label>Nome fantasia</label>
											<input type="text" class="form-control" name="sistema_nome_fantasia"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_nome_fantasia : set_value('sistema_nome_fantasia')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_nome_fantasia', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>


									<div class="form-group row">

										<div class=" col-md-4 mb-20">
											<label>Telefone móvel</label>
											<input type="text" class="form-control" name="sistema_telefone_movel"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_telefone_movel : set_value('sistema_telefone_movel')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_telefone_movel', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class=" col-md-4 mb-20">
											<label>Sistema E-mail</label>
											<input type="text" class="form-control" name="sistema_email"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_email : set_value('sistema_email')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_email', '<div class="text-danger">', '</div>'); ?>
										</div>

										<div class=" col-md-4 mb-20">
											<label>Site url</label>
											<input type="text" class="form-control" name="sistema_site_url"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_site_url : set_value('sistema_site_url')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_site_url', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="form-group row">

										<div class=" col-md-4 mb-20">
											<label>Endereço Sistema</label>
											<input type="text" class="form-control" name="sistema_endereco"
												   value="<?php echo(isset($sistema) ? $sistema->sistema_endereco : set_value('sistema_endereco')); ?>">

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_endereco', '<div class="text-danger">', '</div>'); ?>

										</div>

										<div class=" col-md-8 mb-20">
											<label>Texto do ticket de estacionamento</label>
											<textarea class="form-control"
													  name="sistema_texto_ticket"><?php echo(isset($sistema) ? $sistema->sistema_texto_ticket : set_value('sistema_texto_ticket')); ?></textarea>

											<!--Trazendo a informação de erro-->
											<?php echo form_error('sistema_texto:ticket', '<div class="text-danger">', '</div>'); ?>
										</div>

									</div>

									<div class="card-footer text-right">

										<button class="btn btn-primary">Enviar</button>
										<a class="btn btn-info" href="<?php echo base_url('/'); ?>">Voltar</a>

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
