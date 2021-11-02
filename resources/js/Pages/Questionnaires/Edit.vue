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
							<strong>Manage Questionnaire</strong>
						</template>
					</jet-section-title>

					<form @submit.prevent="updateQuestionnaire">
						<div class="mt-3">
							<jet-label for="label" value="Name" />
							<jet-input id="label" type="text" class="mt-1 block w-full" v-model="form.label" required autofocus autocomplete="label" />
						</div>

						<div class="mt-3">
							<jet-label for="description" value="Description" />
							<jet-textarea id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
						</div>

						<div class="flex items-center justify-end mt-4 mb-4">
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

			<!-- Questions -->
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-section-title class="mt-4">
								<template #title>
									<strong>Manage Questions</strong>
								</template>
							</jet-section-title>
							<div class="flex items-center justify-end mt-4">
								<jet-button  @click="openModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded mb-8">
									Add Question
								</jet-button>
							</div>
						</div>
					</div>

					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										No.
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Title
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Type
									</th>
									<th scope="col" width="150" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="question in questions.data" :key="question.id">
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ question.id }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ question.title }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm text-gray-900">{{ question.name }}</div>
									</td>

									<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
										<inertia-link @click="archiveQuestion(question.id)" :href="'/questionnaires/' + questionnaire.id + '/questions/' + question.id + '/trash'" class="mr-2 text-red-600 hover:text-red-900">
											Archive
										</inertia-link>

										<inertia-link @click="editQuestion(question.id)" :href="'/questionnaires/' + questionnaire.id + '/questions/' + question.id + '/edit'" class="mr-2 text-blue-600 hover:text-blue-900">
											Edit
										</inertia-link>
									</td>
								</tr>
                                <tr v-if="questions.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No questions found.
									</td>
								</tr>
							</tbody>
						</table>

						<!-- Modal -->
						<div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
							<div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

								<div class="fixed inset-0 transition-opacity">
									<div class="absolute inset-0 bg-gray-500 opacity-75"></div>
								</div>

								<span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
								<div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
									<form @submit.prevent="addQuestion">
										<div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
											<div class="">
												<div class="mb-4">
													<label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
													<jet-input type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="title" placeholder="Enter Question Title" v-model="questionTitle"/>
												</div>
												<div class="mb-4">
													<label for="datatype_id" class="block text-gray-700 text-sm font-bold mb-2">Type:</label>
													<select @change="handleTypeChange" name="datatype_id" id="datatype_id" v-model="form.datatype_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
														<option v-for="datatype in datatypes" :key="datatype.id" :value="datatype.id">{{ datatype.name }}</option>
													</select>
												</div>
												<div class="mb-4">
													<date-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 1"/>
												</div>
												<div class="mb-4">
													<time-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 2"/>
												</div>
												<div class="mb-4">
													<datetime-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 3"/>
												</div>
												<div class="mb-4">
													<checkbox-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 4"/>
												</div>
												<div class="mb-4">
													<radiobutton-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 5"/>
												</div>
												<div class="mb-4">
													<text-type-attribute :changeCallback="updateAttributes" v-if="form.datatype_id === 6"/>
												</div>
											</div>
										</div>
										<div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
											<span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
												<button wire:click.prevent="store()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" v-show="!editMode" @click="saveQuestion(form)">
													Save
												</button>
											</span>
											<span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
												<button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
													Cancel
												</button>
											</span>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
                    <pagination class="mt-2" :links="questions.links" />
                </div>
            </div>
            <!-- Questions Trash -->
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-section-title class="mt-4">
								<template #title>
									<strong>Questions Trash</strong>
								</template>
							</jet-section-title>
						</div>
					</div>

					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
						<table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										No.
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Title
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Type
									</th>
									<th scope="col" width="150" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
										Actions
									</th>
								</tr>
							</thead>
							<tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="question in trashedQuestions.data" :key="question.id">
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ question.id }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ question.title }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="text-sm text-gray-900">{{ question.name }}</div>
									</td>

									<td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
										<inertia-link @click="restoreQuestion(question.id)" :href="'/questionnaires/' + questionnaire.id + '/questions/' + question.id + '/restore'" class="mr-6 text-green-600 hover:text-green-900">
											Restore
										</inertia-link>
									</td>
								</tr>
                                <tr v-if="trashedQuestions.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No question trash found.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                    <pagination class="mt-2" :links="trashedQuestions.links" />
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
import JetFormSection from '@/Jetstream/FormSection'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetTextarea from '@/Jetstream/Textarea'
import JetSectionTitle from '@/Jetstream/SectionTitle'
import { Inertia } from '@inertiajs/inertia'
import DateTypeAttribute from '@/Pages/Components/DateAttributes'
import TimeTypeAttribute from '@/Pages/Components/TimeAttributes'
import TextTypeAttribute from '@/Pages/Components/TextAttributes'
import CheckboxTypeAttribute from '@/Pages/Components/CheckboxAttributes'
import RadiobuttonTypeAttribute from '@/Pages/Components/RadiobuttonAttributes'
import DatetimeTypeAttribute from '@/Pages/Components/DatetimeAttributes'

export default {
	metaInfo: { title: 'Questionnaires' },

	components: {
		Icon,
		AppLayout,
        Pagination,
		JetButton,
		JetInput,
		JetInputError,
		JetLabel,
		JetFormSection,
		JetTextarea,
		JetSectionTitle,
		DateTypeAttribute,
		TimeTypeAttribute,
		TextTypeAttribute,
		CheckboxTypeAttribute,
		RadiobuttonTypeAttribute,
		DatetimeTypeAttribute
	},

	props: {
		questionnaire: {
			type: Object,
			required: true,
		},

		questions: {
			type: Object,
			required: true
		},

		datatypes: {
			type: Object,
			required: true
		},

        trashedQuestions: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			form: this.$inertia.form({
				label:  this.questionnaire.label,
				description: this.questionnaire.description,
				datatype_id: this.questions.datatype_id,
			}),
			editMode: false,
			isOpen: false,
			datatype: "",
			questionTitle: "",
			questionType: "",
			questionAttributes: {}
		}
	},

	watch: {
	},

	methods: {
		updateQuestionnaire() {
			this.form.patch('/questionnaires/' + this.questionnaire.id, {
				errorBag: 'updateQuestionnaire',
				preserveScroll: true,
				onError: () => {
					if (this.form.errors.label) {
						this.form.reset('label', this.questionnaire.label)
						this.$refs.label.focus()
					}

					if (this.form.errors.description) {
						this.form.reset('description', this.questionnaire.description)
						this.$refs.description.focus()
					}
				}
			});
		},

		addQuestion(){
			this.addQuestionForm.post('/questionnaires/'+ this.questionnaire.id +'/questions');
		},

		openModal() {
			this.isOpen = true;
		},

		closeModal() {
			this.isOpen = false;
			this.editMode = false;
		},

		reset() {
			this.form = {
				title: null,
				attributes: null,
			}
		},

		saveQuestion() {
			Inertia.post('/questionnaires/' + this.questionnaire.id + '/questions', {
				title: this.questionTitle,
				datatype_id: this.questionType,
				attributes: JSON.stringify(this.questionAttributes)
			});

			this.reset();
			this.closeModal();
			this.editMode = false;
		},

        editQuestion(question) {
            Inertia.get('/questionnaires/' + this.questionnaire.id + '/questions/' + question + '/edit');
        },

        restoreQuestion(question) {
			Inertia.put('/questionnaires/' + this.questionnaire.id + '/questions/' + question + '/restore');
		},

		archiveQuestion(question) {
			Inertia.delete('/questionnaires/' + this.questionnaire.id + '/questions/' + question + '/trash');
        },

        handleTypeChange() {
			this.datatype = this.datatypes[this.form.datatype_id];
			this.questionType = this.form.datatype_id;
        },

		updateAttributes(name, value) {
			this.questionAttributes[name] = value;
		}
	},
}
</script>
