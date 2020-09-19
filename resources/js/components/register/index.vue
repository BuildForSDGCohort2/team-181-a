<template>
<div style="background: linear-gradient(0deg, rgb(0, 0, 0), rgba(12, 12, 12, 0.55)), url(/material/img/login.jpg);color: #fff !important;padding: 0;background-size: cover;
    background-position: top center;
    align-items: center;height: 100vh">
    <!-- <div class="row c">
        <div class="col-lg-7 col-md-8 text-center">
            <h1 class="text-white text-center">The Farmer's Assistant</h1>
        </div>
    </div> -->
    <div class="container">
        <div class="row justify-content-center" style="    margin-top: 100px;">
            <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px; margin:0.1px; ">
                <h3>Agricultural Services</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="material-icons" style="font-size:42px;">biotech</i>
                <a href="/professional-browse">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal; "><i class="fa fa-search" aria-hidden="true"></i> Hire A <span style="color: rgb(255, 179, 0)">proffessional</span>
                    </button>
                </a>
                <p style="padding-top: 20%">
                    Farmers Can now seek Veterinary services and slso field extention services on this platform.
                    A Group of Readily available Professionals are readily available.
                </p>
                <button class="btn btn-outline" style="border: 1px solid white; color: white; white-space: normal;float: right; " data-toggle="modal" @click="openProfessional"> <i class="material-icons">person_add</i> Register as A <span style="color: rgb(255, 179, 0)">proffessional</span> </button>
            </div>

            <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px; margin:0.1px;">
                <h3>Agricultural Products</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="fa fa-envira" style="font-size: 48px" aria-hidden="true"></i>
                <a href="/register">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; "><i class="fa fa-shopping-basket" aria-hidden="true"></i>&nbsp; Browse and buy <span style="color: greenyellow">farmer's Produce</span> </button>
                </a>
                <p style="padding-top: 20%">
                    The Farmer of couse is the center of our Sysytem.
                    When The produce is ready the farmer will get a Notification from the system alerting him/her to
                    this very fact.
                    If comfortable the farmer will confirm the notification, and the system will automatically post the
                    product for sale.
                </p>
                <a href="#">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; margin-bottom:15%; " @click="openFarmer"> <i class="material-icons">person_add</i> Register as A <span style="color: greenyellow">farmer</span> </button>
                </a>
            </div>
            <div class="col-lg-3 col-md-12 text-center " style="border:1px solid white; border-radius: 25px;margin:0.1px; ">
                <h3>Agricultural Supplies</h3>
                <hr style="height: 1px;background-color: white; border: none;">
                <i class="fa fa-truck" style="font-size:42px;" aria-hidden="true"></i>
                <a href="/supplier-browse">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; ">
                        <i class="material-icons">sync</i> Browse for <span style="color: rgb(243, 162, 12)">Suppliers</span> </button>
                </a>
                <p style="padding-top: 20%">
                    Suppliers Too can enroll in this system. The system will coodinate the Buying of thr various farm inputs
                    needed. the farmer will only worry about the farm, all the logistics wil be handled by his 'Assistant'.
                </p>

                <a href="#">
                    <button class="btn btn-outline" style="border: 1px solid white; color: white;white-space: normal; margin-bottom:15%; " @click="openSupplier"> <i class="material-icons">person_add</i> Register as A <span style="color: greenyellow">supplier</span> </button>
                </a>

            </div>

        </div>
    </div>
    <mySupplier />
    <myProfessional />
    <myFarmer />

    <div class="container" style="margin-top: 10px">
    <nav class="float-left">
        <ul>

            <li class="list-group-item">
                <a href="#">
                    About Us
                </a>
            </li>

        </ul>
    </nav>
    <v-spacer></v-spacer>
    <div class="copyright float-right">
        &copy;{{ new Date().getFullYear() }}, Made with <i class="material-icons">favorite</i> ,For A Happier
        <a href="/" style="color: green">Farmer</a> and A Happier Better Africa.
    </div>
    </div>
</div>
</template>

<script>
import mySupplier from "./supplier";
import myProfessional from "./professional";
import myFarmer from "./farmer";
export default {
    components: {
        mySupplier,
        myProfessional,
        myFarmer
    },
    methods: {
        openSupplier() {
            eventBus.$emit('openSupplierEvent')
        },
        openProfessional() {
            eventBus.$emit('openProfessionalEvent')
        },
        openFarmer() {
            eventBus.$emit('openFarmerEvent')
        },
    },
}
</script>
