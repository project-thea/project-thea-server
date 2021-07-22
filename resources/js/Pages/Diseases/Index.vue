<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Diseases
            </h2>
        </template>

        <div class="py-12">	
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<div class="flex justify-between">
							<jet-input id="filter" type="text" class="block" required autofocus placeholder="Search..." v-on:update:modelValue="handleSearchChange" :modelValue="this.filters.search"/>
							
							<jet-button v-if="$page.props.loggedInUser.can.isAdmin" class="float-left bg-grey-400" @click="createDisease()">
								Add Disease
							</jet-button>
						</div>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">Name</th>
									<th class="px-6 pt-6 pb-4">Description</th>
									<th class="px-6 pt-6 pb-4" colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="disease in diseases.data" :key="disease.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
									<td class="border-t">
										<inertia-link :href="'/diseases/' + disease.id + '/edit'" class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ disease.name }}
											<icon v-if="disease.deleted_at" name="trash" class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"/>	
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link :href="'/diseases/' + disease.id + '/edit'" tabindex="-1" aria-label="Edit"
											class="px-6 py-4 flex items-center truncate">
											{{ disease.description }}
										</inertia-link>
									</td>
									<td class="border-t" v-if="$page.props.loggedInUser.can.isAdmin">
										<inertia-link @click="deleteDisease(disease.id)" :href="'/diseases/' + disease.id + '/trash'" method="delete" tabindex="-1" aria-label="Trash"
											title="Trash" class="px-6 py-4 flex items-center">
											<icon name="trash" class="block w-4 h-4 fill-gray-500"/>	
										</inertia-link>
									</td>
									<td class="border-t w-px">
										<inertia-link :href="'/diseases/' + disease.id + '/edit'" title="Edit" tabindex="-1"
											aria-label="Edit" class="px-4 flex items-center"> 
											<icon name="cheveron-right" class="block w-6 h-6 fill-gray-500"/>
										</inertia-link>
									</td>
								</tr>
								<tr v-if="diseases.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No disease found.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pagination class="mt-2" :links="diseases.links" />
                </div>
            </div>
        </div>

		<!-- Trashed Diseases -->
		<div class="py-12" v-if="$page.props.loggedInUser.can.isAdmin">	
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<div class="mb-4 w-full ">
						<h2 class="font-semibold text-xl text-gray-800 leading-tight">
							Disease Trash
						</h2>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
						<table class="w-full whitespace-nowrap">
							<thead>
								<tr class="text-left font-bold">
									<th class="px-6 pt-6 pb-4">Name</th>
									<th class="px-6 pt-6 pb-4">Description</th>
									<th class="px-6 pt-6 pb-4" colspan="2">Actions</th>
								</tr>
							</thead>
							<tbody>
								<tr v-for="disease in trashedDiseases.data" :key="disease.id" class="hover:bg-gray-100 focus-within:bg-gray-100">
									<td class="border-t">
										<inertia-link class="px-6 py-4 flex items-center focus:text-indigo-500">
											{{ disease.name }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link tabindex="-1" aria-label="Edit"
											class="px-6 py-4 flex items-center truncate">
											{{ disease.description }}
										</inertia-link>
									</td>
									<td class="border-t">
										<inertia-link @click="restoreDisease(disease.id)" :href="'/diseases/' + disease.id + '/restore'" method="restore" tabindex="-1" aria-label="Restore"
											title="Restore" class="px-6 py-4 flex items-center">
											<icon name="restore" class="block w-4 h-4 fill-gray-500"/>	
										</inertia-link>
									</td>
								</tr>
								<tr v-if="trashedDiseases.data.length === 0">
									<td class="border-t px-6 py-4" colspan="4">
										No disease trash found.
									</td>
								</tr>
							</tbody>
						</table>
					</div>
					<pagination class="mt-2" :links="trashedDiseases.links" />
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
import JetNavLink from '@/Jetstream/NavLink';

export default {
	metaInfo: { title: 'Diseases' },

	components: {
		Icon,
		Pagination,
		AppLayout,
		JetButton,
		JetInput,
		JetNavLink
	},

	props: {
		diseases: {
			type: Object,
			required: true,
		},
		filters: {
			type: Object,
			required: true
		},
		trashedDiseases: {
			type: Object,
			required: true
		}
	},

	data() {
		return {
			search: this.filters.search
		}
	},

	watch: {
	},
	
	methods: {
		handleSearchChange: function (value) {
			Inertia.get('/diseases?search=' + value)
		},
		createDisease() {
			Inertia.get('/diseases/create')
		},
		trackDisease(id) {
			Inertia.delete('/diseases/' + id)
		},
		deleteDisease(id) {
			Inertia.delete('/diseases/' + id + '/trash');
		},
		restoreDisease(id) {
			Inertia.put('/diseases/' + id + '/restore');
		}
	},
}
</script>
