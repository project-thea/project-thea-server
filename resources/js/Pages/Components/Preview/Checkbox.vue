<template>
    <app-layout>
        <div>
            <label class="block text-gray-700 text-sm font-bold mb-2 mt-2">Required:
                <jet-input @change="getCheckboxResponse" type="checkbox" id="checkbox" class="mr-2" v-model="checked" aria-required="true" />
            </label>
        </div>
    </app-layout>
</template>

<script>

import JetInput from '@/Jetstream/Input'

export default {
    metaInfo: { title: 'Checkbox Preview' },

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
            checked: false
        }
    },

    methods: {
        getCheckboxResponse(event) {
            this.changeCallback(this.question.questionId, this.question.name, event.target.checked);
        }
    }
}
</script>
