<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Correlativos</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <button class="btn btn-primary" @click="create" v-if="$store.state.user.role_id == 1">
                    Crear correlativo
                </button>
                <div class="card mt-4">
                    <div class="card-body p-0">
                        <table class="table table-striped" v-if="tipos.length > 0">
                            <thead>
                                <tr>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Prefijo</th>
                                    <th scope="col">Correlativo vigente</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(documento, index) in tipos">
                                    <td>
                                        {{ documento.name }}
                                    </td>
                                    <td>{{documento.prefix}}</td>
                                    <td>
                                        {{ documento.correlativo}}-{{ documento.anio }}
                                    </td>
                                    <td align="center">
                                        <i class="fas fa-edit fa-lg" role="button" title="Modificar" v-bind:data-index="index" v-bind:data-id="documento.id" v-on:click="edit" v-if="$store.state.user.role_id == 1"></i>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <blockquote class="quote-info mt-0" v-else>
                            <h5>No hemos encontrado tipos de documentos</h5>
                        </blockquote>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">{{ conf.title }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form v-on:submit.prevent="submit">
                        <div class="modal-body">
                            <div class="alert alert-danger" v-show="errs.length > 0">
                                <ul>
                                    <li v-for="e in errs">{{ e }}</li>
                                </ul>
                            </div>
                            <div class="form-group">
                                <label for="name">Nombre</label>
                                <input class="form-control" id="name" name="name" type="text" required v-model="tipo.name">
                            </div>
                            <div class="form-group">
                                <label for="prefix">Prefijo</label>
                                <input class="form-control" id="prefix" name="prefix" type="text" required v-model="tipo.prefix">
                            </div>
                            <div class="form-group">
                                <label for="correlativo">Correlativo</label>
                                <input class="form-control" id="correlativo" name="correlativo" type="number" step="1" required v-model="tipo.correlativo">
                            </div>
                            <div class="form-group">
                                <label for="anio">Año</label>
                                <input class="form-control" id="anio" name="anio" type="number" step="1" required v-model="tipo.anio">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ conf.buttonText }}
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
                tipos: [],
                tipo: {},
                conf: {},
                errs: []
            }
        },
        created() {
            axios.get(`/api/tipo-documentos`)
            .then(response => {
                localStorage.setItem('td', JSON.stringify(response.data))
                this.tipos = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            create() {
                this.tipo = {}
                this.conf.title = "Crear correlativo"
                this.conf.buttonText = "Crear correlativo"
                this.conf.type = "create"
                $('#staticBackdrop').modal('show')
            },
            edit(event) {
                this.tipo = {...this.tipos[event.target.dataset.index]}
                this.tipo.index = event.target.dataset.index
                this.conf.title = "Actualizar correlativo"
                this.conf.buttonText = "Actualizar correlativo"
                this.conf.type = "update"
                $('#staticBackdrop').modal('show')
            },
            submit() {
                this.errs = []
                this.conf.type == 'create' ? this.store() : this.update()
            },
            store() {
                axios.post(`/api/tipo-documentos`, this.tipo)
                .then(response => {
                    $('#staticBackdrop').modal('toggle')
                    Swal.fire('Creación exitosa', 'Se creo un correlativo', 'success')
                    this.tipos.push(response.data)
                    localStorage.setItem('td', JSON.stringify(this.tipos))
                })
                .catch(error => {
                    this.errs = error.response.data.errors.name
                })
            },
            update() {
                axios.put(`/api/tipo-documentos/${this.tipo.id}`, this.tipo)
                .then(response => {
                    $('#staticBackdrop').modal('toggle')
                    Swal.fire('Actualización exitosa', response.data, 'success')
                    this.tipos.splice(this.tipo.index, 1, this.tipo)
                    localStorage.setItem('td', JSON.stringify(this.tipos))
                })
                .catch(error => {
                })
            }
        }
    }
</script>