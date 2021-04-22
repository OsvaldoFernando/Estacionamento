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
								<!--									Título-->
								<?php echo "<h1>" . $titulo . "</h1>"; ?>

							</div>


							<div class="card-body">

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


								<!--Botão -->
								<a data-toggle="tooltip" title="Registrar <?php echo $this->router->fetch_class(); ?>"
								   href="<?php echo base_url($this->router->fetch_class() . '/core/'); ?>"
								   class="btn bg-blue float-right mb-1 text-white">+ Novo</a><br><br><br>

								<div class="table-responsive">
									<table class="table table-striped" id="table-1">
										<thead>
										<tr>
											<th>
												#
											</th>
											<th>Nome da forma pagamento</th>
											<th>Ativa</th>

											<th class="text-center">Operações</th>
										</tr>
										</thead>

										<!--											Trazer as informações-->
										<tbody>

										<?php foreach ($formas as $forma): ?>

											<tr>

												<td>
													<?php echo $forma->forma_pagamento_id; ?>
												</td>

												<td>
													<?php echo $forma->forma_pagamento_nome; ?>
												</td>

												<td>
													<?php echo($forma->forma_pagamento_ativa == 1 ? '<span class="badge badge-success"><i class="fas fa-lock-open"></i>&nbsp;Sim</span>' : ' <span class="badge badge-danger"><i class="fas fa-solid fa-lock"></i>&nbsp;Não</span>'); ?>
												</td>

												<td class="text-right">
													<a data-toggle="tooltip"
													   title="Editar <?php echo $this->router->fetch_class(); ?>"
													   href="<?php echo base_url($this->router->fetch_class() . '/core/' . $forma->forma_pagamento_id); ?>"
													   class="btn btn-primary mr-2"><i class="fas fa-edit"></i></a>
													<a data-toggle="tooltip"
													   title="Excluír <?php echo $this->router->fetch_class(); ?>"
													   href="<?php echo base_url($this->router->fetch_class() . '/delete/' . $forma->forma_pagamento_id); ?>"
													   class="btn btn-warning delete"
													   data-confirm="Tem certeza que desejas excluír?"><i
																class="fas fa-trash"></i></a>
												</td>

											</tr>

										<?php endforeach; ?>

										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
		</section>
	</div>


	<!--			SIDEBAR CONFIGURAÇOES-->
	<?php $this->load->view('layout/sidebar_configuracoes'); ?>

</div>
