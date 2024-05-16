<template>
  <div>
    <h1>Coupon List</h1>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Code</th>
          <th>Status</th>
          <th>Brand</th> <!-- Update column heading -->
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="coupon in coupons" :key="coupon.id">
          <td>{{ coupon.id }}</td>
          <td>{{ coupon.code }}</td>
          <td>{{ coupon.status }}</td>
          <td>{{ coupon.brand.name }}</td> <!-- Update to display brand name -->
          <td>
            <button @click="editCoupon(coupon)">Edit</button>
            <button @click="deleteCoupon(coupon)">Delete</button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      coupons: [],
    };
  },
  mounted() {
    this.fetchCoupons();
  },
  methods: {
    fetchCoupons() {
      axios.get('/api/coupons')
        .then(response => {
          this.coupons = response.data;
          console.log(this.coupons);
        })
        .catch(error => {
          console.error('Error fetching coupons:', error);
        });
    },
    editCoupon(coupon) {
      // Implement edit functionality
    },
    deleteCoupon(coupon) {
      // Implement delete functionality
    },
  },
};
</script>
