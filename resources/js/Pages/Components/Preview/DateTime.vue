<template>
    <app-layout>
        <jet-input @change="getDateTimeResponse" id="label" type="datetime-local" class="mt-1 block w-full" autofocus autocomplete="label" aria-required="true" />
    </app-layout>
</template>


<script>
import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'DateTime Preview' },

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
        getDateTimeResponse(event) {
           this.changeCallback(this.question.questionId, this.question.name, event.target.value);
        }
    }
}
</script>
