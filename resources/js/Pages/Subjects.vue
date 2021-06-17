<template>
    <app-layout>
    <template #header>
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Subjects
        </h2>
    </template>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="mb-4 max-w-xs float-right">
                <input type="search" v-model="params.search" aria-label="Search" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"/>
            </div>

            <div class="mb-4 max-w-xs">
                <button @click="openModal()" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Add Subject</button>                            
            </div>

            <div class="overflow-hidden bg-white shadow-md sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="overflow-x-auto -my-2 sm:-mx-6 lg:-mx-8">
                        <div class="inline-block py-2 min-w-full align-middle sm:px-6 lg:px-8">
                            <div class="overflow-hidden border-b border-gray-200 shadow sm:rounded-lg">

                                <table class="min-w-full divide-y divide-gray-200 table-fixed">
                                    <thead class="bg-indigo-500">
                                        <tr>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                #
                                            </th>
                                            <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('name')">Name

                                                    <svg v-if="params.field === 'name' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                    </svg>

                                                    <svg v-if="params.field === 'name' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th scope="col" class="w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                <span class="inline-flex py-3 px-6 w-full justify-between" @click="sort('email')">Email
                                                    <svg v-if="params.field === 'email' && params.direction === 'asc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h5a1 1 0 000-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM13 16a1 1 0 102 0v-5.586l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 101.414 1.414L13 10.414V16z"/>
                                                    </svg>

                                                    <svg v-if="params.field === 'email' && params.direction === 'desc'" xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path d="M3 3a1 1 0 000 2h11a1 1 0 100-2H3zM3 7a1 1 0 000 2h7a1 1 0 100-2H3zM3 11a1 1 0 100 2h4a1 1 0 100-2H3zM15 8a1 1 0 10-2 0v5.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L15 13.586V8z"/>
                                                    </svg>
                                                </span>
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Nationality
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Phone
                                            </th>
                                            <th scope="col" class="py-3 px-6 w-3/12 text-xs font-semibold tracking-wider text-left text-white uppercase">
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody class="bg-white divide-y divide-gray-200">
                                        <tr v-for="subject in subjects.data" :key="subject.id">
                                            <td class="py-2 px-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ subject.id }}
                                            </td>
                                            <td class="border py-2 px-4 text-sm text-gray-500 whitespace-nowrap">
                                                <div class="text-sm font-semibold text-gray-900">
                                                    {{ subject.name }}
                                                </div>
                                            </td>
                                            
                                            <td class="border py-2 px-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ subject.email }}
                                            </td>

                                            <td class="border py-2 px-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ subject.nationality }}
                                            </td>

                                            <td class="border py-2 px-4 text-sm text-gray-500 whitespace-nowrap">
                                                {{ subject.phone }}
                                            </td>
                                            <td class="border px-4 py-2">
                                                <button @click="edit(subject)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Modal UI -->
            <!-- <div x-data="{ show: false }"> 
                <div x-show="show" tabindex="0" class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
                    <div  class="z-50 relative p-3 mx-auto my-0 max-w-full" style="width: 600px;">
                        <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden">
                            <button @click="closeModal()" class="fill-current h-6 w-6 absolute right-0 top-0 m-6 font-3xl font-bold">&times;</button>
                            <div class="px-6 py-3 text-xl border-b font-bold">Add Subject</div>
                            <div class="p-6 flex-grow form-group">
                                <label for="name" class="text-gray-600 font-light">Name</label>
                                <input id="name" v-model="form.name" type='text' placeholder="Enter your name" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="email" class="text-gray-600 font-light">Email</label>
                                <input id="email" v-model="form.email" type='text' placeholder="Enter your email" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="nationality" class="text-gray-600 font-light">Nationality</label>
                                <input id="nationality" v-model="form.nationality" type='text' placeholder="Enter your nationality" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="phone" class="text-gray-600 font-light">Phone</label>
                                <input id="phone" v-model="form.phone" type='text' placeholder="Enter your phone" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="date_of_birth" class="text-gray-600 font-light">Date of Birth</label>
                                <input id="date_of_birth" v-model="form.date_of_birth" type='text' placeholder="Enter your date of birth" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="id_number" class="text-gray-600 font-light">ID Number</label>
                                <input id="id_number" v-model="form.id_number" type='text' placeholder="Enter your ID Number" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                                
                                <label for="id_type" class="text-gray-600 font-light">ID Type</label>
                                <input id="id_type" v-model="form.id_type" type='text' placeholder="Enter ID Type" class="w-full mt-2 mb-6 px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:border-green-500" required />
                            </div>
                            <div class="px-6 py-3 border-t">
                                <div class="flex justify-end">
                                    <button type="button" class="bg-gray-700 text-gray-100 rounded px-4 py-2 mr-1" @click="closeModal()">Close</button>
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" v-show="!editMode" @click="save(form)">Save</button>
                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded" v-show="editMode" @click="update(form)">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed bg-black opacity-50"></div>
                </div>
            </div> -->

            <pagination class="mt-5" :links="subjects.links"/>
        </div>
    </div>
  </app-layout> 
</template>

<script>
import AppLayout from '@/Layouts/AppLayout';
import Pagination from '../Jetstream/Pagination';
import { pickBy, throttle } from 'lodash';

export default {

    components: {
        AppLayout,
        Pagination,
    },
    props: {
        subjects: Object,
        filters: Object,
    },
    
    data() {
        return {
            params: {
                search: this.filters.search,
                field: this.filters.field,
                direction: this.filters.direction,
            },
            editMode: false,
            form: {
                name: null,
                email: null,
                nationality: null, 
                date_of_birth: null, 
                phone: null,
                next_of_kin: null,
                next_of_kin_phone: null,
                id_number: null,
                id_type: null,
            }
        };
    },
    methods: {
        sort(field) {
            this.params.field = field;
            this.params.direction = this.params.direction === 'asc' ? 'desc' : 'asc';
        },

        openModal: function() {
            $('#modal').modal('show')
        },

        closeModal: function() {
            $('#modal').modal('hide')
            this.reset();
            this.editMode = false;
        },

        reset: function() {
            this.form = {
                name: null,
                email: null,
                nationality: null, 
                date_of_birth: null, 
                phone: null,
                next_of_kin: null,
                next_of_kin_phone: null,
                id_number: null,
                id_type: null,
            }
        },

        save: function (subjects) {
            this.$inertia.post('/subjects', subjects);
            this.reset();
            this.closeModal();
            this.editMode = false;
        },

        edit: function(subjects) {
            this.form = Object.assign({}, subjects);
            this.editMode = true;
            this.openModal();
        },

        update: function (subjects) {
            subjects._method = 'PATCH';
            this.$inertia.post('/subjects/' + subjects.id, subjects)
            this.reset();
            this.closeModal();
        }
    },
    watch: {
        params: {
        handler: throttle(function () {
            let params = pickBy(this.params);

            this.$inertia.get(this.route('subjects'), params, { replace: true, preserveState: true });
        }, 150),
        deep: true,
        },
    },
};
</script>