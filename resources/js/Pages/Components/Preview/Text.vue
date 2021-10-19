<template>
    <app-layout>
        <label for="checkbox">(Type = text)</label>
        <div class="mt-3">
            <jet-input id="label" type="text" class="mt-1 block w-full" autofocus autocomplete="label" />
        </div>
    </app-layout>
</template>

<script>
import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'Text Preview' },

    components: {
        JetInput,
    },

    props: {

    },

    data() {
        return {
            checked: false,
        }
    },

    methods: {

    }
}
</script>
