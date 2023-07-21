<template>
  <div class="display-books">
    <table class="display-books-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Title</th>
          <th>Author</th>
          <th>Year Published</th>
          <th>Genre</th>
        </tr>
      </thead>
      <tbody>
        <!--conditonal html is weird and painful-->
        <tr v-if="books.length === 0">
          <td colspan="5">No books found, add a book!</td>
        </tr>
        <tr v-else v-for="book in books" :key="book.id">
          <td>{{ book.id }}</td>
          <td>{{ book.title }}</td>
          <td>{{ book.author }}</td>
          <td>{{ book.year_published }}</td>
          <td>{{ book.genre }}</td>
        </tr>
      </tbody>
    </table>

    <!--sccess mssage -->
    <div v-if="message && !error" class="message success">
      {{ message }}
    </div>

    <!--error message -->
    <div v-if="message && error" class="message error">
      {{ message }}
    </div>
  </div>
</template>

<script>
import { watch } from 'vue';
export default {
  data() {
    return {
      books: [],
      message: '',
      error: false
    }
  },
  created() {
    this.displayBooks();
  },
  mounted() {
    //state management works?
    watch(() => this.$store.state.refreshBooks, () => {
      this.displayBooks();
      console.log('Vuex state changed wow'); 
    }, { immediate: true });
  },

  methods: {
      async displayBooks() {
      const response = await fetch('http://localhost:8083', {
        method: 'GET'
      });
      if (response.ok) {
        let text = await response.text();
        console.log('Response Text:', text); //debug
        if (text.length > 0) {
          try {
            const data = JSON.parse(text);
            console.log('Fetched books:', this.books); //debug
            this.books = data.books ? data.books : [];
            this.message = '';
            this.error = false;
            this.$store.commit('setRefreshBooks', false); //3 hours of work only to add this line
          } catch (err) {
            //do nothing because everything is meaningless
          }
        }
      } else {
        this.message = `failed to fetch books. HTTP request failed with status ${response.status}`;
        this.error = true;
      }
    }
  }
}
</script>
  
<style scoped>
.display-books {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding-top: 30px;
}

.display-books-table {
  margin-left: auto;
  margin-right: auto;
  width: 20%; 
  border-collapse: collapse;
  overflow-y: scroll;
  display: block;
  max-height: 400px;
}

.display-books-table th,
.display-books-table td {
  border: 1px solid #ddd;
  padding: 8px;
  text-align: left;
  color: #fff;  /*white actually */
}

.display-books-table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}

/*message stuff*/
.message {
  margin-top: 1em;
  padding: 1em;
  border-radius: 5px;
  width: 70%;
  text-align: center;
  font-weight: bold;
  color: white;
}

.message.success {
  background-color: #4CAF50;
}

.message.error {
  background-color: #f44336;
}
</style>
