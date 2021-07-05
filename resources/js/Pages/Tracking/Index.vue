<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Tracking
            </h2>
        </template>
	
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg">
                    <div class="p-4">
						<div> 
							<input class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-4 w-80" id="uniqud_ids" type="text" placeholder="Unique IDs e.g. ID1,ID2,etc..." v-model="uniqueIds">

							<div style="width: 300px; display: inline-block" class="mr-5">
								<litepie-datepicker
								  ref="myRef"
								  :formatter="formatter"
								  v-model="dateValue"
								  id="tracking-date"
								/>
							</div>
							
							<button class="bg-gray-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mr-2" @click="getLocationPoints">
							  	Track
							</button>
						</div>
						<div>
							<tracking-map :datapoints="datapoints" :locations="locations"/>
						</div>
					</div>
                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import AppLayout from '@/Layouts/AppLayout'
	import TrackingMap from '@/Jetstream/TrackingMap'
	import LitepieDatepicker from 'litepie-datepicker'
	import { ref } from 'vue';

    export default {
        components: {
            AppLayout,
			TrackingMap,
			LitepieDatepicker 
        },
		props: {
			locations: {
				type: Object
			},
			uids: {
				type: Object
			},
			start_date: {
				type: String
			},
			end_date: {
				type: String
			}
		},
		data(){
			return {
				checkin: '',
				uniqueIds: '', //$route.query.uids || '',
				datapoints: []
			}   
		},
		setup() {
			const now =  new Date();
			const initialDateRange = now.getFullYear() + '-' + now.getMonth().toString().padStart(2, "0") + '-' + now.getDay().toString().padStart(2, "0");

			const myRef = ref(null);
			const dateValue = ref([initialDateRange, initialDateRange]);
			const formatter = ref({
			  date: 'YYYY-MM-DD',
			  month: 'MMM'
			});

			return {
			  myRef,
			  dateValue,
			  formatter
			};
			

		},
		created: function(){
		    console.log('this.start_date:', this.start_date);

			
			if(this.uids === null) return;
			
			this.uniqueIds = this.uids;
			
			const oneUUID = this.uids.split(',')[0];
			if(this.uids.length > 0){
				this.datapoints = this.locations[oneUUID];
			}

			if(this.start_date === null){
			  const now =  new Date();
			  const initialDate = now.getFullYear() + '-' + now.getMonth().toString().padStart(2, "0") + '-' + now.getDay().toString().padStart(2, "0");
			  this.dateValue = [initialDate, initialDate];
			  
			  return;
			}

			this.dateValue = [this.start_date, this.end_date];
		},
		methods: {
			getLocationPoints(){

				const data = {
					start_date: this.dateValue[0],
					end_date: this.dateValue[1],
					uids: this.uniqueIds
				};
				const options = {};
				
				this.$inertia.get('/tracking', data, options)
				
			}
		}
    }
</script>
<style>
	#litepie input {
		padding-top: 0.525rem;
		padding-bottom: 0.525rem;
		
		border-radius: 0.25rem;
	}
</style>