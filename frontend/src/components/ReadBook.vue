<!--vue boilerplate is awesome everything is the same yay-->

<template>
  <div class="read-books">
    <h2>Book Catalog</h2>
    <div class="search-container">
      <input v-model="searchID" type="text" placeholder="Enter book ID" />
      <!--fetch  function for the api-->
      <button @click="fetchBookDetails">Search</button>
    </div>
    <div v-if="book">
      <div class="book-details">
        <h3 class="book-title">Title: {{ book.title }}</h3>
        <p class="book-author">Author: {{ book.author }}</p>
        <p class="book-year">Year Published: {{ book.year_published }}</p>
        <p class="book-genre">Genre: {{ book.genre }}</p>
      </div>
    </div>
    <div v-else>
      <p>No book found.</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      searchID: '',
      book: null
    }
  },
  methods: {
    async fetchBookDetails() {
      console.log('fetchBookDetails called');
      const response = await fetch(`http://localhost:8083/?id=${encodeURIComponent(this.searchID)}`);
      console.log('response', response);
      const data = await response.json();
      console.log('data', data);

      if (response.ok) {
        this.book = data.book;
        console.log('holy shit it worked', this.book);
      } else {
        console.log(`failed to fetch book with ID ${this.searchID}. HTTP request failed with status ${response.status} you suck`);
        this.book = null;
      }
    }
  }
}
</script>

<style scoped>

/*random css styles get UI to look pretty through brute force of trying different numbers and differet things */
.read-books {
  max-width: 800px;
  margin: 0 auto;
  padding-top: 50px;
}

h2 {
  text-align: center;
  margin-bottom: 30px;
}

.search-container {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.search-container input {
  padding: 10px;
  margin-right: 10px;
}

.search-container button {
  padding: 10px 20px;
  cursor: pointer;
}

.book-details {
  color: white;
  border: 1px solid #ddd;
  border-radius: 5px;
  padding: 20px;
  display: flex;
  flex-direction: column;
}

.book-title {
  font-weight: bold;
  margin-bottom: 10px;
}

.book-author {
  font-style: italic;
  margin-bottom: 5px;
}

.book-year {
  font-weight: bold;
  margin-bottom: 5px;
}

.book-genre {
  text-transform: uppercase;
  font-weight: bold;
  margin-bottom: 5px;
}
</style>
