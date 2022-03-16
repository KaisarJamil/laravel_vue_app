<template>
	<PageComponent>
		<template v-slot:header>
			<div class="flex justify-between items-center mt-3">
				<h1 class="text-3xl font-bold text-gray-900">Task</h1>
				<router-link :to="{name: 'TaskCreate'}" class="py-2 px-3 text-white bg-emerald-500 rounded-md hover:bg-emerald-700">
					<svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 -mt-1 inline-block" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
						<path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
					</svg>
					Create Task
				</router-link>
			</div>
		</template>

		<section class="px-0 py-10 bg-gray-100">
			<div class="max-w-5xl mx-auto">
				<h1 class="text-center text-xl font-bold text-red-600 pb-4"></h1>
				<!-- Information table -->
				<div class="flex flex-col">
					<div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
						<div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
							<div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
								<table class="min-w-full divide-y divide-gray-200">
									<thead class="bg-white">
										<tr class="text-left font-bold">
											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">S/N</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">TASK NAME</th>

											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">DESCRIPTION</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">DEADLINE</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">CREATED BY</th>
											<th scope="col" class="px-6 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">ACTION</th>
										</tr>
									</thead>
									<tbody>
										<tr v-for="(task, index) in tasks" :key="index" class="hover:bg-gray-100 focus-within:bg-gray-100" :class="index % 2 === 0 ? 'bg-white' : 'bg-gray-50'">
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.id }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.name }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.description.length > 50 ? task.description.substring(0, 50) + "..." : task.description }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.date }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ task.user.name }}</td>
											<td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
												<div class="flex justify-start items-center space-x-2">
													<router-link :to="{name: 'TaskView', params: {id: task.id}}">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
															<path stroke-linecap="round" stroke-linejoin="round" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
														</svg>
													</router-link>
													<button type="button" @click="deleteTask(task.id)">
														<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
															<path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
														</svg>
													</button>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
	</PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue"
import store from "../store"
import {computed} from "vue"
import {useRoute, useRouter} from "vue-router"

const tasks = computed(() => store.state.tasks.data)

store.dispatch("getTasks")

const router = useRouter()

function deleteTask(id) {
	if (confirm(`Are you sure you want to delete this task?`)) {
		store.dispatch("deleteTask", id).then(() => {
			router.push({
				name: "Tasks",
			})
		})
	}
}
</script>

<style scoped></style>
