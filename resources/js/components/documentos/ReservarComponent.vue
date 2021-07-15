<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<h2 class="text-center display-4">Reservar documento</h2>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-6 offset-md-3">
						<div class="shadow-lg p-3 mb-5 bg-white rounded">
							<div class="card-body">
								<div class="form-group">
									<label for="tipo_documento_id">
										Seleccione el tipo de documento a reservar
									</label>
									<select class="custom-select" name="tipo_documento_id" id="tipo_documento_id" v-model="documento.tipo_documento_id">
										<option value="1">Oficio</option>
										<option value="2">Dictámen</option>
										<option value="3">Memorandum</option>
										<option value="4">Providencia</option>
									</select>
								</div>
								<div class="form-group" v-show="documento.tipo_documento_id">
									<button class="btn btn-primary" v-on:click="reservaSimple">
										<i class="fas fa-bolt fa-2x fa-w text-warning"></i>
										Reserva básica
									</button>
									<router-link class="btn btn-primary" title="Reserva completa. Con esta opción usted podrá reservar un documento y generar el pdf" :to="{ name: 'documentos.reservar', query: { 'type': documento.tipo_documento_id } }">
										<i class="fas fa-file-alt fa-2x"></i>
										Reserva completa
									</router-link>
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
	import Swal from 'sweetalert2';
	export default {
		data() {
			return {
				documento: {}
			}
		},
		methods: {
			reservaSimple() {
				let titulo = document.getElementById('tipo_documento_id')[document.getElementById('tipo_documento_id').selectedIndex];
				Swal.fire({
					title: 'Reserva básica de ' + titulo.text,
					icon: 'info',
					input: 'textarea',
					inputLabel: 'Asunto',
					inputAttributes: {
						autocapitalize: 'off',
						name: 'asunto'
					},
					inputValidator: (asunto) => {
						if (!asunto) {
							return 'El campo asunto es requerido'
						}
					},
					showCancelButton: true,
					confirmButtonText: 'Reservar documento',
					cancelButtonText:'Cancelar',
					showLoaderOnConfirm: true,
					preConfirm: (asunto) => {
						return axios.post(`/api/documentos`, {
							fecha_emision: null,
							asunto: asunto,
							destinatario_id: null,
							respuesta: null,
							referencia: null,
							tipo_documento_id: this.documento.tipo_documento_id
						})
						.then(response => {
							if (!response) {
								throw new Error("Error")
							}
							return response
						})
						.catch(error => {
							Swal.showValidationMessage(
								`Error en la petición: ${error}`
								)
						})
					},
					allowOutsideClick: () => !Swal.isLoading()
				}).then((result) => {
					if (result.isConfirmed) {
						Swal.fire({
							icon: 'success',
							html: `El documento de tipo
							<b>${ titulo.text }</b> fue reservado exitosamente.
							<br>
							Correlativo: <b>${ result.value.data.correlativo }</b>`
						})
						.then(result => {
							this.documento.tipo_documento_id = null
						})
					}
				})
			}
		}
	}
</script>