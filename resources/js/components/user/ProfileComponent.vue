<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Perfil de usuario</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-primary card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <img class="profile-user-img img-fluid img-circle" v-bind:src="$store.state.user.profile_photo_url" alt="Foto de perfil">
                                </div>

                                <h3 class="profile-username text-center">{{$store.state.user.name}}</h3>
                                <p class="text-muted text-center">{{$store.state.user.email}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header p-2">
                                Información
                            </div>
                            <div class="card-body">
                                <form class="form-horizontal" v-on:submit.prevent="updateUserProfileInformation" enctype="multipart/form-data">
                                    <input name="_method" type="hidden" value="PUT">
                                    <input name="email" type="hidden" v-bind:value="$store.state.user.email">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-2 col-form-label">Nombre</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="name" name="name" v-bind:value="$store.state.user.name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="email" class="col-sm-2 col-form-label">Correo</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="email" v-bind:value="$store.state.user.email" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-2 col-form-label">
                                            Fotografía
                                            <small class="text-muted">(opcional)</small>
                                        </label>
                                        <div class="col-sm-10">
                                            <div class="custom-file mb-3">
                                                <input type="file" class="custom-file-input" id="photo" name="photo" lang="es">
                                                <label class="custom-file-label" for="photo">Seleccionar Archivo</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <div class="alert alert-danger" v-if="errors.length > 0">
                                                <p class="mb-0">
                                                    <strong>Lo sentimos</strong>,
                                                    algo salió mal.
                                                </p>
                                                <br>
                                                <ul>
                                                    <li v-for="error in errors">
                                                        {{ error }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary">
                                                <b>Actualizar perfil</b>
                                            </button>
                                        </div>
                                    </div>
                                </form>
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
                errors: []
            }
        },
        methods: {
            updateUserProfileInformation(event) {
                this.errors = [];
                axios.post('/api/user', new FormData(event.target))
                .then(response => {
                    this.$store.commit('setUser', response.data)
                    Swal.fire({
                        icon: 'success',
                        html: 'Su perfil de usuario fue actualizado.',
                        title: 'Actualización completa'
                    })
                })
                .catch(error => {
                    if (typeof error.response.data === 'object') {
                        this.errors = _.flatten(_.toArray(error.response.data.errors));
                    } else {
                        this.errors = ['Something went wrong. Please try again.'];
                    }
                });
            }
        }
    }
</script>
