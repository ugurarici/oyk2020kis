<template>
  <div id="todos" v-else>
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
    this.fetchTodos();
  }
};
</script>

<style>
.completed {
  text-decoration: line-through;
}
</style>