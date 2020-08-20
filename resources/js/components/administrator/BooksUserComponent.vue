<template>
    <div>
        <b-table striped hover responsive :items="user.books" :fields="fieldsBooks">
            <template v-slot:cell(index)="data">
                {{ data.index + 1 }}
            </template>
            <template v-slot:cell(delete)="data">
                <b-button pill variant="danger" @click="deleteBook(data.item, data.index)">
                    <i class="fa fa-minus"></i>
                </b-button>
            </template>
        </b-table>
    </div>
</template>

<script>
export default {
    props: ['user'],
    data(){
        return {
            fieldsBooks: [
                { key: 'index', label: '#' },
                { key: 'book', label: 'Libro' },
                { key: 'delete', label: 'Eliminar' }
            ],
            load: false
        }
    },
    methods: {
        deleteBook(book, position){
            this.load = true;
            axios.get('/users/delete_book', {params: {book_id: book.id, user_id: this.user.id}}).then(response => {
                this.user.books.splice(position, 1);
                this.load = false;
            }).catch(error => {
                this.load = false;
            });
        }
    }
}
</script>