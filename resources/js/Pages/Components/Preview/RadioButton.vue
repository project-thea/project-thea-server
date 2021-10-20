<template>
    <app-layout>
        <div id="v-model-radiobutton">
            <input type="radio" id="one" value="One" v-model="picked" />
            <label class="mb-2 mt-6 ml-2" for="one">One</label>
            <br />
            <input type="radio" id="two" value="Two" v-model="picked" />
            <label class="mb-2 mt-6 ml-2" for="two">Two</label>
            <br />
        </div>
    </app-layout>
</template>

<script>


export default {
    metaInfo: { title: 'RadioButton Preview' },

    components: {

    },

    props: {

    },

    data() {
        return {
            picked: '',
        }
    },

    methods: {

    }
}
</script>
