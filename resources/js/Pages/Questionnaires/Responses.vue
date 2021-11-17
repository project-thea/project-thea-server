<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Questionnaire
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-4">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-section-title class="mt-4">
								<template #title>
									<strong>Question Responses</strong>
								</template>
							</jet-section-title>
						</div>
					</div>
					<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
							<thead class="bg-gray-50">
								<tr>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Question 1
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Question 2
									</th>
									<th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Question 3
									</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
										Question 4
									</th>
									<th scope="col" width="100" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
										Question 5
									</th>
                                    <th scope="col" width="100" class="px-6 py-3 text-xs font-medium text-gray-500 uppercase">
										Question 6
									</th>
								</tr>
							</thead>
                            <tbody class="bg-white divide-y divide-gray-200">
								<tr v-for="response in responses" :key="response.id">
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ response.Question1 }}
												</div>
											</div>
										</div>
									</td>
									<td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ response.Question2 }}
												</div>
											</div>
										</div>
									</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
										<div class="flex items-center">
											<div>
												<div class="text-sm font-medium text-gray-900">
													{{ response.Question3 }}
												</div>
											</div>
										</div>
									</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ response.Question4 }}
                                                </div>
                                            </div>
                                        </div>
									</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ response.Question5 }}
                                                </div>
                                            </div>
                                        </div>
									</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ response.Question6 }}
                                                </div>
                                            </div>
                                        </div>
									</td>
                                </tr>
                            </tbody>
                        </table>
					</div>
                    <div class="flex items-center justify-end mt-4 mb-4">
                        <inertia-link :href="route('questionnaires.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                            Back
                        </inertia-link>
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

import JetSectionTitle from '@/Jetstream/SectionTitle'
import TextPreviewAttribute from '@/Pages/Components/Preview/Text'
import DatePreviewAttribute from '@/Pages/Components/Preview/Date'
import DateTimePreviewAttribute from '@/Pages/Components/Preview/DateTime'
import CheckboxPreviewAttribute from '@/Pages/Components/Preview/Checkbox'
import RadioButtonPreviewAttribute from '@/Pages/Components/Preview/RadioButton'
import TimePreviewAttribute from '@/Pages/Components/Preview/Time'
import { Inertia } from '@inertiajs/inertia'

export default {
	metaInfo: { title: 'Questionnaires Responses' },

	components: {
		Icon,
        Inertia,
		Pagination,
		AppLayout,
        JetSectionTitle,
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
        responses: {
			type: Object,
			required: true
		},
	},

    data() {
        return {

        }
    },

	watch: {
	},

	methods: {

	},
}
</script>
