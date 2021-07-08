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
										Unique ID
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
											{{ test.unique_id }}
											<icon v-if="test.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>
										</inertia-link>
									</td>

									<td class="border-t">
										<inertia-link :href="'/tests/' + test.id + '/edit'" tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ test.name }}
											<icon v-if="test.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link :href="'/tests/' + test.id + '/edit'" tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center">
											{{ test.status }}
										</inertia-link>
									</td>
									<td class="border-t" v-if="$page.props.loggedInUser.can.isAdmin">
										<inertia-link @click="deleteTest(test.id)" :href="'/tests/' + test.id + '/trash'" tabindex="-1" aria-label="Trash" title="Trash" class="px-6 py-4 flex items-center">
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
					<pagination class="mt-2" :links="tests.links" />
                </div>
            </div>
        </div>

		<!-- Trashed Tests -->
		<div class="py-12" v-if="$page.props.loggedInUser.can.isAdmin">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
				
					<div class="mb-4 w-full ">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							Test Trash
						</h2>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">
										Test Date 
									</th>
									<th class="px-6 pt-6 pb-4">
										Unique ID
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
								<tr v-for="test in trashedTests.data" :key="test.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
									<td class="border-t">
										<inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ formatDate(test.created_at) }}
										</inertia-link>
									</td>
									
									<td class="border-t">
										<inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ test.unique_id }}
										</inertia-link>
									</td>

									<td class="border-t">
										<inertia-link tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ test.name }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link tabindex="-1" aria-label="Edit" class="px-6 py-4 flex items-center">
											{{ test.status }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link @click="restoreTest(test.id)" :href="'/tests/' + test.id + '/restore'" tabindex="-1" aria-label="Restore" title="Restore" class="px-6 py-4 flex items-center">
											<icon name="restore" class="block w-4 h-4 fill-gray-500"/>
										</inertia-link>
									</td>
								</tr>
								<tr v-if="trashedTests.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No test trash found.
									</td>
								</tr>
							</tbody>
					  </table>
					</div>
					<pagination class="mt-2" :links="trashedTests.links" />
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
	
	props: {
		tests: {
			type: Object,
			required: true,
		},
		filters: {
			type: Object,
			required: true
		},
		trashedTests: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
			search: 'dd', //this.filters.search
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
		deleteTest(id) {
			Inertia.delete('/tests/' + id + '/trash');
		},
		restoreTest(id) {
			Inertia.put('/tests/' + id + '/restore');
		}
	},
}
</script>
