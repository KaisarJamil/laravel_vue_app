<template>
	<div>
		<img class="mx-auto h-12 w-auto" src="https://mlzi9dlhpjs7.i.optimole.com/s99jFrI-sTzt5oxL/w:1020/h:150/q:auto/https://www.enkaizen.com/wp-content/uploads/2021/03/logo-150-1.png" alt="Workflow" />
		<h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">Sign in to your account</h2>
		<p class="mt-2 text-center text-md text-gray-600">
			Or
			<router-link :to="{name: 'Register'}" class="font-medium text-indigo-600 hover:text-indigo-500"> register for free </router-link>
		</p>
	</div>
	<form class="mt-8 space-y-6" @submit="login">
		<input type="hidden" name="remember" value="true" />
		<div class="rounded-md shadow-sm -space-y-px">
			<div>
				<label for="email-address" class="sr-only">Email address</label>
				<input id="email-address" name="email" type="email" autocomplete="email" v-model="user.email" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-t-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Email address" />
			</div>
			<div>
				<label for="password" class="sr-only">Password</label>
				<input id="password" name="password" type="password" autocomplete="current-password" v-model="user.password" required="" class="appearance-none rounded-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-b-md focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 sm:text-sm" placeholder="Password" />
			</div>
		</div>

		<div class="flex items-center justify-between">
			<div class="flex items-center">
				<input id="remember-me" name="remember-me" type="checkbox" v-model="user.remember" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
				<label for="remember-me" class="ml-2 block text-sm text-gray-900"> Remember me </label>
			</div>
		</div>

		<div>
			<button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
				<span class="absolute left-0 inset-y-0 flex items-center pl-3">
					<LockClosedIcon class="h-5 w-5 text-indigo-500 group-hover:text-indigo-400" aria-hidden="true" />
				</span>
				Sign in
			</button>
		</div>
	</form>
</template>

<script setup>
import {LockClosedIcon} from "@heroicons/vue/solid"
import {useRouter} from "vue-router"
import store from "../store"

const user = {
	email: "",
	password: "",
	remember: false,
}

const router = useRouter()
function login(ev) {
	ev.preventDefault()
	store.dispatch("login", user).then(() => {
		//return response and direct to dashboard
		router.push({
			name: "Dashboard",
		})
	})
}
</script>
