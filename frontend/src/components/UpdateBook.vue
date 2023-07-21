<template>
  <div class="update-book-form">
    <input type="text" v-model="id" placeholder="Enter existing book ID" />
    <input type="text" v-model="newTitle" placeholder="Enter new book title" />
    <input type="text" v-model="author" placeholder="Enter new author name" />
    <input type="text" v-model="year_published" placeholder="Enter new year published" />
    <input type="text" v-model="genre" placeholder="Enter new genre" />
    <button @click="updateBook">Update Book</button>

    <!-- success message yipee-->
    <div v-if="message && !error" class="message success">
      {{ message }}
    </div>

    <!-- rror -->
    <div v-if="message && error" class="message error">
      {{ message }}
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      //json stuff
      id: '',
      newTitle: '',
      author: '',
      year_published: '',
      genre: '',
      message: '',
      error: false
    }
  },
  methods: {
    async updateBook() {
      //how did this endpoint work im so happy
      const response = await fetch(`http://localhost:8083?id=${encodeURIComponent(this.id)}`, {
        method: 'PUT',
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          title: this.newTitle,
          author: this.author,
          year_published: this.year_published,
          genre: this.genre
        })
      });

      if (response.ok) {
        this.id = '';
        this.newTitle = '';
        this.author = '';
        this.year_published = '';
        this.genre = '';
        this.message = 'Book updated successfully';
        this.error = false;
        //error handling is my hobby
      } else {
        this.message = 'Error updating book. HTTP request failed with status ' + response.status;
        this.error = true;
      }
    }
  }
}
</script>

<style scoped>
.update-book-form {
  display: flex;
  flex-direction: row;
  align-items: center;
  justify-content: center;
  padding-top: 30px;
}

.update-book-form input, .update-book-form button {
  font-size: 1.5em;
  padding: 5px;
  width: 15%;  /*ajusted width */
  margin: 2px 0;
  text-align: center;
}

.update-book-form button {
  cursor: pointer;
  background-color: #4CAF50; /*greer*/
  border: none;
  color: white;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  transition-duration: 0.4s;
}

.update-book-form button:hover {
  background-color: #45a049;
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
