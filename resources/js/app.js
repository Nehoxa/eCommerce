import './bootstrap';

import Alpine from 'alpinejs';
import { createApp } from 'vue';

import Toaster from '@meforma/vue-toaster';

import AddToCart from './components/AddToCart.vue';
import NavbarCart from './components/NavbarCart.vue';
import ShoppingCart from './components/ShoppingCart.vue';
import StripeCheckout from './components/StripeCheckout.vue';

window.Alpine = Alpine;

Alpine.start();

const app = createApp();

app.use(Toaster).provide('toast', app.config.globalProperties.$toast);

app.component('add-to-cart', AddToCart);
app.component('navbar-cart', NavbarCart);
app.component('shopping-cart', ShoppingCart);
app.component('stripe-checkout', StripeCheckout);

app.mount('#app');
