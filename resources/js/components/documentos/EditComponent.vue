<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <h1 class="text-dark"></h1>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form autocomplete="off" enctype="multipart/form-data" class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <a class="text-muted" href="#" title="Regresar" v-on:click="$router.go(-1)">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="form-group mt-3">
                                <label for="tipo_documento_id">
                                    Modificando
                                </label>
                                <select class="custom-select" v-model="documento.tipo_documento_id" disabled>
                                    <option value="1">Oficio</option>
                                    <option value="2">Dictámen</option>
                                    <option value="3">Memorándum</option>
                                    <option value="4">Providencia</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_emision">Fecha de emisión</label>
                                <input class="form-control" type="date" :value="documento.fecha_emision" disabled>
                                <input id="fecha_emision" name="fecha_emision" type="hidden" :value="documento.fecha_emision">
                            </div>

                            <div class="form-group ">
                                <label>{{label_destinatario}}</label>
                                <v-select v-bind:options="destinatarios" @input="setDestinatario"></v-select>
                                <input aria-describedby="destinatario_help" type="hidden" id="destinatario_id" name="destinatario_id" v-model="documento.destinatario_id">
                                <small id="destinatario_help" class="form-text text-muted">
                                    <router-link :to="{ name: 'destinatarios.create' }">Agregar destinatario</router-link>
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="asunto">Asunto</label>
                                <input class="form-control" id="asunto" name="asunto"  type="text" v-model="documento.asunto">
                            </div>

                            <div class="form-group">
                                <label for="asunto">Respuesta</label>
                                <vue-editor v-model="documento.respuesta" />
                                <input type="hidden" v-model="documento.respuesta" id="respuesta" name="respuesta">
                            </div>
                            <div class="form-group">
                                <label for="referencia">
                                	Referencia
                                	<small>(opcional)</small>
                                </label>
                                <input aria-describedby="referencia_help" class="form-control" id="referencia" name="referencia" type="text" v-model="documento.referencia">
                                <small id="referencia_help" class="form-text text-muted">
                                    Puede ser el asunto del documento al que le dará respuesta
                                </small>
                            </div>

                            <div class="form-group" v-if="documento.referencia != null">
                                <label for="file_referencia">
                                	Adjuntar referencia
                                </label>
                                <input aria-describedby="file_referencia_help" accept="application/pdf" class="form-control-file" id="file_referencia" name="file_referencia" type="file">
                                <small id="file_referencia_help" class="form-text text-muted">
                                    Pdf del documento al que se la dará respuesta
                                </small>
                            </div>
                            <div class="form-group mt-3">
                                <label for="file">
                                    Adjuntar pdf firmado
                                    <small>(opcional)</small>
                                </label>
                                <input type="file" class="form-control" id="file" name="file">
                            </div>
                            <ul>
                                <li class="text-danger" v-for="error in errors_server">
                                    {{ error }}
                                </li>
                            </ul>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save fa-lg mr-2"></i>
                                    Actualizar asignación
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import { VueEditor } from "vue2-editor";
    import Vue from 'vue/dist/vue.js';
    import VueSelect from 'vue-select';
    import 'vue-select/dist/vue-select.css';
    import es from 'vee-validate/dist/locale/es';
    import Swal from 'sweetalert2';

    export default {
        data() {
            return {
                destinatarios: [],
                documento: {
                    referencia: null
                },
                errors_server: []
            }
        },
        components: {
            VueEditor,
            'v-select': VueSelect
        },
        computed: {
            label_destinatario() {
                return this.$route.query.type == 'memorándum' ? 'Para' : 'Responder a'
            }
        },
        mounted() {
            Promise.all([
                axios.get(`/api/documentos/${this.$route.params.id}?type=flat`),
                axios.get('/api/destinatarios?format=vue-select')
                ])
            .then(response => {
                this.documento = response[0].data
                this.destinatarios = response[1].data
            })
        },
        methods: {
            setDestinatario(value) {
                if(value != null) {
                    this.documento.destinatario_id = value.code
                }
            },
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post(`/api/documentos/${this.$route.params.id}`, new FormData(document.getElementById('form')))
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro actualizado'
                            })
                            .then(result => {
                                this.$router.push({ name: 'documentos.index', query: { type: this.documento.tipo_documento_id } })
                            })
                        })
                        .catch(error => {
                            if (error.response.status == 422 && typeof error.response.data === 'object') {
                                this.errors_server = _.flatten(_.toArray(error.response.data.errors));
                            } else {
                                this.errors_server = [error.response.data.message ? error.response.data.message : error.response.data];
                            }
                        })
                    }
                })
            }
        }
    }
</script>

<style lang="css">
@import "~vue2-editor/dist/vue2-editor.css";
</style>