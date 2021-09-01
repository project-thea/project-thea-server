<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes: Format</label>
    <datepicker v-model="picked" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
    						  												
    <label class="block text-gray-500 text-sm font-bold mb-2 mt-2">Required:
    <input type="checkbox" id="checkbox" v-model="checked" class="mr-2 mb-1" />
    <label for="checkbox">{{ checked }}</label>										
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

    }, 

    data() {
        return {
            picked: new Date(),
            checked: false
        }
    }
}
</script>
