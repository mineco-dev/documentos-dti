<template>
    <div>
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
                <table class="table table-hover table-bordered" v-if="tipos.length > 0">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Prefijo</th>
                            <th scope="col">Correlativo</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(documento, index) in tipos">
                            <th scope="row">
                                {{ documento.name }}
                            </th>
                            <td>{{documento.prefix}}</td>
                            <td>
                                {{ documento.correlativo}}-{{ documento.anio }}
                            </td>
                            <td align="center">
                                <i class="fas fa-edit fa-lg" role="button" title="Modificar" v-bind:data-index="index" v-bind:data-id="documento.id" v-on:click="edit"></i>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <blockquote class="quote-info mt-0" v-else>
                    <h5>No hemos encontrado tipos de documentos</h5>
                </blockquote>
            </div>
        </div>
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Modificar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form v-on:submit.prevent="update">
                        <div class="modal-body">
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
                tipos: [],
                tipo: {}
            }
        },
        mounted() {
            axios.get(`/api/tipo-documentos`)
            .then(response => {
                this.tipos = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            edit(event) {
                this.tipo = {...this.tipos[event.target.dataset.index]}
                this.tipo.index = event.target.dataset.index
                $('#staticBackdrop').modal('show')
            },
            update() {
                axios.put(`/api/tipo-documentos/${this.tipo.id}`, this.tipo)
                .then(response => {
                    $('#staticBackdrop').modal('toggle')
                    Swal.fire('Actualización exitosa', response.data, 'success')
                    this.tipos.splice(this.tipo.index, 1, this.tipo)
                })
                .catch(error => {
                })
            }
        }
    }
</script>