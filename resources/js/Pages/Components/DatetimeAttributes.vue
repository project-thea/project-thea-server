<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-500 text-sm font-bold mb-2">Format: {{ dateTime() }}</label>

    <label class="block text-gray-500 text-sm font-bold mb-2">Required:
    <input type="checkbox" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    <label for="checkbox">{{ checked }}</label>										
    </label>
</template>

<script>
import moment from 'moment'

export default {
    metaInfo: { title: 'Datetime Attributes' },

    components: {
        moment
    },

    props: {

    },

    data() {
        return {
            checked: false
        }
    },

    methods: {
        dateTime(value) {
            return moment(value).format('ddd MMM DD, YYYY [at] HH:mm a');
        }
    }
}
</script>
