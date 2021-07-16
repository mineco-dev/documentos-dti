<template>
    <div class="content-wrapper">
        <div class="content-header">
            <h1 class="text-dark">Crear saludo</h1>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form autocomplete="off" class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <a class="text-dark" href="#" title="Regresar a los saludos" v-on:click="$router.go(-1)">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <div class="form-group mt-3">
                                <label for="saludo">Nombre del saludo</label>
                                <input class="form-control" id="saludo" name="nombre del saludo" type="text" v-model="saludo.name" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('nombre del saludo') }}</div>
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
                                Registrar
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
                saludo: {},
                errors_server: []
            }
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post('/api/saludos', this.saludo)
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro correcto',
                                html: response.data
                            })
                            .then(result => {
                                this.$router.go(-1)
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