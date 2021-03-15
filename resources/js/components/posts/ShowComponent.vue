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
						<img v-bind:src="post.file_photo_url" alt="" class="product-image">
					</div>
				</div>
				<pre>{{post}}</pre>
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
		}
		mounted() {
			axios.get('/api/posts/'+ this.$route.params.id)
			.then(response => this.post = response.data)
			.catch(error => {
				alert(error.response.message)
			})
		}
	}
</script>