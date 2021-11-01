<template>
    <app-layout>
        <div class="mt-3">
            <jet-input @change="getTimeResponse" id="label" type="time" class="mt-1 block w-full" autofocus autocomplete="label" />
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
        getTimeResponse(event) {
            this.changeCallback(this.question.questionId, this.question.name, event.target.value);
        }
    }
}
</script>

