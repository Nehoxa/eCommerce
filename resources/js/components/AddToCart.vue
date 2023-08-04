<template>
  <div class="flex items-center justify-between py-4">
    <button
      class="focus:outline-none text-white rounded-md cursor-pointer text-xs font-semibold px-3 py-2 bg-indigo-700"
      v-on:click.prevent="addToCart"
    >
      Ajouter au panier
    </button>
  </div>
</template>

<script setup >
  import { inject } from 'vue';
  import { useProduct } from '../composables/products/index.js';

  const { add } = useProduct();
  const productId = defineProps(['productId']);

  const emitter = require('tiny-emitter/instance');
  const toast = inject('toast');

  const addToCart = async () => {
    await axios.get('/sanctum/csrf-cookie');
    await axios.get('/api/user')
      .then(async (res) => {
        let cartCount = await add(productId);
        emitter.emit('cartCountUpdate', cartCount);
        toast.success(`L'article a bien étais ajouté à votre panier`);
      })
      .catch(() => {
        toast.error(`Connectez-vous pour ajouter un produit au panier`);
      });
    }
</script>