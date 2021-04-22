	<div class="main-wrapper main-wrapper-1">

<!--NAVBAR-->
		<?php $this->load->view('layout/navbar');?>

<!--SIDEBAR-->
		<?php $this->load->view('layout/sidebar');?>

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
												<a data-toggle="tooltip" title="Home" href="<?php echo base_url('/');?>">
													<i class="fas fa-home"></i>
												</a>
											</li>

											<!--Trazer a página anterior-->
											<li class="breadcrumb-item">
												<a data-toggle="tooltip" title="Listar <?php echo $this->router->fetch_class();?>" href="<?php echo base_url($this->router->fetch_class());?>">Listar &nbsp;<?php echo $this->router->fetch_class();?></a>
											</li>

											<!--Trazer a página corrente-->
											<li data-toggle="tooltip" class="breadcrumb-item active" aria-current="page">
												<?php echo $titulo;?>
											</li>

										</ol>
								</div>

								<div class="card-body">
									<!--Título-->
									<h2> <?php echo $titulo ;?></h2><br>

									<!--Data última alteração-->
									<?php echo (isset($mensalidade) ? '<i class="fas fa-calendar &nbsp; "></i>&nbsp; Data da última alteração:&nbsp; ' .formata_data_banco_com_hora($mensalidade->mensalidade_data_alteracao) : '');?>

									<!-- Formulário									-->
									<form name="form_core" method="post"><br>

										<div class="form-group row">

											<div class=" col-md-4 mb-20">
												<label>Nome</label>
												<input type="text" class="form-control" name="mensalista_nome"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_nome : set_value('mensalista_nome')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_nome', '<div class="text-danger">', '</div>'); ?>

											</div>

											<div class=" col-md-4 mb-20">
												<label>Sobrenome</label>
												<input type="text" class="form-control" name="mensalista_sobrenome"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_sobrenome : set_value('mensalista_sobrenome')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_sobrenome', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-4 mb-20">
												<label>Data de nascimento</label>
												<input type="date" class="form-control"
													   name="mensalista_data_nascimento"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_data_nascimento : set_value('mensalista_data_nascimento')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_data_nascimento', '<div class="text-danger">', '</div>'); ?>

											</div>

										</div>

										<div class="form-group row">

											<div class=" col-md-4 mb-20">
												<label>E-mail</label>
												<input type="email" class="form-control" name="mensalista_email"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_email : set_value('mensalista_email')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_email', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-4 mb-20">
												<label>Telefone</label>
												<input type="text" class="form-control" name="mensalista_telefone_movel"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_telefone_movel : set_value('mensalista_telefone_movel')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_telefone_movel', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-4 mb-20">
												<label>Endereço</label>
												<input type="text" class="form-control" name="mensalista_endereco"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_endereco : set_value('mensalista_endereco')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_endereco', '<div class="text-danger">', '</div>'); ?>
											</div>

										</div>

										<div class="form-group row">

											<div class=" col-md-4 mb-20">
												<label>Cidade</label>
												<input type="text" class="form-control" name="mensalista_cidade"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_cidade : set_value('mensalista_cidade')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_cidade', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-4 mb-20">
												<label>Bairro</label>
												<input type="text" class="form-control" name="mensalista_bairro"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_bairro : set_value('mensalista_bairro')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_bairro', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-4 mb-20">
												<label>Complemento</label>
												<input type="text" class="form-control" name="mensalista_complemento"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_complemento : set_value('mensalista_complemento')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_complemento', '<div class="text-danger">', '</div>'); ?>
											</div>

										</div>


										<div class="form-group row">

											<div class=" col-md-3 mb-20">
												<label>Ativo</label>

												<select class="form-control" name="mensalista_ativo">

													<!--Verificando-->
													<?php if (isset($mensalidade)): ?>

														<option value="0" <?php echo($mensalidade->mensalista_ativo == 0 ? 'selected' : ''); ?>>
															Não
														</option>
														<option value="1" <?php echo($mensalidade->mensalista_ativo == 1 ? 'selected' : ''); ?>>
															Sim
														</option>


													<?php else: ?>

														<option value="0">Não</option>
														<option value="1">Sim</option>

													<?php endif; ?>

												</select>

											</div>

											<div class=" col-md-3 mb-20">
												<label>Dia Vencimento Mensalidade</label>
												<input type="text" class="form-control" name="mensalista_dia_vencimento"
													   value="<?php echo(isset($mensalidade) ? $mensalidade->mensalista_dia_vencimento : set_value('mensalista_dia_vencimento')); ?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_dia_vencimento', '<div class="text-danger">', '</div>'); ?>
											</div>

											<div class=" col-md-6 mb-20">
												<label>Observação</label>

												<textarea rows="4" class="form-control" name="mensalista_obs"><?php echo(isset($mensalidade) ? $mensalidade->mensalista_obs : set_value('mensalista_obs')); ?></textarea>

												<!--Trazendo a informação de erro-->
												<?php echo form_error('mensalista_dia_vencimento', '<div class="text-danger">', '</div>'); ?>
											</div>



										</div>

										<?php if (isset($mensalidade)): ?>

											<div class="form-group row">

												<div class=" col-md-12">
													<input type="hidden" class="form-control" name="mensalista_id"
														   value="<?php echo $mensalidade->mensalista_id; ?>">
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
			<?php $this->load->view('layout/sidebar_configuracoes');?>

		</div>
