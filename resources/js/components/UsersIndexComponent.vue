<template>
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12">
						<h1>Usuarios</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="card">
					<div class="card-body p-0">
						<table class="table table-striped" v-if="users.length > 0">
							<thead>
								<tr>
									<th scope="col">Nombre</th>
									<th scope="col">Email</th>
									<th scope="col"></th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="(user, index) in users">
									<td>
										{{ user.name }}
									</td>
									<td>{{user.email}}</td>
									<td align="center">
										<a href="#" v-on:click="setUser" v-bind:data-id="user.id" v-bind:data-index="index">
											Rol
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						<blockquote class="quote-info mt-0" v-else>
							<h5>No hemos encontrado users de documentos</h5>
						</blockquote>
					</div>
				</div>

			</div>
		</div>
		<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title" id="staticBackdropLabel">Rol de usuario</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<form v-on:submit.prevent="update">
						<div class="modal-body">
							<div class="form-group">
								<label for="name">Usuario</label>
								<input class="form-control" disabled id="name" name="name" type="text" v-model="user.name">
							</div>
							<div class="form-group">
								<label for="prefix">Role</label>
								<select class="custom-select" id="prefix" name="prefix" required v-model="user.role_id">
									<option value=""></option>
									<option value="1">Administrador de Sistema</option>
									<option value="2">Operador</option>
								</select>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">
								Actualizar
							</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">
								Cerrar
							</button>
						</div>
					</form>
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
				users: [],
				user: {
					id: 0,
					name: null,
					role_id: 0
				},
				index: 0
			}
		},
		mounted() {
			axios.get('/api/users')
			.then(response => this.users = response.data)
		},
		methods: {
			setUser(event) {
				this.index = event.target.dataset.index
				let u = {...this.users[this.index]}
				this.user.id = u.id
				this.user.name = u.name
				this.user.role_id = u.role_id
				$('#staticBackdrop').modal('show')
			},
			update() {
				axios.put('/api/users/' + this.user.id, this.user)
				.then(response => {
					let u = {...this.users[this.index]}
					u.role_id = this.user.role_id
					this.users.splice(this.index, 1, u)
					$('#staticBackdrop').modal('toggle')
					Swal.fire('Usuario actualizado', '', 'success')
				})
			}
		}
	}
</script>