<template>
<v-main style="margin-top: 50px !important;">
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <el-row :gutter="12" style="width: 100%">
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #1093de;">19</p>
                                    <h5>Animals</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #db3f26;">10</p>
                                    <h5>Farmers</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #388a10;">3</p>
                                    <h5>Suppliers</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #f4a204;">3</p>
                                    <h5>Animal type</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <v-divider vertical></v-divider>
                    <el-col :span="6">
                        <el-card shadow="hover">
                            <div>
                                <h4>Health animals <span style="float:right;border-left: 1px solid;padding-left: 10px;">17</span> </h4>
                            </div>
                        </el-card>
                        <el-card shadow="hover">
                            <div>
                                <h4>Sick animals <span style="float:right;border-left: 1px solid;padding-left: 10px;">1</span> </h4>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>
                <div style="margin: 60px"></div>

                <v-layout row wrap>
                    <v-flex xs4>
                        <v-card>
                            <el-card shadow="hover">
                            <myChart />
                            </el-card>
                        </v-card>
                        </div>
                    </v-flex>
                    <v-flex xs4>
                            <el-card shadow="hover">

                            <myChart2 />
                            </el-card>
                        </div>
                    </v-flex>
                    <v-flex xs4>
                            <el-card shadow="hover">

                            <myChart3 />
                            </el-card>
                        </div>
                    </v-flex>
                </v-layout>

                <div style="margin: 60px"></div>

                <el-row :gutter="12" style="width: 100%">
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #1093de;">19</p>
                                    <h5>Plants</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #db3f26;">10</p>
                                    <h5>Customers</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #388a10;">3</p>
                                    <h5>Orders</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <el-col :span="4">
                        <div style="cursor: pointer">
                            <el-card shadow="hover">
                                <div class="text-center">
                                    <p style="font-size: 36px;color: #f4a204;">3</p>
                                    <h5>Plant types</h5>
                                </div>
                            </el-card>
                        </div>
                    </el-col>
                    <v-divider vertical></v-divider>
                    <el-col :span="6">
                        <el-card shadow="hover">
                            <div>
                                <h4>Health plants <span style="float:right;border-left: 1px solid;padding-left: 10px;">17</span> </h4>
                            </div>
                        </el-card>
                        <el-card shadow="hover">
                            <div>
                                <h4>Sick plants <span style="float:right;border-left: 1px solid;padding-left: 10px;">1</span> </h4>
                            </div>
                        </el-card>
                    </el-col>
                </el-row>

            </v-flex>
        </v-layout>
    </v-container>
</v-main>
</template>

<script>
import myChart from "../charts/chart.js";
import myChart2 from "../charts/chart_2.js";
import myChart3 from "../charts/chart_3.js";
export default {
    components: {
        myChart,
        myChart2,
        myChart3
    },
    data() {
        return {
            form: {},
            height: 300,
            datacollection: null

        }
    },

    methods: {
        increase() {
            this.height += 10
        },
        fillData() {
            this.datacollection = {
                labels: [this.getRandomInt(), this.getRandomInt()],
                datasets: [{
                    label: 'Data One',
                    backgroundColor: '#f87979',
                    data: [this.getRandomInt(), this.getRandomInt()]
                }, {
                    label: 'Data One',
                    backgroundColor: '#f87979',
                    data: [this.getRandomInt(), this.getRandomInt()]
                }]
            }
        },
        getRandomInt() {
            return Math.floor(Math.random() * (50 - 5 + 1)) + 5
        },
    },
    mounted() {
        this.fillData();
    },
    computed: {
        myStyles() {
            return {
                height: `${this.height}px`,
                position: 'relative'
            }
        }
    }
}
</script>

<style scoped>
.small {
    max-width: 600px;
    margin: 150px auto;
}

.justify-center {
    margin-top: -100px !important;
}

.card-stats {
    margin-top: -10px;
    padding: 20px 0;
}

/* .statistics {
    background: #f0f0f0 !important;
} */

.progress-Ship {
    margin-top: 100px !important;
}

.v-icon {
    font-size: 64px !important;
}

.v-icon {
    box-shadow: 0 9px 30px -6px rgba(255, 54, 54, .5);
    padding: 5px;
    border-radius: 50%;
}

.info-title {
    margin-top: 20px;
}
</style>
