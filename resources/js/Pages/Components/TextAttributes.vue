<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-700 text-sm font-bold mb-2">Format</label>
    <select @change="handleLineChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        <option value="singleline">Single line</option>
        <option value="multiline">Multi line</option>
    </select>

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Default</label>
    <input v-if="isSingleLine" type="text" @change="handleDefaultChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" placeholder="Enter text">
    <textarea v-if="!isSingleLine" placeholder="Enter multiple lines of text" @change="handleDefaultChange" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>

    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required:
    <input type="checkbox" @change="handleRequiredChange" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    </label>
</template>

<script>


export default {
    metaInfo: { title: 'Text Attributes' },

    components: {

    },

    props: {
        changeCallback: Function
    },

    data() {
        return {
            isSingleLine: true,
            checked: false,
        }
    },

    methods: {
        handleLineChange(event) {
            this.isSingleLine = event.target.value === 'singleline';

            if (!this.isSingleLine) {
                this.changeCallback("format", event.target.value);
            }

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
