<template>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Detalle de {{ documento.correlativo }}</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{documento.asunto}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">
                                <h4>Destinatario</h4>
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm" src="/images/user-password-icon.png" alt="user image">
                                        <span class="username">
                                            <a href="#">
                                                {{documento.destinatario_saludo}} {{documento.destinatario}}
                                            </a>
                                        </span>
                                        <span class="description">{{documento.destinatario_dependencia}}</span>
                                    </div>
                                    <p>
                                        {{documento.referencia}}
                                    </p>
                                    <p>
                                        <a href="#" class="link-black text-sm" title="Descargar pdf del documento al que se le dió respuesta">
                                            <i class="fas fa-file-pdf fa-2x mr-1"></i>

                                        </a>
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
                                <h3 class="text-primary">
                                    <i class="fas fa-comment-dots"></i>
                                    Contenido
                                </h3>
                                <div class="text-justify" v-html="documento.respuesta"></div>
                                <div class="text-muted">
                                    <p class="text-sm">
                                        Fecha de emisión
                                        <b class="d-block">{{documento.fecha_emision}}</b>
                                    </p>
                                    <p class="text-sm">
                                        Asunto
                                        <b class="d-block">{{documento.asunto}}</b>
                                    </p>
                                </div>
                                <div v-show="documento.file != null">
                                    <h5 class="mt-5 text-muted">Documentos</h5>
                                    <ul class="list-unstyled">
                                        <li>
                                            <a href="" class="btn-link text-secondary">
                                                <i class="far fa-fw fa-file-pdf"></i>
                                                Mostrar el pdf de este documento
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="text-center mt-5 mb-3" v-show="documento.file == null">
                                    <a class="btn btn-sm btn-primary" href="#">
                                        <i class="fas fa-file-alt fa-lg fa-fw"></i>
                                        Generar documento
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                documento: {}
            }
        },
        mounted() {
            axios.get(`/api/documentos/${this.$route.params.id}?type=flat`).then(response => this.documento = response.data)
            .catch(error => alert(error.response))
        }
    }
</script>
