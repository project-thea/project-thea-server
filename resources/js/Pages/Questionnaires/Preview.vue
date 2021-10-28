<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Preview Questionnaire
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="mb-4">
                        <h1 class="questionnaire-title text-3xl">{{ questionnaireData[0].label }}</h1>
                        <hr/>
                    </div>
                    <div class="questionnaire-questions">
                        <div v-for="question in questionnaireData" :key="question.id" class="question mt-3">
                            <div class="question-title text-xl">
                               {{ question.title }}
                            </div>
                            <div class="mb-4 mt-4">
                                <date-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'date'"/>
                            </div>
                            <div class="mb-4">
                                <time-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'time'"/>
                            </div>
                            <div class="mb-4">
                                <date-time-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'datetime'"/>
                            </div>
                            <div class="mb-4">
                                <checkbox-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'checkbox'"/>
                            </div>
                            <div class="mb-4">
                                <radio-button-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'radio button'"/>
                            </div>
                            <div class="mb-4">
                                <text-preview-attribute :question="question" :changeCallback="updateResponse" v-if="question.name === 'text'"/>
                            </div>
                        </div>
                        <div class="flex items-center justify-end mt-4 mb-4">
							<inertia-link :href="route('questionnaires.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Back
                            </inertia-link>
                            <jet-button class="ml-4" @click="submitResponses()">
								Submit
							</jet-button>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import Pagination from '@/Jetstream/Pagination'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import TextPreviewAttribute from '@/Pages/Components/Preview/Text'
import DatePreviewAttribute from '@/Pages/Components/Preview/Date'
import DateTimePreviewAttribute from '@/Pages/Components/Preview/DateTime'
import CheckboxPreviewAttribute from '@/Pages/Components/Preview/Checkbox'
import RadioButtonPreviewAttribute from '@/Pages/Components/Preview/RadioButton'
import TimePreviewAttribute from '@/Pages/Components/Preview/Time'
import { Inertia } from '@inertiajs/inertia'

export default {
	metaInfo: { title: 'Preview Questionnaires' },

	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput,
        TextPreviewAttribute,
        DatePreviewAttribute,
        DateTimePreviewAttribute,
        CheckboxPreviewAttribute,
        RadioButtonPreviewAttribute,
        TimePreviewAttribute
	},

	props: {
        questionnaireData: {
            type: Array,
            required: true
        },

        question: {
            type: Object,
            required: true
        },
	},

    data() {
        return {
            questionResponse: {}
        }
    },

	watch: {
	},

	methods: {
        updateResponse(questionId, dataType, value) {
            this.questionResponse[questionId] = { value, dataType };
		},

        submitResponses() {
            Inertia.post('/questionnaires/' + this.questionnaireData[0].id, {
                questionnaire_id: this.questionnaireData[0].id,
                data: JSON.stringify(this.questionResponse)
            });
        }
	},
}
</script>
