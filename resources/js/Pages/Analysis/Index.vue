<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Analysis
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-4">
                    
					<!-- Filtering -->
					<div class="mb-5">
						<select-combo></select-combo>
						
						<select class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-4 w-80" id="uniqud_ids" type="text" placeholder="Unique IDs e.g. ID1,ID2,etc...">
							<option>Variant Analysis</option>
							<option>Spread/Containment Analysis</option>
							<option>Counts</option>
						</select>

						<div style="width: 300px; display: inline-block" class="mr-5">
							<litepie-datepicker
							  ref="myRef"
							  :formatter="formatter"
							  v-model="dateValue"
							  id="tracking-date"
							/>
						</div>
						
						<button class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2">
							Show analysis
						</button>
							
					</div>
					<!-- Filtering -->
					
					<div>
						<radio-chart />
					</div>
					
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
	import RadioChart from '@/Jetstream/RadioChart'
	import LitepieDatepicker from 'litepie-datepicker'
	import { ref } from 'vue';
	
    export default {
        components: {
            AppLayout,
			RadioChart,
			LitepieDatepicker 
        },
		data() {
			return {
				checkin: '',
			}   
		},
		setup() {
			const myRef = ref(null);
			const dateValue = ref([]);
			const formatter = ref({
				date: 'DD MMM YYYY',
				month: 'MMM'
			});

			return {
				myRef,
				dateValue,
				formatter
			};
		}
    }
</script>
