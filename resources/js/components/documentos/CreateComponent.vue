<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Reservar {{$route.query.title}}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form autocomplete="off" class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <div class="form-group mt-3">
                                <label for="fecha_emision">Fecha de emisión</label>
                                <input class="form-control" id="fecha_emision" name="fecha de emisión" type="date" v-model="oficio.fecha_emision" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('fecha de emisión') }}</div>
                            </div>

                            <div class="form-group ">
                                <label>{{label_destinatario}}</label>
                                <v-select v-bind:options="destinatarios" @input="setDestinatario"></v-select>
                                <input aria-describedby="destinatario_help" type="hidden" id="destinatario" name="destinatario" v-model="oficio.destinatario_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('destinatario') }}</div>
                                <small id="destinatario_help" class="form-text text-muted">
                                    <router-link :to="{ name: 'destinatarios.create' }">Agregar destinatario</router-link>
                                </small>
                            </div>

                            <div class="form-group">
                                <label for="asunto">Asunto</label>
                                <input class="form-control" id="asunto" name="asunto"  type="text" v-model="oficio.asunto" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('asunto') }}</div>
                            </div>

                            <div class="form-group">
                                <label for="asunto">Respuesta</label>
                                <vue-editor v-model="oficio.respuesta" />
                                <input type="hidden" v-model="oficio.respuesta" id="respuesta" name="contenido" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('contenido') }}</div>
                            </div>
                            <div class="form-group">
                                <label for="referencia">
                                	Referencia
                                	<small>(opcional)</small>
                                </label>
                                <input aria-describedby="referencia_help" class="form-control" id="referencia" name="referencia" type="text" v-model="oficio.referencia">
                                <small id="referencia_help" class="form-text text-muted">
                                    Puede ser el asunto del documento al que le dará respuesta
                                </small>
                            </div>

                            <div class="form-group" v-show="oficio.referencia != null && oficio.referencia != ''">
                                <label for="file_referencia">
                                	Adjuntar referencia
                                </label>
                                <input aria-describedby="file_referencia_help" accept="application/pdf" class="form-control-file" id="file_referencia" name="pdf de la referencia" type="file" v-validate="'required|ext:pdf'">
                                <div class="invalid-feedback">{{ errors.first('pdf de la referencia') }}</div>
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
                oficio: {
                    destinatario_id: ''
                }
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
                axios.get('/api/destinatarios?format=vue-select')
                ])
            .then(response => {
                this.destinatarios = response[0].data
            })
        },
        methods: {
            setDestinatario(value) {
                if(value != null) {
                    this.oficio.destinatario_id = value.code
                }
            },
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post(`/api/oficios?user_id=${this.$store.state.user.id}&type=${this.$route.query.type}`, this.oficio)
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro correcto',
                                html: response.data
                            })
                            .then(result => {
                                this.$router.push({name: 'oficios.index'})
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