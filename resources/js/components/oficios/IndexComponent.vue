<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">{{this.$route.query.title}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <button class="btn btn-outline-primary ml-2 mb-3" v-on:click="reservaSimple">
                    <i class="fas fa-bell fa-lg mr-2"></i>
                    Reserva simple
                </button>
                <router-link class="btn btn-outline-primary ml-2 mb-3" :to="{ name: 'documentos.reservar', query: {type: 'oficios', title: 'oficio'} }">
                    <i class="fas fa-hand-point-up fa-lg mr-2"></i>
                    Reserva completa
                </router-link>
                <table class="table table-hover table-bordered" v-if="oficios.total > 0">
                    <caption>Listado de oficios</caption>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Correlativo</th>
                            <th scope="col">Asunto</th>
                            <th scope="col">Reservado por</th>
                            <th scope="col">Fecha y hora de reservación</th>
                            <th scope="col">Estado</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(oficio, index) in oficios.data" v-bind:class="{ 'table-warning': oficio.estado_documento_id == 1}">
                            <th scope="row">{{oficio.id}}</th>
                            <td>
                                DTI-{{oficio.prefix ? oficio.prefix + '-' : ''}}{{oficio.documento_id}}-{{oficio.anio}}
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
                                        <button class="dropdown-item" v-if="oficio.estado_documento_id == 1 && oficio.file == null" v-on:click="generar" v-bind:data-id="oficio.id" v-bind:data-index="index">
                                            <i class="fas fa-spinner fa-lg fa-fw text-secondary" role="button" title="Reemplazar documento" v-bind:data-id="oficio.id" v-bind:data-index="index"></i>
                                            Generar documento
                                        </button>
                                        <router-link class="dropdown-item" :to="{ name: 'oficios.edit', params: { id: oficio.id}}" v-if="oficio.estado_documento_id == 1">
                                            <i class="fas fa-edit fa-lg fa-fw text-primary" role="button" title="Modificar documento"></i>
                                            Modificar documento
                                        </router-link>
                                        <router-link class="dropdown-item" :to="{ name: 'oficios.upload', params: { id: oficio.id}, query: { type: $route.query.type, type_id: $route.query.type_id}}" v-if="oficio.estado_documento_id == 1">
                                            <i class="fas fa-upload fa-lg fa-fw text-success" role="button" title="Subir documento"></i>
                                            Subir documento
                                        </router-link>
                                        
                                        <a class="dropdown-item" target="_blank" v-bind:href="oficio.file_referencia_url" v-if="oficio.file_referencia_url">
                                            <i class="fas fa-file-pdf fa-lg fa-fw text-danger" role="button" title="Reemplazar documento"></i>
                                            Descargar referencia
                                        </a>
                                        <a class="dropdown-item" target="_blank" v-bind:href="oficio.file_url" v-if="oficio.file_url">
                                            <i class="fas fa-file-pdf fa-lg fa-fw text-danger" role="button" title="Reemplazar documento"></i>
                                            Descargar documento
                                        </a>
                                        <router-link class="dropdown-item" :to="{ name: 'oficios.upload', params: { id: oficio.id}}" v-if="oficio.estado_documento_id == 2">
                                            <i class="fas fa-upload fa-lg fa-fw text-success" role="button" title="Reemplazar documento"></i>
                                            Reemplazar documento
                                        </router-link>
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
                <blockquote class="quote-info mt-0" v-else>
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
            axios.get(`/api/oficios`)
            .then(response => {
                this.oficios = response.data
            })
            .catch(error => {
                console.log(error.response)
            })
        },
        methods: {
            reservaSimple() {
                Swal.fire({
                    title: 'Reserva simple de oficio \n\n Asunto:',
                    icon: 'info',
                    input: 'textarea',
                    inputAttributes: {
                        autocapitalize: 'off',
                        name: 'asunto'
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Reservar oficio',
                    cancelButtonText:'Cancelar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        return axios.post(`/api/oficios`, {
                            fecha_emision: null,
                            asunto: login,
                            destinatario_id: null,
                            respuesta: null,
                            referencia: null,
                            tipo_documento_id: 1
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
                        this.oficios.data.unshift({
                            ...result.value.data,
                            documento_id: `${result.value.data.documento_id}`,
                            prefix: null,
                            responsable: this.$store.state.user.name,
                            estado: 'Pendiente de adjuntar',
                            estado_documento_id: 1
                        })
                        Swal.fire({
                            icon: 'success',
                            html: "Oficio reservado"
                        })
                    }
                })
            },
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
                          'El oficio fue archivado',
                          'success'
                          )
                        .then(result => {
                            this.oficios.data.splice(event.target.dataset.index, 1, {
                                ...this.oficios.data[event.target.dataset.index],
                                estado: response.data,
                                estado_documento_id: 3
                            })
                        })
                    })
                }
            })
            },
            generar(event) {
                alert('Se va  generar el pdf.')
            }
        }
    }
</script>