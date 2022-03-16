<template>
	<PageComponent>
		<template v-slot:header>
			<div class="flex items-center justify-between">
				<h1 class="text-3xl font-bold text-gray-900">
					{{ route.params.id ? model.name : "Create a Task" }}
				</h1>
			</div>
			<button v-if="route.params.id" type="button" @click="deleteTask()" class="py-2 px-3 text-white bg-red-500 float-right rounded-md hover:bg-red-600">
				<svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 -mt-1 inline-block" viewBox="0 0 20 20" fill="currentColor">
					<path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
				</svg>
				Delete Task
			</button>
		</template>
		<div v-if="taskLoading" class="flex justify-center">Loading...</div>

		<form @submit.prevent="saveTask">
			<div>
				<!-- Name -->
				<div class="col-span-3 sm:col-span-2">
					<label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<input type="text" name="name" id="name" v-model="model.name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="Task name" />
					</div>
				</div>

				<!-- description -->
				<div class="col-span-3 sm:col-span-2 pt-4">
					<label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<textarea type="text" name="description" rows="4" id="description" v-model="model.description" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="description" />
					</div>
				</div>

				<!-- Date -->
				<div class="col-span-3 sm:col-span-2 pt-4">
					<label for="date" class="block text-sm font-medium text-gray-700"> Passing Date</label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<input type="date" name="date" id="date" v-model="model.date" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="Date" />
					</div>
				</div>

				<div class="px-0 py-4 bg-gray-50 border-t border-gray-100 flex justify-end items-center">
					<button class="bg-indigo-500 px-4 py-2 text-white font-bold rounded hover:bg-green-500 transition" type="submit">Save</button>
				</div>
			</div>
		</form>
	</PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue"
import {computed, ref, watch} from "vue"
import {useRoute, useRouter} from "vue-router"
import store from "../store"

const router = useRouter()
const route = useRoute()

const taskLoading = computed(() => store.state.currentTask.loading)

// Create empty task
let model = ref({
	name: "",
	description: "",
	date: "",
})

watch(
	() => store.state.currentTask.data,
	(newVal, oldVal) => {
		model.value = {
			...JSON.parse(JSON.stringify(newVal)),
		}
	}
)

if (route.params.id) {
	store.dispatch("getTask", route.params.id)
}

function saveTask() {
	store.dispatch("saveTask", model.value).then(({data}) => {
		router.push({
			name: "TaskList",
		})
	})
}

function deleteTask() {
	if (confirm(`Are you sure you want to delete this task?`)) {
		store.dispatch("deleteTask", model.value.id).then(() => {
			router.push({
				name: "TaskList",
			})
		})
	}
}
</script>

<style scoped></style>
