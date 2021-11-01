<template>
    <app-layout>
        <div @change="getRadiobuttonResponse" id="v-model-radiobutton">
            <input type="radio" id="one" value="One" v-model="picked" required />
            <label class="mb-2 mt-6 ml-2" for="one">One</label>
            <br />
            <input type="radio" id="two" value="Two" v-model="picked" required />
            <label class="mb-2 mt-6 ml-2" for="two">Two</label>
            <br />
        </div>
    </app-layout>
</template>

<script>
import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'RadioButton Preview' },

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
            picked: '',
        }
    },

    methods: {
        getRadiobuttonResponse(event) {
            this.changeCallback(this.question.questionId, this.question.name, event.target.checked);
        }
    }
}
</script>
