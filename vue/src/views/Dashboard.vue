<template>
	<PageComponent title="Dashboard">
		<template v-slot:header>
			<div class="max-w-7xl mx-auto flex flex-col justify-center items-center px-4 sm:px-6 md:px-8 mt-20">
				<div class="flex">
					<p class="text-3xl font-semibold text-blue-500 pt-3">Save Your Tasks Here & Forget the memorizing</p>
				</div>
				<h2 class="text-xl text-center pt-6 font-semibold text-black-700">Welcome to Dashboard !</h2>
			</div>
		</template>
	</PageComponent>
</template>

<script setup>
import PageComponent from "../components/PageComponent.vue"
</script>

<style scoped></style>
