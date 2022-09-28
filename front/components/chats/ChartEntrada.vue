<template>
  <LineChartGenerator :chart-options="chartOptions" :chart-data="chartData" :chart-id="chartId"
    :dataset-id-key="datasetIdKey" :plugins="plugins" :css-classes="cssClasses" :styles="styles" :width="width"
    :height="height" />
</template>

<script>
import { Line as LineChartGenerator } from 'vue-chartjs'

import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  CategoryScale,
  PointElement
} from 'chart.js'

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  LinearScale,
  CategoryScale,
  PointElement
)

export default {
  name: 'LineChart',
  components: {
    LineChartGenerator
  },
  props: {
    chartId: {
      type: String,
      default: 'line-chart'
    },
    datasetIdKey: {
      type: String,
      default: 'label'
    },
    width: {
      type: Number,
      default: 1000
    },
    height: {
      type: Number,
      default: 400
    },
    cssClasses: {
      default: '',
      type: String
    },
    styles: {
      type: Object,
      default: () => { }
    },
    plugins: {
      type: Array,
      default: () => []
    }
  },
  data() {
    return {
      chartData: {
        labels: [],
        datasets: [
          {
            label: 'Total da Entradas',
            backgroundColor: '#32CD32',
            borderColor: '#32CD32',
            data: []
          }
        ]
      },
      chartOptions: {
        responsive: true,
        maintainAspectRatio: false
      }
    }
  },
  created() {
    this.getGraphicDataByType();
  },
  methods: {
    getGraphicDataByType: function () {
      this.$axios.get('dashboard/transaction/get-graphic-data-by-type')
        .then(res => {
          let data = res.data.response.entradas;
          if (data) {
            console.log(data)

            let total = [];
            let label;
            let labels = [];

            data.forEach(e => {
              console.log(e.total)
              label = `${e.day}/${e.month < 10 ? '0' + e.month : e.month}/${e.year}`;
              labels.push(label);
              total.push(e.total);
            })
            this.chartData.labels = labels;
            this.chartData.datasets[0].data = total;

          }
        })
        .catch(error => console.log(error))
    }
  }
}
</script>
