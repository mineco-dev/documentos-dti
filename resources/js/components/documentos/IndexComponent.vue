<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Oficios</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <router-link class="btn btn-primary ml-2 mb-3" :to="{ name: 'reservar.documento', query: {type: 'oficios', title: 'oficio'} }">
                    <i class="fas fa-hand-point-up fa-lg mr-2"></i>
                    Reservar oficio
                </router-link>
                <div class="row row-cols-1 row-cols-md-4">
                    <div class="col mb-4" v-for="post in oficios.data">
                        <div class="card h-100 rounded shadow-sm border-0">
                            <div class="card-body p-4">
                                <h5 class="text-dark text-center">
                                    <b>DTI-{{post.prefix}}-{{post.documento_id}}-{{post.anio}}</b>
                                </h5>
                                <p>
                                    <small class="text-muted">Asunto:</small>
                                    <br>
                                    {{post.asunto}}
                                    <br>
                                    <small class="text-muted">Referencia:</small>
                                    {{post.referencia}}
                                </p>
                            </div>
                            <div class="card-footer">
                                <router-link class="text-muted" :to="{ name: 'user.post.show', params: { id: post.id} }">Más información...</router-link>
                            </div>
                        </div>
                    </div>
                </div>
                <blockquote class="quote-info mt-0" v-if="oficios.total == 0">
                    <h5>No hemos encontrado oficios</h5>
                    <p>
                        Es posible que no tenga los permisos suficientes para visualizar los oficios.
                    </p>
                </blockquote>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                oficios: {data: []}
            }
        },
        mounted() {
            axios.get(`/api/${this.$route.query.type}`).then(response => this.oficios = response.data)
            .catch(error => {
                console.log(error.response)
            })
        }
    }
</script>