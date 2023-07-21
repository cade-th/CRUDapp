<template>
  <div class="create-book">
    <form @submit.prevent="createBook">
      <input class="input-field" v-model="title" type="text" placeholder="Book Title" required />
      <input class="input-field" v-model="author" type="text" placeholder="Author" required />
      <input class="input-field" v-model="year_published" type="text" placeholder="Year Published" required />
      <input class="input-field" v-model="genre" type="text" placeholder="Genre" required />
      <button type="submit">Create</button>
    </form>

    <!--what if-->
    <div v-if="message && !error" class="message success">
      {{ message }}
    </div>

    <!-- reality-->
    <div v-if="message && error" class="message error">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: '',
      author: '',
      year_published: '',
      genre: '',
      message: '',
      error: false
    }
  },
  methods: {
  
  async createBook() {
    const response = await fetch('http://localhost:8083', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        title: this.title,
        author: this.author,
        year_published: parseInt(this.year_published),
        genre: this.genre
      })
    });

    if (response.ok) {
      this.title = '';
      this.author = '';
      this.year_published = '';
      this.genre = '';
      this.message = 'Book created successfully';
      this.error = false;
      this.$store.commit('setRefreshBooks', true);
      console.log(this.$store.state.refreshBooks);

    } else {
      this.message = 'Error creating book. give up. HTTP request failed with status ' + response.status;
      this.error = true;
    }
}

  }
}
</script>

<style scoped>
.create-book {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 90%;
  text-align: center;
  padding-top: 50px;
}

.input-field {
  font-size: 1.2em;
  padding: 10px;
  margin: 10px auto;
  width: 22%;
  text-align: center;
  font-weight: bold;
}

button {
  font-size: 1.2em;
  padding: 10px;
  font-weight: bold;
  margin: 20px auto;
}

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
