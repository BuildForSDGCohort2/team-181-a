<template>
<div>
    <v-layout row wrap>
        <v-flex sm4>
            <myChart />

            <div class="card-body">
                <h4 class="card-title">Daily Sales</h4>
                <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                </div>
            </div>
        </v-flex>
        <v-flex sm4>
            <myChart2 />

            <div class="card-body">
              <h4 class="card-title">Completed Orders In The Last Year </h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> From January last year
              </div>
            </div>
        </v-flex>
        <v-flex sm4>
            <myChart3 />

            <div class="card-body">
              <h4 class="card-title">Losses </h4>
              <p class="card-category">Losses</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
        </v-flex>
    </v-layout>
</div>
</template>

<script>
import myChart from "./chart.js";
import myChart2 from "./chart_2.js";
import myChart3 from "./chart_3.js";
export default {
    components: {
        myChart,
        myChart2,
        myChart3,
    },
}
</script>
