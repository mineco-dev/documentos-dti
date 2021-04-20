<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Oficios</h1>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="form-group col-md-2">
                                <label id="per_page" for="inputPassword4">Mostrar</label>
                                <select class="form-control" id="per_page" v-model="per_page" v-on:change="getList">
                                    <option value="5">5 registros de un </option>
                                    <option value="10">10 registros</option>
                                    <option value="25">25 registros</option>
                                    <option value="50">50 registros</option>
                                    <option value="100">100 registros</option>
                                    <option v-bind:value="oficios.total">todos los registros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-10" v-show="oficios.total > 10">
                                <label for="search">Filtrar</label>
                                <input type="search" class="form-control" id="search" v-model="search">
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-hover table-bordered" v-if="oficios.total > 0">
                    <caption>
                        <nav aria-label="...">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" v-bind:class="{'disabled': oficios.current_page == 1}">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(oficios.current_page - 1)">
                                        Anterior
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                                    <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">
                                        {{page}}
                                    </a>
                                </li>
                                <li class="page-item" v-bind:class="{'disabled': oficios.current_page == oficios.last_page}">
                                    <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(oficios.current_page + 1)">
                                        Siguiente
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </caption>
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
                                        <button class="dropdown-item" v-if="oficio.estado_documento_id == 1" v-on:click="generar" v-bind:data-id="oficio.id" v-bind:data-index="index">
                                            <i class="fas fa-spinner fa-lg fa-fw text-secondary" role="button" title="Generar documento" v-bind:data-id="oficio.id" v-bind:data-index="index"></i>
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
                oficios: {data: []},
                per_page: 5,
                search: null,
                offset: 3
            }
        },
        computed: {
            isActived: function() {
                return this.oficios.current_page
            },
            pagesNumber: function() {
                if(!this.oficios.to) {
                    return []
                }
                let from = this.oficios.current_page - this.offset
                if( from < 1) {
                    from = 1
                }

                let to = from + (this.offset * 2)
                if(to >= this.oficios.last_page) {
                    to = this.oficios.last_page
                }
                let pagesArray = []
                while(from <= to) {
                    pagesArray.push(from)
                    from++
                }
                return pagesArray
            },
            filter() {
                return this.oficios.data.filter(oficio => oficio.name.toLowerCase().includes(this.search.toLowerCase()))
            }
        },
        filters: {
            moment: function (date) {
                return moment(date);
            }
        },
        mounted() {
            this.getList(1)
        },
        methods: {
            getList(page) {
                axios.get(`/api/oficios?page=${page}&per_page=${this.per_page}`)
                .then(response => {
                    this.oficios = response.data
                })
                .catch(error => {
                    console.log(error.response)
                })
            },
            cambiarPagina(page) {
                if(this.oficios.current_page != page) {
                    this.oficios.current_page = page
                    this.getList(page)
                }
            },
            reservaSimple() {
                Swal.fire({
                    title: 'Reserva simple de oficio',
                    icon: 'info',
                    input: 'textarea',
                    inputLabel: 'Asunto',
                    inputAttributes: {
                        autocapitalize: 'off',
                        name: 'asunto'
                    },
                    inputValidator: (value) => {
                        if (!value) {
                            return 'El campo asunto es requerido'
                        }
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
                            estado_documento_id: 1,
                        })
                        this.oficios.total = this.oficios.total + 1
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
                                estado: 'Archivado',
                                estado_documento_id: 2,
                            })
                        })
                    })
                }
            })
            },
            generar(event) {
                Swal.fire({
                    icon: 'info',
                    title: 'Generando documento...',
                    didOpen: () => {
                        Swal.showLoading()
                    }
                })
                axios.post(`/api/asignaciones/${event.target.dataset.id}/generar-pdf`)
                .then(response => {
                    Swal.fire({
                        title: "Documento generado",
                        icon: 'success'
                    })
                    .then(result => {
                        this.oficios.data.splice(event.target.dataset.index, 1, {
                            ...this.oficios.data[event.target.dataset.index],
                            file_url: response.data
                        })
                    })
                })
                .catch(error => {
                    Swal.fire({
                        title: 'Error',
                        icon: 'error',
                        html: error.response.data.message
                    })
                })
            }
        }
    }
</script>