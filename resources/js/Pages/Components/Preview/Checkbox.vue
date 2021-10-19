<template>
    <app-layout>
        <label for="checkbox">(Type = checkbox)</label>
        <div>
            <input type="checkbox" id="checkbox" class="mr-2" v-model="checked" />
        </div>
    </app-layout>
</template>

<script>


export default {
    metaInfo: { title: 'Checkbox Preview' },

    components: {

    },

    props: {

    },

    data() {
        return {
            checked: false,
        }
    },

    methods: {

    }
}
</script>
