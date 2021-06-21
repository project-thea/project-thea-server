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
				
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-input id="filter" type="text" class="block" required autofocus placeholder="Search..." v-on:update:modelValue="handleSearchChange" :modelValue="this.filters.search"/>
							
							<jet-button class="float-left bg-grey-400" @click="createTest()">
								Add Test
							</jet-button>
						</div>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
					  <table class="w-full whitespace-nowrap">
						<thead>
						  <tr class="text-left font-bold">
							<th class="px-6 pt-6 pb-4">
							  Test Date 
							</th>
							<th class="px-6 pt-6 pb-4">
							  User ID
							</th>
							<th class="px-6 pt-6 pb-4">
							  Disease
							</th>
							<th class="px-3 pt-3 pb-2">
							  Status
							</th>
							<th
							  class="px-3 pt-3 pb-2"
							  colspan="2"
							>
							  Actions
							</th>
						  </tr>
						</thead>
						<tbody>
						  	<tr v-for="test in tests.data" :key="test.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
								<td class="border-t">
									<inertia-link :href="'/tests/' + test.id + '/edit'" class="px-6 py-4 flex items-center focus:text-indigo-500">
										{{ formatDate(test.created_at) }}
										<icon v-if="test.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>
									</inertia-link>
								</td>
								
								<td class="border-t">
									<inertia-link :href="'/tests/' + test.id + '/edit'" class="px-6 py-4 flex items-center focus:text-indigo-500">
										{{ test.id }}ESDVCFGRTUI34EUI
										<icon v-if="test.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>
									</inertia-link>
								</td>

								<td class="border-t">
									<inertia-link :href="'/tests/' + test.id + '/edit'" tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center focus:text-indigo-500">
										{{ test.description }} COVID-19
										<icon v-if="test.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>
									</inertia-link>
								</td>
								<td class="border-t">
									<inertia-link :href="'/tests/' + test.id + '/edit'" tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center">
										{{ test.description }} NEGATIVE
									</inertia-link>
								</td>
								<td class="border-t">
									<inertia-link :href="'/tests/' + test.id + '/trash'" tabindex="-1" aria-label="Trash" title="Trash" class="px-6 py-4 flex items-center">
										<icon name="trash" class="block w-4 h-4 fill-gray-500"/>
									</inertia-link>
								</td>
								<td class="border-t w-px">
									<inertia-link :href="'/tests/' + test.id + '/edit'" tabindex="-1" aria-label="Edit" class="px-4 flex items-center">
										<icon name="cheveron-right" class="block w-6 h-6 fill-gray-500"/>	
									</inertia-link>
								</td>
						  	</tr>
							<tr v-if="tests.data.length === 0">
								<td class="border-t px-6 py-4" colspan="4">
									No test found.
								</td>
							</tr>
						</tbody>
					  </table>
					</div>
				
					<!--
					<pagination :meta="tests.meta" />
					-->

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import Pagination from '@/Shared/Pagination'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import { Inertia } from '@inertiajs/inertia'
import { DateTime } from 'luxon';

export default {
	metaInfo: { title: 'Tests' },
	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput
	},
	//layout: Layout,
	props: {
		tests: {
			type: Object,
			required: true,
		},
		filters: {
			type: Object,
			required: true
		},
	},
	data() {
		return {
			search: 'dd' //this.filters.search
		}
	},
	watch: {
	},
	methods: {
		handleSearchChange: function (value) {
			Inertia.get('/tests?search=' + value)
		},
		formatDate(dateTime) {
			return DateTime.fromISO(dateTime).toFormat('yyyy-LL-dd HH:mm');
		}, 
		createTest() {
			Inertia.get('/tests/create')
		},
	},
}
</script>
