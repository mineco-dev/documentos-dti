<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h1>Adjuntar pdf al documento</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-3">
						<div class="card card-primary">
							<div class="card-body box-profile">
								<h3 class="profile-username text-center">
									{{ documento.correlativo }}
								</h3>
								<p class="text-muted text-center">
									{{ documento.asunto }}
								</p>
								<ul class="list-group list-group-unbordered mb-3">
									<li class="list-group-item">
										<b>Tipo</b>
										<a class="float-right">
											{{ documento.tipo }}
										</a>
									</li>
									<li class="list-group-item">
										<b>Referencia</b>
										<a class="float-right">
											{{ documento.referencia }}
										</a>
									</li>
								</ul>
								<form id="form" enctype="multipart/form-data" v-on:submit.prevent="submit">
									<input type="hidden" name="_method" value="PUT">
									<div class="input-group mb-3">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="pdf" name="pdf" aria-describedby="inputGroupFileAddon01" v-on:change="setUrlLocal">
											<label class="custom-file-label" for="pdf">Buscar pdf</label>
										</div>
									</div>
									<button class="btn btn-primary mb-3" type="submit" v-bind:disabled="src == null">
										<i class="fas fa-upload fa-lg"></i>
										Subir pdf
									</button>
								</form>
								<router-link title="Modificar documento" :to="{ name: 'documentos.edit', params: { id: documento.id}}">
									<i class="fas fa-edit fa-lg"></i>
								</router-link>
							</div>
						</div>
					</div>
					<div class="col-md-9">
						<div class="embed-responsive embed-responsive-16by9">
							<iframe class="embed-responsive-item" v-bind:src="src ? src : documento.file_url" allowfullscreen></iframe>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import Swal from 'sweetalert2';

	export default {
		data() {
			return {
				documento: {
					documento_id: ''
				},
				form: {},
				src: null,
			}
		},
		mounted() {
			axios.get(`/api/documentos/${this.$route.params.id}`)
			.then(response => this.documento = response.data)
		},
		methods: {
			setUrlLocal(event) {
				let documento = event.target.files[0];
				if(typeof documento != 'undefined') {
					this.src = URL.createObjectURL(event.target.files[0]);
					this.src += '#toolbar=0'
				} else {
					this.src = null
				}
			},
			submit() {
				axios.post(`/api/documentos/${this.documento.id}/upload?directory=${this.$route.query.directory}`, new FormData(document.getElementById('form')))
				.then(response => {
					Swal.fire({
						icon: 'success',
						title: 'Documento cargado',
						text: response.data
					})
					.then(result => {
						this.$router.go(-3)
					})
				})
			}
		}
	}
</script>