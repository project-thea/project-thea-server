<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tests
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <jet-section-title>
                        <template #title>
                            <strong>Edit Test</strong>
                        </template>
                    </jet-section-title>
	
                    <form @submit.prevent="updateTest">
                        <div class="mt-2">
                            <jet-label for="test_date" value="Test Date" />
                            <jet-input id="test_date" type="text" class="mt-1 block w-full" v-model="form.test_date" required autofocus autocomplete="test_date" />
                        </div>

                        <div class="mt-2">
                            <jet-label for="status" value="Test Status" />
                            <select name="status" v-model="form.status" required autofocus autocomplete="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option value="Unknown">Unknown</option>
                                <option value="Negative">Negative</option>
                                <option value="Positive">Positive</option>
                            </select>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('tests')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    Back
                            </inertia-link>
                            <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Edit Test
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
    metaInfo: { title: 'Tests' },
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
        test: {
            type: Object,
            required: true,
        },
    },
    data() {
        return {
            form: this.$inertia.form({
                test_date:  this.test.test_date,
                status:  this.test.status,
            }),
        }
    },
    watch: {
    },
    methods: {
        updateTest() {
            this.form.patch('/tests/' + this.test.id, {
                errorBag: 'updateTest',
                preserveScroll: true,
                //onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.test_date) {
                        this.form.reset('test_date', this.test.test_date)
                        this.$refs.test_date.focus()
                    }

                    if (this.form.errors.status) {
                        this.form.reset('status', this.test.status)
                        this.$refs.status.focus()
                    }
                }
            });
        }
    },
}
</script>
