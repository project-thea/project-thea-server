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
							
							
							<jet-button class="float-left bg-grey-400" @click="addDisease()">
								Add Disease
							</jet-button>
						</div>
					</div>
				
					<div class="bg-white rounded shadow overflow-x-auto">
					  <table class="w-full whitespace-nowrap">
						<thead>
						  <tr class="text-left font-bold">
							<th class="px-6 pt-6 pb-4">
							  Name
							</th>
							<th class="px-6 pt-6 pb-4">
							  Description
							</th>
							<th
							  class="px-6 pt-6 pb-4"
							  colspan="2"
							>
							  Actions
							</th>
						  </tr>
						</thead>
						<tbody>
						  <tr
							v-for="disease in diseases.data"
							:key="disease.id"
							class="hover:bg-gray-100 focus-within:bg-gray-100"
						  >
							<td class="border-t">
							  <inertia-link
								class="px-6 py-4 flex items-center focus:text-indigo-500"
								:href="'/diseases/edit/' + disease.id"
							  >
								{{ disease.name }}
								<icon
								  v-if="disease.deleted_at"
								  name="trash"
								  class="flex-shrink-0 w-3 h-3 fill-gray-500 ml-2"
								/>
							  </inertia-link>
							</td>
							<td class="border-t">
							  <inertia-link
								class="px-6 py-4 flex items-center truncate"
								:href="'/diseases/edit/' + disease.id"
								tabindex="-1"
								aria-label="Edit"
							  >
								{{ disease.description }}
							  </inertia-link>
							</td>
							<td class="border-t">
							  <inertia-link
								class="px-6 py-4 flex items-center"
								:href="'/diseases/trash/' + disease.id"
								tabindex="-1"
								aria-label="Trash"
								title="Trash"
								method="delete"
							  >
								<icon
								  name="trash"
								  class="block w-4 h-4 fill-gray-500"
								/>
							  </inertia-link>
							</td>
							<td class="border-t w-px">
							  <inertia-link
								class="px-4 flex items-center"
								:href="'/diseases/edit/' + disease.id"
								tabindex="-1"
								title="Edit"
								aria-label="Edit"
							  >
								<icon
								  name="cheveron-right"
								  class="block w-6 h-6 fill-gray-500"
								/>
							  </inertia-link>
							</td>
						  </tr>
						  <tr v-if="diseases.data.length === 0">
							<td
							  class="border-t px-6 py-4"
							  colspan="4"
							>
							  No disease found.
							</td>
						  </tr>
						</tbody>
					  </table>
					</div>
				
					<!--
					<pagination :meta="organizations.meta" />
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
  //layout: Layout,
  props: {
    diseases: {
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
		Inertia.get('/diseases?search=' + value)
	},
	addDisease(){
		Inertia.get('/diseases/new')
	},
	trackDisease(id){
		Inertia.delete('/diseases/' + id)
	},
  },
}
</script>
