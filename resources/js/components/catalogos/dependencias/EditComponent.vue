<template>
    <div>
        <div class="content-header">
            <h1 class="text-dark">Modificar dependencia</h1>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form autocomplete="off" class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <a class="text-dark" href="#" title="Regresar a las dependencias" v-on:click="$router.go(-1)">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <div class="form-group mt-3">
                                <label for="dependencia">Nombre de la dependencia</label>
                                <input class="form-control" id="dependencia" name="nombre del dependencia" type="text" v-model="dependencia.name" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('nombre del dependencia') }}</div>
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
    import es from 'vee-validate/dist/locale/es';
    import VeeValidate from 'vee-validate';
    import { Validator } from 'vee-validate';
    import Swal from 'sweetalert2';

    Vue.use(VeeValidate, {
        mode: 'eager',
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
                dependencia: {
                    _method: 'PUT'
                },
                errors_server: []
            }
        },
        mounted() {
            axios.get('/api/dependencias/'+ this.$route.params.id)
            .then(response => this.dependencia = response.data)
            .catch(error => {
                Swal.fire({
                    icon: 'warning',
                    title: `Error ${error.response.status} - ${error.response.statusText}`,
                    html: error.response.data.message
                })
                .then(result => {
                    this.$router.push({name: 'dependencias.index'})
                })
            })
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.put('/api/dependencias/' + this.dependencia.id, this.dependencia)
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Actualización correcta',
                                html: response.data
                            })
                            .then(result => {
                                this.$router.push({name: 'dependencias.index'})
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