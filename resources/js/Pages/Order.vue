<template>
    <div class="row" id="basic-table">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Order List</h4>
                    <div class="dt-action-buttons text-end">
                        <div class="dt-buttons d-inline-flex">
                            <button v-on:click="syncShopifyOrders" :disabled="isLoading" class="dt-button create-new btn btn-primary">
                                <span v-if="!isLoading">
                                    Sync Shopify Orders
                                </span>
                                <div v-else class="spinner-border spinner-grow-sm spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Order Number</th>
                            <th>Shopify Order Id</th>
                            <th>Customer Email</th>
                            <th>Amount Total</th>
                            <th>Order Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(order) in orders">
                            <td>
                                <span class="fw-bold">{{ order.order_number}}</span>
                            </td>
                            <td>{{ order.external_order_number }}</td>
                            <td><span class="badge rounded-pill badge-light-primary me-1">{{ order.customer_email_address }}</span></td>
                            <td>
                                {{ order.total_amount }}
                            </td>
                            <td>
                                {{ order.ordered_date }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="p-2 d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination mt-3">
                            <li v-for="(link) in links" class="page-item" :class="{'disabled': !link.url, 'active': link.active}">
                                <a class="page-link" @click="fetchOrders(link.url)" href="javascript: void(0);" aria-label="Previous" v-html="link.label">

                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import {inject, onMounted, ref} from "vue";
import { useToast } from "vue-toastification";
export default {
    name: "Order",
    props: {
        orders: {
            default: [],
            type: Array
        }
    },
    setup() {
        const toast = useToast();
        const Swal = inject('$swal')

        const orders = ref([])
        const isLoading = ref(false)
        const links = ref([])

        const fetchOrders = (url = null) => {
            axios.get(url ?? '/app/fetch-orders')
                .then((data) => {
                    orders.value = data.data.data.data
                    links.value = data.data.data.links
                })
                .catch((error) => {
                    toast.error(error.response.data.message)
                })
        }

        onMounted(() => {
            fetchOrders()
        })

        const syncShopifyOrders = () => {
            Swal.fire({
                title: 'Are you sure you want to sync orders?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ok',
            }).then((result) => {
                if (result.isConfirmed) {
                    isLoading.value = true
                    axios.get('/app/fetch-marketplace-orders', {
                        params: {
                            marketPlace: 'Shopify'
                        }
                    })
                        .then((data) => {
                            toast.success(data.data.message)
                            fetchOrders()
                        })
                        .catch((error) => {
                            toast.error(error.response.data.message)
                        })
                        .finally(() => {
                            isLoading.value = false
                        })
                }
            })
        }

        return {
            syncShopifyOrders,
            isLoading,
            orders,
            links,
            fetchOrders
        }
    },
}
</script>

<style scoped>

</style>
