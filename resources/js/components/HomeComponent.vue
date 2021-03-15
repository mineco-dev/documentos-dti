<template>
    <div>
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Página de inicio</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="content">
            <div class="container-fluid">
                <div class="row row-cols-1 row-cols-md-4">
                    <div class="col mb-4" v-for="post in posts.data">
                        <div class="card h-100 rounded shadow-sm border-0">
                            <div class="card-body p-4">
                                <h5 class="text-dark">
                                    <b>{{post.name}}</b>
                                </h5>
                                <p class="small text-muted">{{post.excerpt}}</p>
                            </div>
                            <div class="card-footer">
                                <router-link class="text-muted" :to="{ name: 'user.post.show', params: { id: post.id} }">Más información...</router-link>
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
                posts: {data: []}
            }
        },
        computed: {
            countPost() {
                return this.posts.data.length
            }
        },
        mounted() {
            axios.get('/posts?formatResponse=json').then(response => this.posts = response.data)
            .catch(error => alert(error.response))
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