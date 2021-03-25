<template>
	<div class="p-4">
		<div class="my-2 p-2 bg-secondary text-center text-white">
			<i class="bi-sticky"></i> {{note.name}}
		</div>
		<div class="p-5 border border-1 rounded-0 text-center overflow-auto">
			{{note.content}}
		</div>
	</div>
</template>

<script>	
	export default {
		components: {},
		props: ['note'],
		data: function (){
			return {}
		},
		methods: {},
	}
</script>