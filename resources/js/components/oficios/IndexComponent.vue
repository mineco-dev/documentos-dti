<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Oficios</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <router-link class="btn btn-primary ml-2 mb-3" :to="{ name: 'reservar.documento', query: {type: 'oficios', title: 'oficio'} }">
                    <i class="fas fa-hand-point-up fa-lg mr-2"></i>
                    Reservar oficio
                </router-link>

                <table class="table table-hover table-bordered">
                    <caption>Listado de oficios</caption>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Correlativo</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Reservado por</th>
                            <th scope="col">Fecha y hora de reservación</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(oficio, index) in oficios.data" v-bind:class="{ 'table-warning': oficio.estado_documento_id == 1}">
                            <th scope="row">{{oficio.id}}</th>
                            <td>
                                DTI-{{oficio.prefix ? oficio.prefix + '-' : ''}}{{oficio.documento_id.padStart(3,"0")}}-{{oficio.anio}}
                            </td>
                            <td>
                                {{oficio.asunto}}
                            </td>
                            <td>{{oficio.responsable}}</td>
                            <td>{{oficio.created_at | moment().format("LLL")}}</td>
                            <td>
                                <i class="fa fa-bell" v-bind:class="{ 'text-danger': oficio.estado_documento_id == 1, 'text-success': oficio.estado_documento_id == 2, 'text-secondary': oficio.estado_documento_id == 3}"></i>
                                {{oficio.estado}}
                            </td>
                            <td>
                                <div class="btn-group dropleft">
                                    <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Opciones
                                    </button>
                                    <div class="dropdown-menu">
                                        <router-link class="dropdown-item" :to="{ name: 'oficios.upload', params: { id: oficio.id}}" v-if="oficio.estado_documento_id == 1">
                                            <i class="fas fa-upload fa-lg fa-fw text-success" role="button" title="Subir documento"></i>
                                            Subir documento
                                        </router-link>
                                        <router-link class="dropdown-item" :to="{ name: 'oficios.upload', params: { id: oficio.id}}" v-if="oficio.estado_documento_id == 2">
                                            <i class="fas fa-upload fa-lg fa-fw text-success" role="button" title="Reemplazar documento"></i>
                                            Reemplazar documento
                                        </router-link>
                                        <a class="dropdown-item" target="_blank" v-bind:href="oficio.file_referencia_url" v-if="oficio.file_referencia_url">
                                            <i class="fas fa-file-pdf fa-lg fa-fw text-danger" role="button" title="Reemplazar documento"></i>
                                            Descargar referencia
                                        </a>
                                        <a class="dropdown-item" target="_blank" v-bind:href="oficio.file_url" v-if="oficio.file_url">
                                            <i class="fas fa-file-pdf fa-lg fa-fw text-danger" role="button" title="Reemplazar documento"></i>
                                            Descargar documento
                                        </a>
                                        <button class="dropdown-item" v-if="oficio.estado_documento_id == 2 && oficio.file != null" v-on:click="archivar" v-bind:data-id="oficio.id" v-bind:data-index="index">
                                            <i class="fas fa-archive fa-lg fa-fw text-secondary" role="button" title="Reemplazar documento" v-bind:data-id="oficio.id" v-bind:data-index="index"></i>
                                            Archivar oficio
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <blockquote class="quote-info mt-0" v-if="oficios.total == 0">
                    <h5>No hemos encontrado oficios</h5>
                    <p>
                        Es posible que no tenga los permisos suficientes para visualizar los oficios.
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    import es from 'moment/locale/es';
    import Swal from 'sweetalert2';
    moment.locale('es')

    export default {
        data() {
            return {
                oficios: {data: []}
            }
        },
        filters: {
            moment: function (date) {
                return moment(date);
            }
        },
        mounted() {
            axios.get('/api/oficios').then(response => this.oficios = response.data)
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            archivar(event) {
                Swal.fire({
                    title: '¿Desea archivar el oficio?',
                    text: "El oficio ya no podrá ser modificado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, archivar'
                }).then((result) => {
                  if (result.isConfirmed) {
                    axios.put(`/api/oficios/${event.target.dataset.id}/archivar`)
                    .then(response => {
                        Swal.fire(
                          'Archivado',
                          'El oficio fue archivoado',
                          'success'
                          )
                        .then(result => {
                            this.oficios.data.splice(event.target.dataset.inde, 1, {
                                ...this.oficios.data[event.target.dataset.inde],
                                estado: 'Documento archivado',
                                estado_documento_id: 3
                            })
                        })
                    })
                }
            })
            }
        }
    }
</script>