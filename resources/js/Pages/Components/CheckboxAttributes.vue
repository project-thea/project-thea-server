<template>
    <label class="block text-gray-700 text-sm font-bold mb-2">Attributes:</label>
    <input type="checkbox" id="jack" value="Jack" v-model="checkedOptions" class="mr-2 mb-1"/>
    <label for="jack" class="mr-2 mb-1">Jack</label>
    <br />
    <input type="checkbox" id="john" value="John" v-model="checkedOptions" class="mr-2 mb-1"/>
    <label for="john" class="mr-2 mb-1">John</label>
    <br />
    <input type="checkbox" id="mike" value="Mike" v-model="checkedOptions" class="mr-2 mb-1"/>
    <label for="mike">Mike</label>
    <br />
    <span>Checked options: {{ checkedOptions }}</span>										
</template>

<script>


export default {
    metaInfo: { title: 'Checkbox Attributes' },

    components: {
        
    },

    props: {

    }, 

    data() {
        return {
            checkedOptions: []
        }
    }
}
</script>
