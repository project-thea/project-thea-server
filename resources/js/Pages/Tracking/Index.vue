<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Analysis {{ $page.props.demo_mode }}
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
							<tracking-map :start_date="start_date" :end_date="end_date" :datapoints="datapoints" :locations="locations" :uids="uids.split(',')" :hotspots="hotspots" :uid_list="uid_list"/>
						</div>
						
						<div class="grid grid-cols-2 gap-4">
						
							<!-- drivers on the move -->
							<div>
							
								<div style="margin-top:5px;" class="font-bold">
									<h3>Drivers on the move during this period</h3>
								</div>
								<div>
									<table class="w-full whitespace-nowrap">
										<thead>
											<tr class="text-left font-bold">
												<th class="pt-6 pb-4" style="width: 30px">
													#
												</th>
												<th class="px-6 pt-6 pb-4">
													Driver ID
												</th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(uid, index) in uids.split(',')" :key="uid"
												class="hover:bg-gray-100 focus-within:bg-gray-100"
												v-if="uids.length !== 0"
											>
												<td class="border-t">
													{{ index+1 }}
												</td>
												<td :id='uid' class="border-t" :style='{fontColor: positives.indexOf(uid) > -1 ? "red": "black"}'>
													{{ uid }}
												</td>
											</tr>
											<tr v-if="uids.length === 0">
												<td
												class="border-t px-6 py-4"
												colspan="4"
												>
												No drivers found.
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							
							<div>
								<div style="margin-top:5px; margin-bottom: 40px" class="font-bold">
									<h3>Exposure notification list</h3>
								</div>
								<div id="exposure-map"></div>
							</div>

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
	import * as d3 from "d3";

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
				type: Array
			},
			uid_list: {
				type: Array
			},
			hotspots: {
				type: Array
			},
			start_date: {
				type: String
			},
			end_date: {
				type: String
			},
			demo_mode: {
				type: Boolean
			}
		},
		data(){
			return {
				checkin: '',
				uniqueIds: '', //$route.query.uids || '',
				datapoints: [],
				exposure_map: [],
				positives: []
			}   
		},
		mounted(){
			this.loadExposureTree();
			
		},
		setup(props) {

			const now =  new Date();
			let initialDateRange = now.getFullYear() + '-' + (1+now.getMonth()).toString().padStart(2, "0") + '-' + now.getDate().toString().padStart(2, "0");
			let initialEndDate = initialDateRange;
			if(props.demo_mode){
				initialDateRange = '2023-03-01';
				initialEndDate = '2023-03-31';
			}

			const params = new URLSearchParams(window.location.search);
			
			var start_date = initialDateRange;
			var end_date = initialEndDate;
			if(params.get('start_date')){
				start_date = params.get('start_date');
			}
			if(params.get('end_date')){
				end_date = params.get('end_date');
			}
			

			const dateValue = ref([start_date, end_date]);
			const formatter = ref({
			  date: 'YYYY-MM-DD',
			  month: 'MMM'
			});


			return {
			  dateValue,
			  formatter
			};
			

		},
		created: function(){
			console.log('demo_mode: ', this.demo_mode);
			if(this.uids === null) return;
			if(this.uids.length === 0) return;

			this.uniqueIds = this.uids;
			
			const oneUUID = this.uids.split(',')[0];
			if(this.uids.length > 0){
				this.datapoints = this.locations[oneUUID];
			}

			if(this.start_date === null){
			  const now =  new Date();
			  let initialDate = now.getFullYear() + '-' + (1+now.getMonth()).toString().padStart(2, "0") + '-' + now.getDate().toString().padStart(2, "0");
			  let initialEndDate = initialDateRange;
				if(this.demo_mode){
					initialDate = '2023-03-01';
					initialEndDate = '2023-03-31';
				}

			  this.dateValue = [initialDate, initialEndDate];
			  
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
				
			},

			dendrogramTree(data, { // data is either tabular (array of objects) or hierarchy (nested objects)
			  path, // as an alternative to id and parentId, returns an array identifier, imputing internal nodes
			  id = Array.isArray(data) ? d => d.id : null, // if tabular data, given a d in data, returns a unique identifier (string)
			  parentId = Array.isArray(data) ? d => d.parentId : null, // if tabular data, given a node d, returns its parent’s identifier
			  children, // if hierarchical data, given a d in data, returns its children
			  tree = d3.tree, // layout algorithm (typically d3.tree or d3.cluster)
			  sort, // how to sort nodes prior to layout (e.g., (a, b) => d3.descending(a.height, b.height))
			  label, // given a node d, returns the display name
			  title, // given a node d, returns its hover text
			  link, // given a node d, its link (if any)
			  linkTarget = "_blank", // the target attribute for links (if any)
			  width = 640, // outer width, in pixels
			  height, // outer height, in pixels
			  r = 3, // radius of nodes
			  padding = 1, // horizontal padding for first and last column
			  fill = "#999", // fill for nodes
			  fillOpacity, // fill opacity for nodes
			  stroke = "#555", // stroke for links
			  strokeWidth = 1.5, // stroke width for links
			  strokeOpacity = 0.4, // stroke opacity for links
			  strokeLinejoin, // stroke line join for links
			  strokeLinecap, // stroke line cap for links
			  halo = "#fff", // color of label halo 
			  haloWidth = 3, // padding around the labels
			}) 
			{

			  // If id and parentId options are specified, or the path option, use d3.stratify
			  // to convert tabular data to a hierarchy; otherwise we assume that the data is
			  // specified as an object {children} with nested objects (a.k.a. the “flare.json”
			  // format), and use d3.hierarchy.
			  const root = path != null ? d3.stratify().path(path)(data)
				  : id != null || parentId != null ? d3.stratify().id(id).parentId(parentId)(data)
				  : d3.hierarchy(data, children);

			  // Compute labels and titles.
			  const descendants = root.descendants();
			  const L = label == null ? null : descendants.map(d => label(d.data, d));

			  // Sort the nodes.
			  if (sort != null) root.sort(sort);

			  // Compute the layout.
			  const dx = 10;
			  const dy = width / (root.height + padding);
			  tree().nodeSize([dx, dy])(root);

			  // Center the tree.
			  let x0 = Infinity;
			  let x1 = -x0;
			  root.each(d => {
				if (d.x > x1) x1 = d.x;
				if (d.x < x0) x0 = d.x;
			  });

			  // Compute the default height.
			  if (height === undefined) height = x1 - x0 + dx * 2;

			  const svg = d3.create("svg")
				  .attr("viewBox", [-dy * padding / 2, x0 - dx, width, height])
				  .attr("width", width)
				  .attr("height", height)
				  .attr("style", "max-width: 100%; height: auto; height: intrinsic;")
				  .attr("font-family", "sans-serif")
				  .attr("font-size", 14);

			  svg.append("g")
				  .attr("fill", "none")
				  .attr("stroke", stroke)
				  .attr("stroke-opacity", strokeOpacity)
				  .attr("stroke-linecap", strokeLinecap)
				  .attr("stroke-linejoin", strokeLinejoin)
				  .attr("stroke-width", strokeWidth)
				  .attr("color", 'red')
				.selectAll("path")
				  .data(root.links())
				  .join("path")
					.attr("d", d3.linkHorizontal()
						.x(d => d.y)
						.y(d => d.x));

			  const node = svg.append("g")
				.selectAll("a")
				.data(root.descendants())
				.join("a")
				  .attr("xlink:href", link == null ? null : d => link(d.data, d))
				  .attr("target", link == null ? null : linkTarget)
				  .attr("transform", d => `translate(${d.y},${d.x})`);

			  node.append("circle")
				  .attr("fill", d => d.children ? stroke : fill)
				  .attr("r", r);

			  if (title != null) node.append("title")
				  .text(d => title(d.data, d));

			  if (L) node.append("text")
				  .attr("dy", "0.32em")
				  .attr("x", d => d.children ? -6 : 6)
				  .attr("text-anchor", d => d.children ? "end" : "start")
				  .text((d, i) => L[i])
				  .call(text => text.clone(true))
				  .attr("fill", "none")
				  .attr("stroke", halo)
				  .attr("stroke-width", haloWidth);

			  return svg.node();
			},
			loadExposureTree(){
				var _this = this;
				this.hotspots.forEach( v => {
					
					if (v.id === null) return;
					
					_this.positives.push(v.unique_id);

					const drivers = v.drivers.split(',').map(d => { return {name: d}; });
					console.log('drivers:', drivers);
					const data = {
						  //name: "root",
						name: v.unique_id,
					    children: drivers
					};
					
					const chart = this.dendrogramTree(data, {
					  label: d => d.name,
					  title: (d, n) => `${n.ancestors().reverse().map(d => d.data.name).join(".")}`, // hover text
					  width: 800
					})
					
					 //d3.select("#exposure-map").append(chart);
					 d3.select("#exposure-map").node().appendChild(chart);
					
				});
				

				

			}
		},

    }
</script>
<style>
	#litepie input {
		padding-top: 0.525rem;
		padding-bottom: 0.525rem;
		
		border-radius: 0.25rem;
	}
</style>