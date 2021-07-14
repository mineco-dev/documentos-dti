<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Documentos pendientes de adjuntar pdf</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-1">
                                <i class="fas fa-bolt fa-2x fa-w text-warning" title="Reserva simple. Con esta opción únicamente es requerido el asunto" role="button" v-on:click="reservaSimple"></i>
                                <router-link title="Reserva completa. Con esta opción usted podrá reservar un documento y generar el pdf" :to="{ name: 'documentos.reservar', query: { 'type': documento.tipo_documento_id } }">
                                    <i class="fas fa-file-alt fa-2x"></i>
                                </router-link>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="custom-select" name="tipo_documento_id" id="tipo_documento_id" v-model="documento.tipo_documento_id" v-on:change="getList(1)">
                                    <option value="1">Oficios</option>
                                    <option value="2">Dictámenes</option>
                                    <option value="3">Memorandos</option>
                                    <option value="4">Providencias</option>
                                </select>
                            </div>
                            <div class="form-group col-md-2">
                                <select class="custom-select" id="per_page" v-model="per_page" v-on:change="getList(1)">
                                    <option value="5">5 registros</option>
                                    <option value="10">10 registros</option>
                                    <option value="25">25 registros</option>
                                    <option value="50">50 registros</option>
                                    <option value="100">100 registros</option>
                                    <option v-bind:value="documentos.total">todos los registros</option>
                                </select>
                            </div>
                            <div class="form-group col-md-7" v-show="documentos.to > 10">
                                <input type="search" class="form-control" id="search" v-model="search">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card" v-if="documentos.total > 0">
                    <div class="card-body p-0">
                        <table class="table table-hover table-valign-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Correlativo</th>
                                    <th scope="col">Asunto</th>
                                    <th scope="col">Reservado por</th>
                                    <th scope="col">Fecha y hora</th>
                                    <th scope="col">Estado</th>
                                    <th class="text-center" scope="col" style="width: 15%;">
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(documento, index) in filter" v-bind:class="{ 'table-warning': documento.estado_documento_id == 1}">
                                    <td>{{ documento.correlativo }}</td>
                                    <td>
                                        {{documento.asunto}}
                                    </td>
                                    <td>{{documento.responsable}}</td>
                                    <td>{{documento.created_at | moment().format("LLL")}}</td>
                                    <td>
                                        {{documento.estado}}
                                    </td>
                                    <td class="text-center" v-if="documento.estado_documento_id != 3">
                                        <i class="fas fa-spinner fa-lg text-secondary" role="button" title="Generar documento" v-bind:data-id="documento.id" v-bind:data-index="index" v-on:click="generar" v-bind:data-directory="documento.directory" v-if="documento.destinatario_id != null"></i>
                                        <router-link title="Modificar documento" :to="{ name: 'documentos.edit', params: { id: documento.id}}">
                                            <i class="fas fa-edit fa-lg text-primary" role="button"></i>
                                        </router-link>
                                        <router-link title="Adjuntar o reemplazar el documento firmado y sello de recibido" :to="{ name: 'documentos.upload', params: { id: documento.id }, query: { directory: documento.directory } }">
                                            <i class="fas fa-upload fa-lg text-success"></i>
                                        </router-link>

                                        <a target="_blank" title="Descargar referencia" v-bind:href="documento.file_referencia_url">
                                            <i class="fas fa-paperclip fa-lg text-danger"></i>
                                        </a>
                                        <a target="_blank" title="Descargar documento" v-bind:href="documento.file_url">
                                            <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                        </a>
                                        <i class="fas fa-file-archive fa-lg text-secondary" role="button" title="Archivar" v-on:click="archivar" v-bind:data-id="documento.id" v-bind:data-index="index"></i>
                                    </td>
                                    <td class="text-center" v-else>
                                        <a target="_blank" title="Descargar referencia" v-bind:href="documento.file_referencia_url">
                                            <i class="fas fa-paperclip fa-lg text-danger"></i>
                                        </a>
                                        <a target="_blank" title="Descargar documento" v-bind:href="documento.file_url">
                                            <i class="fas fa-file-pdf fa-lg text-danger"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <blockquote class="quote-info mt-0" v-else>
                    <h5>No hemos encontrado documentos</h5>
                    <p>
                        Es posible que no tenga los permisos suficientes para visualizar los documentos.
                    </p>
                </blockquote>
                <div class="row">
                    <div class="col-12">
                        Mostrando registros del {{ documentos.from }} al {{ documentos.to }} de un total de {{ documentos.total }} registros 
                        <nav aria-label="...">
                            <ul class="pagination justify-content-center">
                                <li class="page-item" v-bind:class="{'disabled': documentos.current_page == 1}">
                                    <a class="page-link" href="#" tabindex="-1" aria-disabled="true" v-on:click.prevent="cambiarPagina(documentos.current_page - 1)">
                                        Anterior
                                    </a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" v-bind:class="{'active': page == isActived}">
                                    <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(page)">
                                        {{page}}
                                    </a>
                                </li>
                                <li class="page-item" v-bind:class="{'disabled': documentos.current_page == documentos.last_page}">
                                    <a class="page-link" href="#" v-on:click.prevent="cambiarPagina(documentos.current_page + 1)">
                                        Siguiente
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
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
                documentos: {data: []},
                documento: {
                    table: null,
                    documento_id: 1
                },
                per_page: 5,
                search: '',
                offset: 3
            }
        },
        computed: {
            isActived: function() {
                return this.documentos.current_page
            },
            pagesNumber: function() {
                if(!this.documentos.to) {
                    return []
                }
                let from = this.documentos.current_page - this.offset
                if( from < 1) {
                    from = 1
                }

                let to = from + (this.offset * 2)
                if(to >= this.documentos.last_page) {
                    to = this.documentos.last_page
                }
                let pagesArray = []
                while(from <= to) {
                    pagesArray.push(from)
                    from++
                }
                return pagesArray
            },
            filter() {
                return this.documentos.data.filter((documento) => `
                    ${documento.correlativo} ${documento.asunto}`.toLowerCase().includes(this.search.toLowerCase()))
            }
        },
        filters: {
            moment: function (date) {
                return moment(date);
            }
        },
        mounted() {
            this.documento.tipo_documento_id = this.$route.query.type
            this.getList(1)
        },
        methods: {
            getList(page) {
                axios.get(`/api/documentos-pendientes`, {
                    params: {
                        user_id: this.$store.state.user.id,
                        tipo_documento_id: this.documento.tipo_documento_id,
                        page: page,
                        per_page:this.per_page
                    }
                })
                .then(response => {
                    this.documentos = response.data
                })
                .catch(error => {
                    console.log(error.response)
                })
            },
            cambiarPagina(page) {
                if(this.documentos.current_page != page) {
                    this.documentos.current_page = page
                    this.getList(page)
                }
            },
            reservaSimple() {
                let titulo = document.getElementById('tipo_documento_id')[document.getElementById('tipo_documento_id').selectedIndex];
                Swal.fire({
                    title: 'Reserva simple de ' + titulo.text,
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
                            tipo_documento_id: this.documento.tipo_documento_id,
                            table: titulo.dataset.table
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
                        this.documentos.data.unshift({
                            ...result.value.data,
                            documento_id: `${result.value.data.documento_id}`,
                            prefix: null,
                            responsable: this.$store.state.user.name,
                            estado: 'Pendiente de adjuntar',
                            estado_documento_id: 1,
                        })
                        this.documentos.total = this.documentos.total + 1
                        Swal.fire({
                            icon: 'success',
                            html: "Documento reservado"
                        })
                    }
                })
            },
            archivar(event) {
                Swal.fire({
                    title: '¿Desea archivar el documento?',
                    text: "El documento ya no podrá ser modificado",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, archivar'
                }).then((result) => {
                  if (result.isConfirmed) {
                    axios.put(`/api/documentos/${event.target.dataset.id}/archivar`)
                    .then(response => {
                        Swal.fire(
                          'Archivado',
                          'El documento fue archivado',
                          'success'
                          )
                        .then(result => {
                            this.documentos.data.splice(event.target.dataset.index, 1, {
                                ...this.documentos.data[event.target.dataset.index],
                                estado: 'Archivado',
                                estado_documento_id: 3
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
                axios.post(`/api/asignaciones/${event.target.dataset.id}/generar-pdf`, {
                    directory: event.target.dataset.directory
                })
                .then(response => {
                    Swal.fire({
                        title: "Documento generado",
                        icon: 'success'
                    })
                    .then(result => {
                        this.documentos.data.splice(event.target.dataset.index, 1, {
                            ...this.documentos.data[event.target.dataset.index],
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