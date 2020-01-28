<template>
  <div>
    <form @submit.prevent="addNewTodo">
      <input type="text" v-model="newtodo" :disabled="isAddingNew" />
      <button type="submit" :disabled="isAddingNew">Ekle</button>
    </form>
    <ul>
      <li
        v-for="todo in todos"
        :key="todo.id"
        @click="toggle(todo.id)"
        :class="{'completed': todo.completed_at}"
      >
        <span v-if="todo.completed_at">✅</span>
        <span v-else>⭕️</span>
        {{todo.text}}
      </li>
    </ul>
  </div>
</template>

<script>
export default {
  data() {
    return {
      newtodo: "",
      todos: [],
      isAddingNew: false
    };
  },
  methods: {
    toggle(id) {
      const todoIndex = this.todos.findIndex(item => item.id == id);
      if (todoIndex == -1) return false;

      axios
        .put(`http://oyk2020.kis/api/todos/${id}/toggle`)
        .then(response => {
          this.todos[todoIndex].completed_at = response.data.completed_at;
        })
        .catch(response => {
          console.error(response);
        });
    },
    fetchTodos() {
      axios
        .get("http://oyk2020.kis/api/todos")
        .then(response => {
          this.todos = response.data;
        })
        .catch(response => {
          console.error(response);
        });
    },
    addNewTodo() {
      if (this.newtodo.length < 3) return false;
      this.isAddingNew = true;
      axios
        .post("http://oyk2020.kis/api/todos", {
          todo: this.newtodo
        })
        .then(response => {
          this.todos.unshift(response.data);
          this.newtodo = "";
        })
        .catch(response => {
          console.error(response);
        })
        .then(() => {
          this.isAddingNew = false;
        });
    }
  },
  beforeMount() {
    axios.defaults.headers.common["Authorization"] =
      "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9veWsyMDIwLmtpc1wvYXBpXC9hdXRoXC9sb2dpbiIsImlhdCI6MTU4MDExNTM0OCwibmJmIjoxNTgwMTE1MzQ4LCJqdGkiOiJ4M2RmYU1pbXZBdXZSQnFyIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.UKP_5ZiPoAESss2w28-eYavIQRmX9KjcRZdNRcbuPu0";
    this.fetchTodos();
  }
};
</script>

<style>
.completed {
  text-decoration: line-through;
}
</style>