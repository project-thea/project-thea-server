<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-700 text-sm font-bold mb-2">Format</label>
    <input type="text" @change="handleFormatChange" placeholder="yyyy-mm-dd H:i:s" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Default</label>
    <input type="text" @change="handleDefaultChange" placeholder="Enter datetime e.g 2021-08-31 09:54:04" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required:
    <input type="checkbox" @change="handleRequiredChange" id="checkbox" v-model="checked" class="mr-2 mb-1" />
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
        changeCallback: Function
    },

    data() {
        return {
            checked: false
        }
    },

    methods: {
        dateTime(value) {
            return moment(value).format('ddd MMM DD, YYYY [at] HH:mm a');
        },

        handleFormatChange(event) {
            this.changeCallback("format", event.target.value);
        },

        handleDefaultChange(event) {
            this.changeCallback("default", event.target.value);
        },

        handleRequiredChange(event) {
            const value = event.target.checked;
            this.changeCallback("required", value);
        },
    }
}
</script>
