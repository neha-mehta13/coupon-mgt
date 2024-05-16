<template>
    <div>
      <h1>Delete Coupon</h1>
      <p>Are you sure you want to delete this coupon?</p>
      <button @click="deleteCoupon">Delete</button>
    </div>
  </template>
  
  <script>
  import axios from 'axios';
  
  export default {
    props: ['coupon'],
    methods: {
      deleteCoupon() {
        axios.delete(`/api/coupons/${this.coupon.id}`)
          .then(response => {
            console.log('Coupon deleted successfully:', response.data);
          });
        }
      }
    }
         
  