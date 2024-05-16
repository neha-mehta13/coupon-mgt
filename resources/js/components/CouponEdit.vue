<template>
    <div>
      <h1>Edit Coupon</h1>
      <form @submit.prevent="updateCoupon">
        <label for="code">Code:</label>
        <input type="text" id="code" v-model="editedCoupon.code" required>
        <label for="status">Status:</label>
        <select id="status" v-model="editedCoupon.status" required>
          <option value="active">Active</option>
          <option value="inactive">Inactive</option>
        </select>
        <label for="brand">Brand:</label>
        <input type="text" id="brand" v-model="editedCoupon.brand.name" disabled> <!-- Display brand name -->
        <button type="submit">Save</button>
      </form>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['coupon'],
    data() {
      return {
        editedCoupon: { ...this.coupon },
      };
    },
    methods: {
      updateCoupon() {
        axios.put(`/api/coupons/${this.coupon.id}`, this.editedCoupon)
          .then(response => {
            console.log('Coupon updated successfully:', response.data);
            // Optionally, redirect to coupon list or show success message
          })
          .catch(error => {
            console.error('Error updating coupon:', error);
          });
      },
    },
  };
  </script>
  