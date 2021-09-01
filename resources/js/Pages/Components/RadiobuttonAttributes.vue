<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <input type="radio" id="one" value="One" v-model="picked" class="mr-2 mb-1"/>
    <label for="one">One</label>
    <br />
    <input type="radio" id="two" value="Two" v-model="picked" class="mr-2 mb-1"/>
    <label for="two">Two</label>
    <br />
    <span>Picked: {{ picked }}</span>										
</template>

<script>


export default {
    metaInfo: { title: 'Radiobutton Attributes' },

    components: {
        
    },

    props: {

    }, 

    data() {
        return {
            picked: ''
        }
    }
}
</script>
