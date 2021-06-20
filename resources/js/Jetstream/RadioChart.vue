<template>
  <div>
    <canvas id="radio-chart"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js'
import LitepieDatepicker from 'litepie-datepicker'

export default {
  name: 'RadioChart',
  props: ['chartdata'],
  data() {
    return {
    }
  },
  mounted() {
    const ctx = document.getElementById('radio-chart');

	const chartData = {
	  labels: [
		'China-Var',
		'Indian-Var',
		'SA-Var',
		'Dubai-Var',
		'Local-Var1'
	  ],
	  datasets: [{
		label: 'My First Dataset',
		data: [11, 16, 7, 3, 14],
		backgroundColor: [
		  'rgb(255, 99, 132)',
		  'rgb(75, 192, 192)',
		  'rgb(255, 205, 86)',
		  'rgb(201, 203, 207)',
		  'rgb(54, 162, 235)'
		]
	  }]
	};
	
	const config = {
	  type: 'polarArea',
	  data: chartData,
	  options: {
		title: {
			display: true,
			text: 'Covid 19 Variants'
		}
	  }
	};
	
    new Chart(ctx, config);
  },
  created(){

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