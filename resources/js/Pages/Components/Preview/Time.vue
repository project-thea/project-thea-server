<template>
    <app-layout>
        <div class="mt-3">
            <jet-input id="label" type="time" class="mt-1 block w-full" autofocus autocomplete="label" />
        </div>
    </app-layout>
</template>

<script>
import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'Time Preview' },

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

