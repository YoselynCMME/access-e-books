<template>
    <div>
        <!-- AGREGAR LIBRO -->
        <div class="text-right">
            <b-button class="mb-2" variant="primary" @click="newBook()">
                <i class="fa fa-plus"></i> Agregar libro
            </b-button>
        </div>
        <!-- LISTA DE LIBROS -->
        <b-table striped hover responsive :items="books" :fields="fields">
            <template v-slot:cell(actions)="data">
                <b-button variant="warning" @click="editBook(data.item, data.index)">
                    <i class="fa fa-edit text-white"></i>
                </b-button>
                <b-button variant="danger" @click="deleteBook(data.item, data.index)">
                    <i class="fa fa-trash"></i>
                </b-button>
            </template>
            <template v-slot:cell(role_id)="data">
                <label v-if="data.item.role_id === 3">Profesor</label>
                <label v-if="data.item.role_id === 2">Alumno</label>
            </template>
        </b-table>

        <!-- MODAL PARA EDITAR / AGREGAR EL LIBRO -->
        <b-modal ref="modal-edit-book" 
                hide-backdrop hide-footer 
                :title="`${edit ? 'Editar':'Agregar'} libro`">
            <b-form @submit.prevent="edit ? onUpdate():onSave()">
                <b-form-group label="Categoria:">
                    <b-form-select
                        v-model="book.category" :options="categories" required>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Nivel:">
                    <b-form-select
                        v-model="book.level" :options="levels" required>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Codigo:">
                    <b-form-input v-model="book.code" required></b-form-input>
                    <label v-if="errors && errors.code" class="text-danger">{{ errors.code[0] }}</label>
                </b-form-group>
                <b-form-group label="Libro:">
                    <b-form-input v-model="book.book" required></b-form-input>
                    <label v-if="errors && errors.book" class="text-danger">{{ errors.book[0] }}</label>
                </b-form-group>
                <b-form-group label="Usuario:">
                    <b-form-select
                        v-model="book.role_id" :options="roles" required>
                    </b-form-select>
                </b-form-group>
                <b-form-group label="Link lecciones:">
                    <b-form-input v-model="book.link_lessons" required></b-form-input>
                    <label v-if="errors && errors.link_lessons" class="text-danger">{{ errors.link_lessons[0] }}</label>
                </b-form-group>
                <b-form-group label="Link juegos:">
                    <b-form-input v-model="book.link_games" required></b-form-input>
                    <label v-if="errors && errors.link_games" class="text-danger">{{ errors.link_games[0] }}</label>
                </b-form-group>

                <div class="text-right">
                    <b-button type="submit" variant="success">
                        <i class="fa fa-check"></i> {{ edit ? 'Actualizar':'Guardar' }}
                    </b-button>
                </div>
            </b-form>
        </b-modal>

        <!-- MODAL PARA BORRAR EL LIBRO -->
        <b-modal ref="modal-delete-book" hide-backdrop hide-footer :title="`Eliminar ${book.book}`">
            <p><b>¿Estas segura de eliminar {{book.book}}?</b></p>
            <b-button variant="secondary" @click="confirmDelete()">Confirmar</b-button>
        </b-modal>
    </div>
</template>

<script>
export default {
    props: ['registers'],
    data(){
        return {
            books: this.registers,
            fields: [
                { key: 'actions', label: '' },
                { key: 'id', label: 'id' },
                { key: 'category', label: 'Categoria' },
                { key: 'level', label: 'Nivel' },
                { key: 'code', label: 'Codigo' },
                { key: 'book', label: 'Libro' },
                { key: 'role_id', label: 'Usuario' },
                { key: 'slug', label: 'slug' },
                { key: 'link_lessons', label: 'Link lecciones' },
                { key: 'link_games', label: 'Link juegos' }
            ],
            book: {},
            categories: ['english','comun'],
            levels: ['A1','A1+','A2','A2+','B1','B1+','1','2','3'],
            roles: [{ text: 'Profesor', value: 3 }, { text: 'Alumno', value: 2 }],
            load: false,
            position: null,
            edit: false,
            errors: {}
        }
    },
    methods: {
        newBook(){
            this.edit = false;
            this.book = {};
            this.errors = {};
            this.$refs['modal-edit-book'].show()
        },
        editBook(book, position){
            this.edit = true;
            this.book = book;
            this.errors = {};
            this.position = position;
            this.$refs['modal-edit-book'].show()
        },
        onUpdate(){
            this.load = true;
            axios.put('/books/update_book', this.book).then(response => {
                this.books[this.position] = response.data;
                this.load = false;
                this.$refs['modal-edit-book'].hide();
                this.makeToast('Libro actualizado');
            }).catch(error => {
                this.load = false;
                if (error.response.status === 422)
                    this.errors = error.response.data.errors || {};
            });
        },
        onSave(){
            this.load = true;
            axios.post('/books/save_book', this.book).then(response => {
                this.books.push(response.data);
                this.load = false;
                this.$refs['modal-edit-book'].hide();
                this.makeToast('Libro guardado');
            }).catch(error => {
                this.load = false;
                if (error.response.status === 422)
                    this.errors = error.response.data.errors || {};
            });
        },
        deleteBook(book, position){
            this.book = book;
            this.position = position;
            this.$refs['modal-delete-book'].show()
        },
        confirmDelete(){
            axios.get('/books/delete_book', {params: {book_id: this.book.id}}).then(response => {
                this.books.splice(this.position, 1);
                this.load = false;
                this.$refs['modal-delete-book'].hide();
                this.makeToast('Libro eliminado');
            }).catch(error => {
                this.load = false;
            });
        },
        makeToast(message){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: message,
                showConfirmButton: false,
                timer: 2000
            })
        }
    }
}
</script>