<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-700 text-sm font-bold mb-2">Format</label>
    <select @change="handleFormatChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="12hrs">12hrs</option>
        <option value="24hrs">24hrs</option>
    </select>
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Default</label>
    <input type="text" @change="handleDefaultChange" placeholder="Enter time based on the format selected e.g 14:00 or 2:00pm" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required
    <input type="checkbox" @change="handleRequiredChange" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    </label>
</template>

<script>
import moment from 'moment'

export default {
    metaInfo: { title: 'Time Attributes' },

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
        time(value) {
            return moment(value).format('HH:mm a');
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
