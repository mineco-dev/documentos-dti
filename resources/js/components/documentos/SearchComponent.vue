<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<h2 class="text-center display-4">Búsqueda de documentos</h2>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<form v-on:submit.prevent="search">
					<div class="row">
						<div class="col-md-10 offset-md-1">
							<div class="form-group">
								<div class="input-group input-group-lg">
									<input type="search" class="form-control form-control-lg" placeholder="Introdúzca un asunto o número de documento" required v-model="q">
									<div class="input-group-append">
										<button type="submit" class="btn btn-lg btn-default">
											<i class="fa fa-search"></i>
										</button>
									</div>
								</div>
								<small class="text-muted">
									Ejemplo: DTI-001-2021 o 001-2021
								</small>
							</div>
						</div>
					</div>
				</form>
				<div class="row mt-3" v-if="documentos.length > 0">
					<div class="col-md-10 offset-md-1">
						<div class="list-group">
							<div class="list-group-item">
								<div class="row">
									<div class="col px-4">
										<div>
											<h3>
												Documentos encontrados
											</h3>
											<p class="mb-0">
												A continuación se muestra el listado de los documentos encontrados con el parámetro ingresado
											</p>
										</div>
									</div>
								</div>
							</div>
							<div class="list-group-item" v-for="documento in documentos">
								<div class="row">
									<div class="col-auto">
										<i class="fas fa-file-pdf fa-5x text-danger"></i>
									</div>
									<div class="col px-4">
										<div>
											<div class="float-right">
												<span class="badge badge-secondary">
													{{ documento.tipo }}
												</span>
											</div>
											<h3>
												{{ documento.correlativo }}
											</h3>
											<p class="mb-0">
												<b>{{ documento.asunto ? documento.asunto : 'Sin asunto' }}
												</b>
											</p>
											<p class="mb-0 text-muted small">
												<b>{{ documento.estado }}
												</b>
											</p>
											<p class="mb-0">
												<a target="_blank" v-bind:href="documento.file_url" v-show="documento.file_url">Descargar</a>
												|
												<a target="_blank" v-bind:href="documento.file_referencia_url">
													{{ documento.referencia }}
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row mt-3" v-if="sin_resultados">
					<div class="col-md-10 offset-md-1">
						<div class="list-group">
							<div class="list-group-item">
								<div class="row">
									<div class="col px-4">
										<div>
											<h3 class="text-danger">
												Sin resultados
											</h3>
											<p class="mb-0">
												Ningún documento coincide con el parámetro:
												<b>{{ q }}</b>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	export default {
		data() {
			return {
				q: '',
				documentos: [],
				sin_resultados: false
			}
		},
		methods: {
			search() {
				this.sin_resultados = false
				axios.get('/api/documentos/search', {
					params: {
						q: this.q
					}
				})
				.then(response => {
					this.documentos = response.data
					if(this.documentos.length == 0) {
						this.sin_resultados = true
					}
				})
			}
		}
	}
</script>