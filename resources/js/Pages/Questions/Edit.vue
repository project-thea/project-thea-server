<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Questions
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">

					<jet-section-title>
						<template #title>
							<strong>Edit Question</strong>
						</template>
					</jet-section-title>

					<form @submit.prevent="updateQuestion">
						<div class="mt-3">
							<jet-label for="title" value="Title" />
							<jet-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
						</div>

                        <div class="mt-3">
                            <jet-label for="datatype_id" value="Data type" />
                            <select name="datatype_id" v-model="form.datatype_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option v-for="dataType in dataTypes" :key="dataType.id" :value="dataType.id">{{ dataType.name }}</option>
                            </select>
                        </div>

                        <div class="mt-3">
							<jet-label  value="Attributes:" class="block text-gray-700 text-sm font-bold mb-2" />
                        </div>

                        <div class="mt-3">
							<jet-label for="format" value="Format" />
							<jet-input id="format" type="text" class="mt-1 block w-full" v-model="form.attributes.format" required autofocus autocomplete="format" />
						</div>

                        <div class="mt-3">
							<jet-label for="default" value="Default" />
							<jet-input id="default" type="text" class="mt-1 block w-full" v-model="form.attributes.default" required autofocus autocomplete="default" />
						</div>

                        <div class="mt-3">
							<jet-label for="required" value="Required" />
							<jet-input id="required" type="text" class="mt-1 block w-full" v-model="form.attributes.required" required autofocus autocomplete="required" />
						</div>

						<div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('questionnaires.edit', { questionnaire: questionnaire})" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Back
                            </inertia-link>
							<jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Edit Question
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
import { Inertia } from '@inertiajs/inertia'

export default {
	metaInfo: { title: 'Questions' },

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
		question: {
			type: Object,
			required: true,
		},

        questionnaire: {
			type: Object,
			required: true,
		},

        dataTypes: {
			type: Array
		},

        attributes: {
            type: Object,
            required: true
        }
	},

	data() {
        const attributes = JSON.parse(this.question.attributes);

		return {
			form: this.$inertia.form({
				title:  this.question.title,
				datatype_id: this.question.datatype_id,
                attributes: attributes,
			}),
		}
	},

	watch: {
	},

	methods: {
		updateQuestion() {
            Inertia.patch('/questionnaires/' + this.questionnaire.id + '/questions/' + this.question.id, {
                errorBag: 'updateQuestion',
				preserveScroll: true,
                title: this.form.title,
                datatype_id: this.form.datatype_id,
                attributes: JSON.stringify(this.form.attributes),

				onError: () => {
					if (this.form.errors.title) {
						this.form.reset('title', this.question.title)
						this.$refs.title.focus()
					}

                    if (this.form.errors.datatype_id) {
						this.form.reset('datatype_id', this.question.datatype_id)
						this.$refs.datatype_id.focus()
					}

                    if (this.form.errors.attributes) {
						this.form.reset('attributes', this.question.attributes)
						this.$refs.attributes.focus()
					}
				}
			});
		}
	},
}
</script>
