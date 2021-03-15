<template>
	<div>
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0 text-dark">{{post.name}}</h1>
					</div>
				</div>
			</div>
		</div>
		<div class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-sm-6">
						<router-link class="text-muted d-block" :to="{ name: 'home' }">
							<i class="fas fa-arrow-left fa-lg"></i>
						</router-link>
						<img v-bind:src="post.file_photo_url" alt="" class="product-image">
					</div>
					<div class="col-12 col-sm-6">
						<h3 class="my-3">{{post.name}}</h3>
						<p v-html="post.body"></p>
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
				post: {}
			}
		},
		mounted() {
			axios.get('/api/posts/'+ this.$route.params.id)
			.then(response => this.post = response.data)
			.catch(error => {
				if(error.response.status == 404) {
					this.$router.push({ name: 'home' })
				} else {
					alert('Error')
				}
				
			})
		}
	}
</script>