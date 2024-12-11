<template>
    <section id="multiple-column-form">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Shopify Setting</h4>
                    </div>
                    <div class="card-body">
                        <Form :validation-schema="validationSchema" v-slot="{ handleSubmit, errors }">
                            <form @submit="handleSubmit($event, submit)" class="form">
                                <div class="row">
                                    <Field name="shopify_store" v-model="setting.shopify_store" v-slot="{ field, errorMessage, errors }">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">SHOPIFY STORE
                                                    DOMAIN</label>
                                                <input
                                                    type="text"
                                                    id="first-name-column"
                                                    :class="{'is-invalid': errors.length > 0}"
                                                    class="form-control"
                                                    placeholder="example.myshopify.com"
                                                    v-bind="field"
                                                    v-model="setting.shopify_store"
                                                    :value="setting.shopify_store"
                                                >
                                                <div class="invalid-feedback d-block">
                                                    {{ errors?.[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </Field>
                                    <Field name="shopify_token" v-model="setting.shopify_token" v-slot="{ field, errorMessage, errors }">
                                        <div class="col-md-6 col-12">
                                            <div class="mb-1">
                                                <label class="form-label" for="first-name-column">SHOPIFY ADMIN
                                                    TOKEN</label>
                                                <input
                                                    type="text"
                                                    id="first-name-column"
                                                    :class="{'is-invalid': errors.length > 0}"
                                                    class="form-control"
                                                    placeholder="shpat_1xxxxxx"
                                                    v-bind="field"
                                                    v-model="setting.shopify_token"
                                                    :value="setting.shopify_token"
                                                >
                                                <div class="invalid-feedback d-block">
                                                    {{ errors?.[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </Field>

                                    <div class="col-12">
                                        <button type="submit"
                                                class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </Form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import {Form, Field} from 'vee-validate';
import * as yup from "yup";
import {computed, ref} from "vue";
import { useToast } from "vue-toastification";

export default {
    name: "Setting",
    props: {
        token: {
            default: null,
            type: String
        },
        store: {
            default: null,
            type: String
        }
    },
    components: {
        Field,
        Form
    },
    setup(props) {
        const toast = useToast();

        const setting = ref({
            shopify_store: props.store,
            shopify_token: props.token
        });

        const validationSchema = computed(() => {
            const globalErrorMsg = 'This field is required!'

            return yup.object({
                shopify_store: yup.string().required(globalErrorMsg),
                shopify_token: yup.string().required(globalErrorMsg),
            });
        });

        const submit = async () => {
            axios.post('/app/update', setting.value)
                .then(() => {
                    toast.success("Setting update successfully");
                })
                .catch(() => {
                    toast.error('An error occurred.')
                })
        }

        return {
            setting,

            validationSchema,
            submit,
        }
    }
}
</script>

<style scoped>

</style>
