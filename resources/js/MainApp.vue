<template>
	<div>
		<create/>
		<hr>
		<read/>
	</div>
</template>
<script>
import Create from "./components/Create.vue";
import Read from "./components/Read.vue";
	export default{
		name: 'main-app',
		components:{
			Create,Read
		}
	}
</script>
<style>
	
</style>