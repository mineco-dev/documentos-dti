<template>
    <div>
        <section class="content-header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <blockquote class="quote-success mx-0 p-3">
                    <h4>Documentos emitidos durante el año 2021</h4>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3" v-for="actual in actuales">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-text">{{ actual.tipo_documento }}</span>
                                    <span class="info-box-number h2">
                                        {{ actual.total }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </blockquote>
                <blockquote class="quote-danger mx-0 p-3">
                    <h4>Documentos pendientes de adjuntar el pdf firmado por el Director</h4>
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-3" v-for="pendiente in pendientes">
                            <div class="info-box">
                                <div class="info-box-content text-center">
                                    <span class="info-box-text">{{ pendiente.tipo_documento }}</span>
                                    <span class="info-box-number h3">
                                        {{ pendiente.total }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </blockquote>
            </div>
        </section>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                pendientes: [],
                actuales: []
            }
        },
        mounted() {
            Promise.all([
                axios.get('/api/estadistica/conteo', {
                    params: {
                        column: 'estado_documento_id',
                        value: 1,

                    }
                }),
                axios.get('/api/estadistica/conteo', {
                    params: {
                        column: 'anio',
                        value: 'date("Y")'

                    }
                }),
                ])
            .then(response => {
                this.pendientes = response[0].data
                this.actuales = response[1].data
            })
            .catch(error => {})
        }
    }
</script>

<style>
.social-link {
    width: 30px;
    height: 30px;
    border: 1px solid #ddd;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666;
    border-radius: 50%;
    transition: all 0.3s;
    font-size: 0.9rem;
}

.social-link:hover, .social-link:focus {
    background: #ddd;
    text-decoration: none;
    color: #555;
}

.progress {
    height: 10px;
}
</style>