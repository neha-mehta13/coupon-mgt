<template>
    <div>
      <h1>Create Coupon</h1>
      <form @submit.prevent="createCoupon">
        <label for="code">Code:</label>
        <input type="text" id="code" v-model="newCoupon.code" required>
        <label for="brand">Brand:</label>
        <select id="brand" v-model="newCoupon.brand_id" required>
          <option v-for="brand in brands" :key="brand.id" :value="brand.id">{{ brand.name }}</option>
        </select>
        <button type="submit">Create</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    data() {
      return {
        newCoupon: {
          code: '',
          status: 0,
          brand_id: null,
        },
        brands: [],
      };
    },
    mounted() {
      this.fetchBrands();
    },
    methods: {
      fetchBrands() {
        axios.get('/api/brands') 
          .then(response => {
            this.brands = response.data;
          })
          .catch(error => {
            console.error('Error fetching brands:', error);
          });
      },
      createCoupon() {
        axios.post('/api/coupons', this.newCoupon)
          .then(response => {
            console.log('Coupon created successfully:', response.data);
          })
          .catch(error => {
            console.error('Error creating coupon:', error);
          });
      },
    },
  };
  </script>
  