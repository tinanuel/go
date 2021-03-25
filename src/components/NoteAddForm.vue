<template>
    <form class="m-4" v-on:submit.prevent="addNote()">
		<div class="mb-3">
			<label for="exampleFormControlInput1" class="form-label">Tytuł notatki</label>
			<input type="text" class="form-control" id="exampleFormControlInput1" v-model="newNoteName">
		</div>
		<div class="mb-3">
			<label for="exampleFormControlTextarea1" class="form-label">Treść</label>
			<textarea class="form-control" id="exampleFormControlTextarea1" rows="5" v-model="newNoteContent"></textarea>
		</div>
		<button type="submit" class="btn btn-secondary w-100">
			<i class="bi bi-save"></i>
			Dodaj notatkę
		</button>
	</form>
</template>

<script>
	export default {
		components: {},
		data: function (){
			return {
				newNoteName: null,
				newNoteContent: null,
			}
		},
		methods: {
			addNote: function() {
				var date = (new Date()).toLocaleString("pl-Pl");
				var note = {
					name: this.newNoteName, 
					content: this.newNoteContent,
					createdAt: date,
				};
				this.newNoteName = null;
				this.newNoteContent = null;
				this.$emit("on-add-note", note);
			},
		},
	}
</script>