<template>
    <div id="app">
        <div class="heading">
            <h1>Productos</h1>
        </div>
        <input v-model="active_filters.name" placeholder="Buscar...">
        <product-component
                v-for="product in filtered_products"
                v-bind="product"
                :key="product.id"
        ></product-component>
    </div>
</template>

<script>
  function Product({ id, description, name, brand }) {
      this.id = id;
      this.description = description;
      this.name = name;
      this.brand = brand;
    }

  import ProductComponent from './Product.vue';

  export default {
    data() {
      return {
        products: [],
        active_filters: {
          name: ""
        },
      }
    },
    methods: {
      read() {
        window.axios.get('/api/products').then(({ data }) => {
          data.forEach(product => {
            this.products.push(new Product(product));
          });
        });
      },
      entity_has_text (haystack, needle)  {
        if (needle == "") return true;
        return haystack.toLowerCase().includes(needle.toLowerCase());
      }
    },
    components: {
      ProductComponent
    },
    created() {
      this.read();
    },
    computed: {
      filtered_products: function() {
        var data = this;
        return data.products
          .filter(function(product){
            return data.entity_has_text(product.name, data.active_filters.name);
          })
      }
    }
  }
</script>