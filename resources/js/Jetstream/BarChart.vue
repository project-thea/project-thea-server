<template>
  <div>
    <canvas id="bar-chart"></canvas>
  </div>
</template>

<script>
import Chart from 'chart.js'
  
export default {
  name: 'BarChart',
  props: ['chartdata'],
  data() {
    return {
    }
  },
  mounted() {
    const ctx = document.getElementById('bar-chart').getContext('2d');

	const chartData = {
	  type: "bar",
	  data: {
		labels: this.chartdata.dates,
		datasets: [
		  {
			label: "Subjects",
			data: this.chartdata.subjects,
			backgroundColor: "rgba(54,73,93,.5)",
			borderColor: "#36495d",
			borderWidth: 3
		  },
		  {
			label: "Tests",
			data: this.chartdata.tests,
			backgroundColor: "rgba(71, 183,132,.5)",
			borderColor: "#47b784",
			borderWidth: 3
		  }
		]
	  },
	  options: {
		responsive: true,
		lineTension: 1,
		scales: {
		  yAxes: [
			{
			  ticks: {
				beginAtZero: true,
				padding: 25
			  }
			}
		  ]
		},
		title: {
			display: true,
			text: 'Subjects and Tests over last 7 days'
		}
	  }
	};
	
    new Chart(ctx, chartData);
  },
  created(){

  }
}
</script>

<style>
</style>