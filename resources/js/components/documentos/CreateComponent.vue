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
                            <div class="form-group mt-3">
                                <label for="tipo_documento_id">
                                    Reserva completa de
                                </label>
                                <select class="custom-select" name="tipo_documento_id" id="tipo_documento_id" v-model="documento.tipo_documento_id" v-validate="'required'">
                                    <option :value="t.id" v-for="t in td" :key="t.id">{{ t.name }}</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="fecha_emision">Fecha de emisión</label>
                                <input class="form-control" id="fecha_emision" name="fecha_emision" type="date" v-model="documento.fecha_emision" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('fecha_emision') }}</div>
                            </div>

                            <div class="form-group ">
                                <label>{{label_destinatario}}</label>
                                <v-select v-bind:options="destinatarios" @input="setDestinatario"></v-select>
                                <input aria-describedby="destinatario_help" type="hidden" id="destinatario_id" name="destinatario_id" v-model="documento.destinatario_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('destinatario_id') }}</div>
                                <small id="destinatario_help" class="form-text text-muted">
                                    <router-link :to="{ name: 'destinatarios.create' }">Agregar destinatario</router-link>
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="asunto">Asunto</label>
                                <input class="form-control" id="asunto" name="asunto"  type="text" v-model="documento.asunto" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('asunto') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="asunto">Respuesta</label>
                                <vue-editor v-model="documento.respuesta" />
                                <input type="hidden" v-model="documento.respuesta" id="respuesta" name="respuesta" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('respuesta') }}</div>
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
                                <input aria-describedby="file_referencia_help" accept="application/pdf" class="form-control-file" id="file_referencia" name="file_referencia" type="file" v-validate="'required|ext:pdf'">
                                <div class="invalid-feedback">{{ errors.first('referencia_file') }}</div>
                                <small id="file_referencia_help" class="form-text text-muted">
                                    Pdf del documento al que se la dará respuesta
                                </small>
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save fa-lg mr-2"></i>
                                    Guardar asignación
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
    import VeeValidate from 'vee-validate';
    import { Validator } from 'vee-validate';
    import Swal from 'sweetalert2';

    Vue.use(VeeValidate, {
        classes: true,
        classNames: {
            valid: '',
            invalid: 'is-invalid'
        }
    });

    Validator.localize('es', es);

    export default {
        data() {
            return {
                destinatarios: [],
                documento: {
                    destinatario_id: '',
                    tipo_documento_id: null
                },
                td: []
            }
        },
        components: {
            VueEditor,
            'v-select': VueSelect
        },
        computed: {
            label_destinatario() {
                return this.documento.tipo_documento_id == 3 ? 'Para' : 'Responder a'
            }
        },
        created() {
            if(localStorage.getItem('td')) {
                this.td = JSON.parse(localStorage.getItem('td'))
            }
            Promise.all([
                axios.get('/api/destinatarios?format=vue-select')
                ])
            .then(response => {
                this.destinatarios = response[0].data
            })

            this.documento.tipo_documento_id = this.$route.query.type
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
                        axios.post(`/api/documentos?user_id=${this.$store.state.user.id}&table=${document.getElementById('tipo_documento_id')[document.getElementById('tipo_documento_id').selectedIndex].dataset.table}`, new FormData(document.getElementById('form')))
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro correcto'
                            })
                            .then(result => {
                                this.$router.push({name: 'mis-documentos.index', query: {
                                    type: this.documento.tipo_documento_id
                                }})
                            })
                        })
                        .catch(error => {
                            if (typeof error.response.data === 'object') {
                                this.errors_server = _.flatten(_.toArray(error.response.data.errors));
                            } else {
                                this.errors_server = ['Something went wrong. Please try again.'];
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