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
											<th>Mensalista</th>
											<th>Categoria</th>
											<th>Valor mensalidade</th>
											<th>Data de vencimento</th>
											<th>Data de pagamento</th>
											<th>Status</th>

											<th class="text-center">Operações</th>
										</tr>
										</thead>

										<!--											Trazer as informações-->
										<tbody>

										<?php foreach ($mensalidades as $mensalidade): ?>

											<tr>

												<td><?php echo $mensalidade->mensalidade_id; ?></td>

												<td><i class="fas fa-eye text-info"></i>&nbsp;<a data-toggle="tooltip" data-placement="top" title="Visualizar mensalista <?php echo $mensalidade->mensalista_nome; ?>" href="<?php echo base_url('mensalistas/core/'.$mensalidade->mensalista_id) ;?>"><?php echo $mensalidade->mensalista_nome; ?></a></td>

												<td><?php echo $mensalidade->precificacao_categoria; ?></td>

												<td><?php echo 'KZ&nbsp;'. $mensalidade->precificacao_valor_mensalidade; ?></td>

												<td><?php echo formata_data_banco_sem_hora( $mensalidade->mensalidade_data_vencimento ); ?></td>

												<td><?php echo ($mensalidade->mensalidade_status == 1 ? formata_data_banco_sem_hora( $mensalidade->mensalidade_data_pagamento) : 'Em aberto') ?></td>

												<td><?php echo($mensalidade->mensalidade_status == 1 ? '<span class="badge badge-success">&nbsp;Paga</span>' : ' <span class="badge badge-danger">&nbsp;Em aberto</span>'); ?></td>


												<td class="text-center"><a data-toggle="tooltip" title=" <?php echo ($mensalidade->mensalidade_status == 1 ? 'Visualizar':'Editar') ?>"href="<?php echo base_url($this->router->fetch_class() . '/core/' . $mensalidade->mensalidade_id); ?>" class="btn btn-primary mr-2"><i class="<?php echo ($mensalidade->mensalidade_status == 1 ? 'fas fa-eye' : 'fas fa-edit');?>"></i></a>
													<a data-toggle="tooltip"title="Excluír <?php echo $this->router->fetch_class(); ?>"href="<?php echo base_url($this->router->fetch_class() . '/delete/' . $mensalidade->mensalidade_id); ?>" class="btn btn-warning delete" data-confirm="Tem certeza que desejas excluír?"><i class="fas fa-trash"></i></a>
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
