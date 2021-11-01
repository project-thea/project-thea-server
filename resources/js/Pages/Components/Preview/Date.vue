<template>
    <app-layout>
        <jet-input  @change="getDateResponse" id="label" type="date" class="mt-1 block w-full" autofocus autocomplete="label" aria-required="true" />
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
        changeCallback: Function,

        question: {
            type: Object,
            required: true
        }
    },

    data() {
        return {

        }
    },

    methods: {
        getDateResponse(event) {
            this.changeCallback(this.question.questionId, this.question.name, event.target.value);
        }
    }
}
</script>
