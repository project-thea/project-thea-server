<template>
    <app-layout>
        <div class="mt-3">
            <jet-input @change="getTextResponse" placeholder="Enter text" id="label" type="text" class="mt-1 block w-full" autofocus autocomplete="label" required />
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
        changeCallback: Function,

        question: {
            type: Object,
            required: true
        }
    },

    data() {
        return {
            checked: false,
        }
    },

    methods: {
        getTextResponse(event) {
            this.changeCallback(this.question.questionId, this.question.name, event.target.value);
        }
    }
}
</script>
