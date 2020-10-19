//Importing Line class from the vue-chartjs wrapper
import { Line } from 'vue-chartjs'
//Exporting this so it can be used in other components
export default {
    // extend: Line,
    extends: Line,
    data() {
        return {
            label: ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July'],
            rows: [3, 4, 2, 1, 2, 4, 6]
        }
    },
    mounted() {
        this.chartData()
    },
    methods: {
        chartData() {

            this.label = ['Jan', 'Feb', 'March', 'April', 'May', 'June', 'July'],
                this.rows = [3, 4, 2, 1, 2, 4, 6]
            this.setGraph()

            return
            axios.get('/getChartScheduled')
                .then((response) => {
                    // console.log(response);
                    this.label = response.data.data.lables
                    this.rows = response.data.data.rows
                    this.setGraph()
                })
                .catch((error) => {
                    this.errors = error.response.data.errors
                })
        },
        setGraph() {
            this.renderChart({
                labels: this.label,
                datasets: [
                    {
                        label: 'Orders',
                        backgroundColor: '#f19426',
                        data: this.rows
                    }
                ]
            }, { responsive: true, maintainAspectRatio: false })
        },
        ref(data) {
            this.chartData()
        }
    },
    created() {
        eventBus.$on('chartEvent', data => {
            this.label = data.lables
            this.data = data.rows
        });

        eventBus.$on('DashchartEvent', data => {
            this.ref(data)
        });
    },
}
