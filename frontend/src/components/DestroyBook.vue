<template>
  <div class="destroy-book-form">
    <input type="number" v-model="id" placeholder="Enter book ID" />
    <button @click="destroyBook">Destroy Book</button>
    
    <!--successsss-->
    <div v-if="message && !error" class="message success">
      {{ message }}
    </div>

    <!-- you're bad-->
    <div v-if="message && error" class="message error">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      id: '',
      message: '',
      error: false
    }
  },
  methods: {
    async destroyBook() {
      const response = await fetch(`http://localhost:8083?id=${encodeURIComponent(this.id)}`, {
        method: 'DELETE',
      });
      
      if (response.ok) {
        this.message = 'Book destroyed successfully';
        this.error = false;
      } else {
        this.message = `Failed to destroy book. You don't even deserve to wield a keyboard HTTP request failed with status ${response.status}`;
        this.error = true;
      }
    }
  }
}
</script>


<style scoped>
.destroy-book-form {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  padding-top: 30px;
}

.destroy-book-form input,
.destroy-book-form button {
  font-size: 1.5em;
  padding: 10px;
  width: 20%;
  margin: 5px 0;
  text-align: center;
}

.destroy-book-form button {
  cursor: pointer;
  background-color: #4CAF50;
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  transition-duration: 0.4s;
}

.destroy-book-form button:hover {
  background-color: #45a049;
}

/*meeeeeesages*/
.message {
  margin-top: 1em;
  padding: 1em;
  border-radius: 5px;
  width: 22%;
  text-align: center;
  font-weight: bold;
  color: white;
}

.success {
  background-color: green;
}

.error {
  background-color: red;
}
</style>
