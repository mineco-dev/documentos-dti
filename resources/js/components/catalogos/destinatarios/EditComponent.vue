<template>
    <div>
        <div class="content-header">
            <h1 class="text-dark">Modificar destinatario</h1>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <a class="text-dark" href="#" title="Regresar a los destinatarios" v-on:click="$router.go(-1)">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <div class="form-group mt-3">
                                <label>Saludo</label>
                                <v-select v-bind:options="saludos" @input="setSaludo"></v-select>
                                <input type="hidden" id="saludo" name="saludo" v-model="destinatario.saludo_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('saludo') }}</div>
                                <small class="form-text text-muted">
                                    <router-link :to="{ name: 'saludos.create' }">Agregar saludo</router-link>
                                </small>
                            </div>
                            <div class="form-group">
                                <label for="destinatario">Nombre del destinatario</label>
                                <input autocomplete="name" class="form-control" id="destinatario" name="nombre del destinatario" type="text" v-model="destinatario.name" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('nombre del destinatario') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Cargo</label>
                                <v-select v-bind:options="cargos" @input="setCargo"></v-select>
                                <input type="hidden" id="cargo" name="cargo" v-model="destinatario.cargo_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('cargo') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Dependencia</label>
                                <v-select v-bind:options="dependencias" @input="setDependencia"></v-select>
                                <input type="hidden" id="dependencia" name="dependencia" v-model="destinatario.dependencia_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('dependencia') }}</div>
                            </div>
                            <div class="form-group">
                                <label>Entidad</label>
                                <v-select v-bind:options="entidades" @input="setEntidad"></v-select>
                                <input type="hidden" id="entidad" name="entidad" v-model="destinatario.entidad_id" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('entidad') }}</div>
                            </div>
                            <blockquote class="quote-danger" v-if="errors_server.length > 0">
                                <ul>
                                    <li v-for="error in errors_server">
                                        {{ error }}
                                    </li>
                                </ul>
                            </blockquote>
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save fa-lg fa-fw"></i>
                                Actualizar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
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
        components: {
            'v-select': VueSelect
        },
        data() {
            return {
                saludos: [],
                dependencias: [],
                entidades: [],
                cargos: [],
                destinatario: {
                    saludo_id: '',
                    dependencia_id: '',
                    entidad_id: '',
                    cargo_id: '',
                },
                errors_server: []
            }
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.put('/api/destinatarios/' + this.destinatario.id, this.destinatario)
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Actualización correcta',
                                html: response.data
                            })
                            .then(result => this.$router.push({ name: 'destinatarios.index'}))
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
            },
            setSaludo(value) {
                if(value != null) {
                    this.destinatario.saludo_id = value.code
                }
            },
            setDependencia(value) {
                if(value != null) {
                    this.destinatario.dependencia_id = value.code
                }
            },
            setEntidad(value) {
                if(value != null) {
                    this.destinatario.entidad_id = value.code
                }
            },
            setCargo(value) {
                if(value != null) {
                    this.destinatario.cargo_id = value.code
                }
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/destinatarios/' + this.$route.params.id),
                axios.get('/api/saludos?format=vue-select'),
                axios.get('/api/dependencias?format=vue-select'),
                axios.get('/api/entidades?format=vue-select'),
                axios.get('/api/cargos?format=vue-select')
                ])
            .then(response => {
                this.destinatario = response[0].data
                this.saludos = response[1].data
                this.dependencias = response[2].data
                this.entidades = response[3].data
                this.cargos = response[4].data
            })
        }
    }
</script>