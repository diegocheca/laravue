<template>
  <section class="todoapp">
    <!-- header -->
    <header class="header">
      <input class="new-todo" autocomplete="off" placeholder="Todo List" @keyup.enter="addTodo">
    </header>
    <!-- main section -->
    <section v-show="todos.length" class="main">
      <input id="toggle-all" :checked="allChecked" class="toggle-all" type="checkbox" @change="toggleAll({ done: !allChecked })">
      <label for="toggle-all" />
      <ul class="todo-list">
        <todo
          v-for="(todo, index) in filteredTodos"
          :key="index"
          :todo="todo"
          @toggleTodo="toggleTodo"
          @editTodo="editTodooooopp"
          @deleteTodo="deleteTodoPadre"
        />
      </ul>
    </section>
    <!-- footer -->
    <footer v-show="todos.length" class="footer">
      <span class="todo-count">
        <strong>{{ remaining }}</strong>
        {{ remaining | pluralize('item') }} left
      </span>
      <ul class="filters">
        <li v-for="(val, key) in filters" :key="key">
          <a :class="{ selected: visibility === key }" @click.prevent="visibility = key">{{ key | capitalize }}</a>
        </li>
      </ul>
      <!-- <button class="clear-completed" v-show="todos.length > remaining" @click="clearCompleted">
        Clear completed
      </button> -->
    </footer>
  </section>
</template>

<script>
import Todo from './Todo.vue';
const axios = require('axios');
const STORAGE_KEY = 'todos';
const filters = {
  todas: todos => todos,
  haciendo: todos => todos.filter(todo => todo.OrdenTrabajo_Estado === 0),
  completas: todos => todos.filter(todo => todo.OrdenTrabajo_Estado === 1),
};
const defalutList = [
  { text: 'star this repository', done: false, OrdenTrabajo_Estado: 0, id: 1 },
  { text: 'fork this repository', done: false, OrdenTrabajo_Estado: 0, id: 2 },
  { text: 'follow author', done: false, OrdenTrabajo_Estado: 0, id: 3 },
  { text: 'laravue', done: true, OrdenTrabajo_Estado: 1, id: 4 },
  { text: 'laravel', done: true, OrdenTrabajo_Estado: 1, id: 5 },
  { text: 'vue', done: true, OrdenTrabajo_Estado: 1, id: 6 },
  { text: 'axios', done: true, OrdenTrabajo_Estado: 1, id: 7 },
  { text: 'webpack', done: true, OrdenTrabajo_Estado: 1, id: 8 },
];
export default {
  components: { Todo },
  filters: {
    pluralize: (n, w) => n === 1 ? w : w + 's',
    capitalize: s => s.charAt(0).toUpperCase() + s.slice(1),
  },
  data() {
    return {
      ordenes_de_trabajo: [],
      visibility: 'todas',
      filters,
      // todos: JSON.parse(window.localStorage.getItem(STORAGE_KEY)) || defalutList
      todos: defalutList,
    };
  },
  computed: {
    allChecked() {
      return this.todos.every(todo => todo.done);
    },
    filteredTodos() {
      return filters[this.visibility](this.todos);
    },
    remaining() {
      return this.todos.filter(todo => !todo.done).length;
    },
  },
  mounted: function() {
    this.prueba();
  },
  methods: {
    setLocalStorage() {
      window.localStorage.setItem(STORAGE_KEY, JSON.stringify(this.todos));
    },
    addTodo(e) {
      const text = e.target.value;
      if (text.trim()) {
        this.todos.push({
          text,
          done: false,
        });
        this.setLocalStorage();
      }
      e.target.value = '';
    },
    toggleTodo(val) {
      if (val.OrdenTrabajo_Estado === 1){
        val.OrdenTrabajo_Estado = 0;
      } else {
        val.OrdenTrabajo_Estado = 1;
      }
      this.setLocalStorage();
    },
    deleteTodoPadre(orden_a_borrar) {
      axios.post('/updateOrdenTrabajodashboard', {
        name: orden_a_borrar.description,
        description: orden_a_borrar.name,
        id: orden_a_borrar.id,
      })
        .then(function(response) {
          console.log('respuesta correcta desde el servidor al actualizar orden');
          console.log(response.data);
        })
        .catch(function(error) {
          console.log('catch del error');
          console.log(error.data);
        });
    },
    editTodooooopp({ todo, value }) {
      console.log('hola desde el padre');
      console.log(todo);
      todo.text = value;
      this.setLocalStorage();
    },
    clearCompleted() {
      this.todos = this.todos.filter(todo => !todo.done);
      this.setLocalStorage();
    },
    toggleAll({ done }) {
      this.todos.forEach(todo => {
        todo.done = done;
        this.setLocalStorage();
      });
    },
    prueba() {
      const url = 'http://localhost:8000/ordenesdashboard';
      axios.get(url, { headers: { 'Content-Type': 'application/json' }})
        .then((response) => {
          this.ordenes_de_trabajo = response.data;
          console.log(this.ordenes_de_trabajo);
        })
        .catch(function(error) {
          // handle error
          console.log('NO traje ordenes error:');
          console.log(error);
        });
    },
  },
};
</script>

<style lang="scss">
  @import './index.scss';
</style>
