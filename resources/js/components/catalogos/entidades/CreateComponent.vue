<template>
    <div class="content-wrapper">
        <div class="content-header">
            <h1 class="text-dark">Crear entidad</h1>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <form autocomplete="off" class="shadow-lg p-3 mb-5 bg-white rounded" id="form" v-on:submit.prevent="submit">
                            <a class="text-dark" href="#" title="Regresar a las entidades" v-on:click="$router.go(-1)">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <div class="form-group mt-3">
                                <label for="titulo">Nombre de la entidad</label>
                                <input class="form-control" id="titulo" name="nombre del entidad" type="text" v-model="titulo.name" v-validate="'required'">
                                <div class="invalid-feedback">{{ errors.first('nombre del entidad') }}</div>
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
                titulo: {},
                errors_server: []
            }
        },
        methods: {
            submit() {
                this.$validator.validate().then(isValid => {
                    if(isValid) {
                        axios.post('/api/entidades', this.titulo)
                        .then(response => {
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro correcto',
                                html: response.data
                            })
                            .then(result => {
                                this.$router.push({name: 'entidades.index'})
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