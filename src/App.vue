<template>
    <div class="container-fluid p-0 m-0 vh-100">
        <div class="row p-0 m-0 h-100">
            <div class="col-12 col-md-5 col-lg-4 bg-light p-0 h-100">
                <h3 class="w-100 text-center p-4">
                    <i class="bi bi-clipboard-check text-secondary"></i>
                    GoNote
                </h3>
                <button type="button" class="btn btn-dark w-100 py-2 rounded-0" v-on:click="showAddForm()">
                    <i class="bi bi-pen-fill"></i>
                    Stwórz nową notatkę
                </button>
                <div v-if="notes.length == 0" class="alert alert-secondary m-3 text-center">
                    <i class="bi bi-emoji-frown"></i>
                    Jeszcze nie ma żadnych notatek do wyświetlenia
                </div>
                <notes-list v-else v-bind:notes="notes" v-on:onShowNote="showNote($event)" v-on:onDeleteNote="deleteNote($event)" />
            </div>
            <div class="col-12 col-md-7 col-lg-8 bg-white p-0">
                <div class="cover d-none d-sm-block"></div>
				<note v-if="currentNote != null" v-bind:note="currentNote" />
                <note-add-form v-else v-on:onAddNote="addNote($event)" />
            </div>
        </div>
    </div>
    <nav class="navbar fixed-bottom navbar-dark bg-dark">
        <div class="container-fluid justify-content-end p-2">
            <span class="text-muted mx-5 d-none d-md-block">
                ©2021 Polityka prywatności | Warunki korzystania z usługi
            </span>
            <span class="text-light">
                <i class="bi bi-heart-fill"></i>
                Moje konto
            </span>
        </div>
    </nav>
</template>

<script>
	import NoteAddForm from "./components/NoteAddForm.vue";
	import NotesList from "./components/NotesList.vue";
	import Note from "./components/Note.vue";
	
	export default {
		components: {NoteAddForm, NotesList, Note},
		data: function (){
			return {
				notes: [],
				currentNote: null,
			}
		},
		methods: {
			addNote: function(note) {
				this.notes.push(note);
			},
			showNote: function(note) {
				this.currentNote = note;
			},
			showAddForm: function(){
				this.currentNote = null;
			},
			deleteNote: function(note) {
				this.notes = this.notes.filter((n) => n !== note);
			}
		},
	}
</script>

<style>
.cover {
    background-image: url("./assets/background.jpg");
    background-position: center;
    background-size: cover;
    min-height: 150px;
}
</style>
