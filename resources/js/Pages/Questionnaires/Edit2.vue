<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Questionnaires
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <jet-section-title>
                        <template #title>
                            <strong>Edit questionnaire</strong>
                        </template>
                    </jet-section-title>
	
                    <form @submit.prevent="updateQuestionnaire">
                        <div class="mt-2">
                            <jet-label for="subject_id" value="Subject Name" />
                            <select name="subject_id" v-model="form.subject_id" :disabled=isDisabled class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.first_name }} {{ subject.last_name }}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <jet-label for="subject_id" value="Unique ID" />
                            <select name="subject_id" v-model="form.subject_id" :disabled=isDisabled class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="subject in subjects" :key="subject.id" :value="subject.id">{{ subject.unique_id }}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <jet-label for="project_id" value="Project" />
                            <select name="project_id" v-model="form.project_id" :disabled=isDisabled class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="project in projects" :key="project.id" :value="project.id">{{ project.name }}</option>
                            </select>
                        </div>
                        <div class="mt-2">
                            <jet-label for="test_date" value="Test Date" />
                            <jet-input id="test_date" type="text" class="mt-1 block w-full" v-model="form.test_date" required autofocus autocomplete="test_date" />
                        </div>
                        <div class="mt-2">
                            <jet-label for="status" value="Test Status" />
                            <select name="status_id" v-model="form.status_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="status in statuses" :key="status.id" :value="status.id">{{ status.title }}</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('questionnaires.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Back
                            </inertia-link>
                            <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Edit Questionnaire
                            </jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetFormSection from '@/Jetstream/FormSection'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetTextarea from '@/Jetstream/Textarea'
import JetSectionTitle from '@/Jetstream/SectionTitle'

export default {
    metaInfo: { title: 'Questionnaires' },

    components: {
        Icon,
        AppLayout,
        JetButton,
        JetInput,
        JetInputError,
        JetLabel,
        JetFormSection,
        JetTextarea,
        JetSectionTitle
    },

    props: {
        questionnaire: {
            type: Object,
            required: true,
        },

        projects: {
            type: Array
        },

        subjects:{
            type: Object,
            required: true
        },
        
        statuses: {
            type: Array
        }
    },

    data() {
        return {
            form: this.$inertia.form({
                subject_id: this.questionnaire.subject_id,
                project_id: this.questionnaire.project_id,
                test_date:  this.questionnaire.test_date,
                status_id:  this.questionnaire.status_id,
            }),
        }
    },

    watch: {
    },

    computed: {
        isDisabled() {
            return true;
        }
    },

    methods: {
        updateQuestionnaire() {
            this.form.patch('/questionnaires/' + this.questionnaire.id, {
                errorBag: 'updateQuestionnaire',
                preserveScroll: true,
                //onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.subject_id) {
                        this.form.reset('subject_id', this.questionnaire.subject_id)
                        this.$refs.subject_id.focus()
                    }

                    if (this.form.errors.project_id) {
                        this.form.reset('project_id', this.questionnaire.project_id)
                        this.$refs.project_id.focus()
                    }

                    if (this.form.errors.test_date) {
                        this.form.reset('test_date', this.questionnaire.test_date)
                        this.$refs.test_date.focus()
                    }

                    if (this.form.errors.status_id) {
                        this.form.reset('status_id', this.questionnaire.status_id)
                        this.$refs.status_id.focus()
                    }
                }
            });
        }
    },
}
</script>
