<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-700 text-sm font-bold mb-2">Format</label>
    <select @change="handleFormatChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="dd/mm/yyyy">dd/mm/yyyy</option>
        <option value="dd-mm-yyyy">dd-mm-yyyy</option>
        <option value="yyyy-mm-dd">yyyy-mm-dd</option>
        <option value="yyyy/mm/dd">yyyy/mm/dd</option>
    </select>

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Default</label>
    <input @change="handleDefaultChange" type="date" value="" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" >

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required:
    <input @change="handleRequiredChange" type="checkbox" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    </label>
</template>

<script>

import Datepicker from 'vue3-datepicker'

export default {
    metaInfo: { title: 'Date Attributes' },

    components: {
        Datepicker
    },

    props: {
        inputFormat: {
            type: String,
            required: true
        },

        inputFormat: {
            type: String,
            default: 'dd-mm-yyyy'
        },

        changeCallback: Function
    },

    data() {
        return {
            picked: new Date(),
            checked: false,
            format: "dd/mm/yyyy"
        }
    },

    methods: {
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
