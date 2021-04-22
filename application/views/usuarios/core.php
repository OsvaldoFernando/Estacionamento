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
									<?php echo (isset($usuario) ? '<i class="fas fa-calendar &nbsp; "></i>&nbsp; Data da última alteração:&nbsp; ' .formata_data_banco_com_hora($usuario->data_ultima_alteracao) : '');?>

									<!-- Formulário									-->
									<form name="form_core" method="post"><br>

										<div class="form-group row">

											<div class=" col-md-6 mb-20">
												<label>Nome</label>
												<input type="text" class="form-control" name="first_name" value="<?php echo (isset($usuario) ? $usuario->first_name : set_value('first_name')) ;?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('first_name','<div class="text-danger">','</div>');?>

											</div>

											<div class=" col-md-6 mb-20">
												<label>Sobrenome</label>
												<input type="text" class="form-control" name="last_name" value="<?php echo (isset($usuario) ? $usuario->last_name : set_value('last_name')) ;?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('last_name','<div class="text-danger">','</div>');?>
											</div>

										</div>

										<div class="form-group row">

											<div class=" col-md-6 mb-20">
												<label>Usuário</label>
												<input type="text" class="form-control" name="username" value="<?php echo (isset($usuario) ? $usuario->username : set_value('username')) ;?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('username','<div class="text-danger">','</div>');?>

											</div>

											<div class=" col-md-6 mb-20">
												<label>E-mail(Login)</label>
												<input type="email" class="form-control" name="email" value="<?php echo (isset($usuario) ? $usuario->email : set_value('email'));?>">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('email','<div class="text-danger">','</div>');?>


											</div>

										</div>

										<div class="form-group row">

											<div class=" col-md-6 mb-20">
												<label>Senha</label>
												<input type="password" class="form-control" name="password" value="">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('password','<div class="text-danger">','</div>');?>


											</div>

											<div class=" col-md-6 mb-20">
												<label>Confirmar senha</label>
												<input type="password" class="form-control" name="confirmacao" value="">

												<!--Trazendo a informação de erro-->
												<?php echo form_error('confirmacao','<div class="text-danger">','</div>');?>


											</div>

										</div>


										<div class="form-group row">

											<div class=" col-md-6 mb-20">
												<label>Perfil de acesso</label>

												<select class="form-control" name="perfil">

													<!-- Verificando -->
													<?php if(isset($usuario)):?>

														<option value="2" <?php echo ($perfil_usuario->id == 2 ? 'selected' : '');?>>Atendente</option>
														<option value="1" <?php echo ($perfil_usuario->id == 1 ? 'selected' : '');?>>Administrador</option>

														<!-- Verificando caso esteja cadastrando-->
													<?php else: ?>

														<option value="2">Atendente</option>
														<option value="1">Administrador</option>
													<?php endif; ?>

												</select>

											</div>

											<div class=" col-md-6 mb-20">
												<label>Estado</label>

												<select class="form-control" name="active">

													<!--Verificando-->
													<?php if(isset($usuario)):?>

														<option value="0" <?php echo ($usuario->active == 0 ? 'selected' : '');?>>Não</option>
														<option value="1" <?php echo ($usuario->active == 1 ? 'selected' : '');?>>Sim</option>


													<?php else: ?>

														<option value="0">Não</option>
														<option value="1">Sim</option>

													<?php endif; ?>

												</select>

											</div>

										</div>

										<?php if(isset($usuario)): ?>

											<div class="form-group row">

												<div class=" col-md-12">
													<input type="hidden" class="form-control" name="usuario_id" value="<?php echo $usuario->id;?>">
												</div>

											</div>

										<?php endif; ?>

										<div class="card-footer text-right">

											<button class="btn btn-primary">Enviar</button>
											<a class="btn btn-info" href="<?php echo base_url($this->router->fetch_class());?>">Voltar</a>

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
