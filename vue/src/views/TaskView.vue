<template>
	<PageComponent>
		<template v-slot:header>
			<div class="flex items-center justify-between">
				<h1 class="text-3xl font-bold text-gray-900">
					{{ model.id ? model.name : "Create a Task" }}
				</h1>
			</div>
		</template>

		<form @submit.prevent="saveTask">
			<div>
				<!-- Name -->
				<div class="col-span-3 sm:col-span-2">
					<label for="name" class="block text-sm font-medium text-gray-700"> Name </label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<input type="text" name="name" id="name" v-model="model.name" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="Task name" />
					</div>
					<!-- <span v-if="model.errors.name" class="flex items-center justify-center p-2 text-center text-red-700">{{ model.errors.name }}</span> -->
				</div>

				<!-- description -->
				<div class="col-span-3 sm:col-span-2 pt-4">
					<label for="description" class="block text-sm font-medium text-gray-700"> Description </label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<textarea type="text" name="description" rows="4" id="description" v-model="model.description" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="description" />
					</div>
					<!-- <span v-if="model.errors.description" class="flex items-center justify-center p-2 text-center text-red-700">{{ model.errors.description }}</span> -->
				</div>

				<!-- Date -->
				<div class="col-span-3 sm:col-span-2 pt-4">
					<label for="date" class="block text-sm font-medium text-gray-700"> Passing Date</label>
					<div class="mt-1 flex rounded-md shadow-sm">
						<input type="date" name="date" id="date" v-model="model.date" class="focus:ring-indigo-500 focus:border-indigo-500 flex-1 block w-full rounded-none rounded-md sm:text-sm border-gray-300" placeholder="Date" />
					</div>
					<!-- <span v-if="model.errors.date" class="flex items-center justify-center p-2 text-center text-red-700">{{ model.errors.date }}</span> -->
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
			name: "TaskView",
			params: {
				id: data.data.id,
			},
		})
	})
}
</script>

<style scoped></style>
