<template>
    <div>
        <b-modal v-model="modalShow" hide-backdrop title="Mensaje" hide-footer>
            <p>
                Para adquirir un libro contacta a tu proveedor para obtener el código.
            </p>
            <!-- <p>
                Solo tienes 5 días para agregar por lo menos un libro de lo contrario tu cuenta será suspendida.
            </p> -->
        </b-modal>
    </div>
</template>

<script>
export default {
    name: 'AlertComponent',
    props: ['user'],
    
    data () {
        return {
            modalShow: true
        }
    },
    mounted: function(){
        const now = new Date()
        const registro = new Date(this.user.created_at);
        let diferencia = now.getDate() - registro.getDate();
        let dias = (registro.getDate() + diferencia) + now.getDate();

        if(diferencia >= 0 && diferencia < 5){

        }
    }
}
</script>