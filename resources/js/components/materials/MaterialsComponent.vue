<template>
    <div>
        <div>
            <h3 class="text-center">{{ book.book }}</h3>
            <b-card no-body>
                <b-tabs pills card vertical>
                    <b-tab title="Teacher´s Guide" active>
                        <partial-cards :links="links['id_1']" :size="17"></partial-cards>
                    </b-tab>
                    <b-tab title="Extra Workbook">
                        <partial-cards :links="links['id_2']" :size="17"></partial-cards>
                    </b-tab>
                    <b-tab title="Extra evaluation">
                        <partial-cards :links="links['id_3']" :size="17"></partial-cards>
                    </b-tab>
                    <b-tab title="Tracks Script">
                        <partial-cards :links="links['id_4']" :size="17"></partial-cards>
                    </b-tab>
                    <b-tab title="Tracks">
                        <partial-cards :links="links['id_5']" :size="13"></partial-cards>
                    </b-tab>
                    <b-tab title="Videos">
                        <b-card v-for="(link, i) in links['id_6']" v-bind:key="i"
                            :title="link.name" class="mb-3"
                            style="width: 100%;">
                            <b-embed type="iframe" aspect="16by9"
                                :src="link.link" allowfullscreen>
                            </b-embed>
                        </b-card>
                    </b-tab>
                </b-tabs>
            </b-card>
        </div>
    </div>
</template>

<script>
export default {
    props: ['register', 'registers'],
    data(){
        return {
            book: this.register,
            links: this.registers
        }
    }
}
</script>