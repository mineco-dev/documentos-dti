<template>
	<div>
		<div class="content-header">
			<a class="text-muted" href="#" title="Regresar" v-on:click="$router.go(-1)">
				<i class="fas fa-arrow-left fa-lg"></i>
			</a>
			<h1>Adjuntar pdf al documento:</h1>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<h3>
							{{ documento.correlativo }}
						</h3>
						<div class="text-muted">
							<p class="text-sm">Asunto
								<b class="d-block">{{documento.asunto}}</b>
							</p>
						</div>
					</div>
					<div class="col-md-3">
						<form id="form" enctype="multipart/form-data" v-on:submit.prevent="submit">
							<input type="hidden" name="_method" value="PUT">
							<div class="input-group mb-3">
								<div class="custom-file">
									<input type="file" class="custom-file-input" id="pdf" name="pdf" aria-describedby="inputGroupFileAddon01" v-on:change="setUrlLocal">
									<label class="custom-file-label" for="pdf">Buscar pdf</label>
								</div>
							</div>
							<button class="btn btn-primary" type="submit" v-bind:disabled="src == null">
								<i class="fas fa-upload fa-lg"></i>
								Subir pdf
							</button>
						</form>
					</div>
					<div class="col-md-9" v-show="src != null | documento.file_url != null">
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
			axios.get(`/api/documentos/${this.$route.params.id}?type=flat`)
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
				})
			}
		}
	}
</script>