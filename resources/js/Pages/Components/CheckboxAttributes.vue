<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <label class="block text-gray-700 text-sm font-bold mb-2">Options</label>
    <jet-input type="text"  @change="handleOptionsChange" placeholder="One, Two, Three, Four, Five" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" />
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Default</label>
    <jet-input type="text" @change="handleDefaultChange" placeholder="Enter one or more options" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exampleFormControlInput1" />
    <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required:
    <jet-input type="checkbox" @change="handleRequiredChange" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    </label>
</template>

<script>

import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'Checkbox Attributes' },

    components: {
        JetInput
    },

    props: {
        changeCallback: Function
    },

    data() {
        return {
            checked: false,
        }
    },

    methods: {
        handleOptionsChange(event) {
            const value = event.target.value
            this.changeCallback("options", value.split(', '));
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
