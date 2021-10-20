<template>
    <app-layout>
        <jet-input id="label" type="date" class="mt-1 block w-full" autofocus autocomplete="label" />
    </app-layout>
</template>


<script>
import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'Date Preview' },

    components: {
        JetInput
    },

    props: {

    },

    data() {
        return {

        }
    },

    methods: {

    }
}
</script>
