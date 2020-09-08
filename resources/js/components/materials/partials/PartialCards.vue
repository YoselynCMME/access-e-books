<template>
    <div>
        <b-row>
            <b-col v-for="(link, i) in links" v-bind:key="i">
                <b-card
                    :title="link.name"
                    :img-src="link.image"
                    :img-alt="link.name" img-top tag="article"
                    :style="`width: ${size}rem;`"
                    border-variant="light">
                    <b-button v-if="link.categorie_id !== 5"
                        :href="`https://www.dropbox.com/s/${link.link}?dl=0`" 
                        pill variant="info">
                        <i class="fa fa-eye"></i> View
                    </b-button>
                    <audio v-else :title="link.name" controls="true ">
                        <source :src="`https://dl.dropbox.com/s/${link.link}`">
                    </audio>
                    <b-button :href="`https://www.dropbox.com/s/${link.link}?dl=1`" pill variant="info">
                        <i class="fa fa-download"></i> Download
                    </b-button>
                </b-card>
            </b-col>
        </b-row>
    </div>
</template>

<script>
export default {
    props: ['links', 'size']
}
</script>