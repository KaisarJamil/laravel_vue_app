<template>
	<div class="min-h-full">
		<Disclosure as="nav" class="bg-white shadow-sm" v-slot="{open}">
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-between h-16">
					<div class="flex">
						<div class="flex-shrink-0 flex items-center">
							<img class="block lg:hidden h-4 w-auto" src="https://mlzi9dlhpjs7.i.optimole.com/s99jFrI-sTzt5oxL/w:1020/h:150/q:auto/https://www.enkaizen.com/wp-content/uploads/2021/03/logo-150-1.png" alt="enkaizen" />
							<img class="hidden lg:block h-4 w-auto" src="https://mlzi9dlhpjs7.i.optimole.com/s99jFrI-sTzt5oxL/w:1020/h:150/q:auto/https://www.enkaizen.com/wp-content/uploads/2021/03/logo-150-1.png" alt="enkaizen" />
						</div>
						<div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
							<router-link v-for="item in navigation" :key="item.name" :to="item.to" active-class="border-indigo-500 text-gray-900" :class="[this.$route.name === item.to.name ? '' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300', 'inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium']">{{ item.name }}</router-link>
						</div>
					</div>
					<div class="hidden sm:ml-6 sm:flex sm:items-center">
						<button type="button" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
							<span class="sr-only">View notifications</span>
							<BellIcon class="h-6 w-6" aria-hidden="true" />
						</button>

						<!-- Profile dropdown -->
						<Menu as="div" class="ml-3 relative">
							<div>
								<MenuButton class="bg-white flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
									<span class="sr-only">Open user menu</span>
									<img class="h-8 w-8 rounded-full" :src="user.imageUrl" alt="" />
								</MenuButton>
							</div>
							<transition enter-active-class="transition ease-out duration-200" enter-from-class="transform opacity-0 scale-95" enter-to-class="transform opacity-100 scale-100" leave-active-class="transition ease-in duration-75" leave-from-class="transform opacity-100 scale-100" leave-to-class="transform opacity-0 scale-95">
								<MenuItems class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none">
									<MenuItem v-slot="{}">
										<a @click="logout" :class="['block px-4 py-2 text-sm text-gray-700 cursor-pointer']">Sign out</a>
									</MenuItem>
								</MenuItems>
							</transition>
						</Menu>
					</div>
					<div class="-mr-2 flex items-center sm:hidden">
						<!-- Mobile menu button -->
						<DisclosureButton class="bg-white inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
							<span class="sr-only">Open main menu</span>
							<MenuIcon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
							<XIcon v-else class="block h-6 w-6" aria-hidden="true" />
						</DisclosureButton>
					</div>
				</div>
			</div>

			<DisclosurePanel class="sm:hidden">
				<div class="pt-2 pb-3 space-y-1">
					<router-link v-for="item in navigation" :key="item.name" as="a" :to="item.to" active-class="bg-indigo-50 border-indigo-500 text-indigo-700" :class="[this.$route.name === item.to.name ? '' : 'border-transparent text-gray-600 hover:bg-gray-50 hover:border-gray-300 hover:text-gray-800', 'block pl-3 pr-4 py-2 border-l-4 text-base font-medium']">{{ item.name }}</router-link>
				</div>
				<div class="pt-4 pb-3 border-t border-gray-200">
					<div class="flex items-center px-4">
						<div class="flex-shrink-0">
							<img class="h-10 w-10 rounded-full" :src="user.imageUrl" alt="" />
						</div>
						<div class="ml-3">
							<div class="text-base font-medium text-gray-800">{{ user.name }}</div>
							<div class="text-sm font-medium text-gray-500">{{ user.email }}</div>
						</div>
						<button type="button" class="ml-auto bg-white flex-shrink-0 p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
							<span class="sr-only">View notifications</span>
							<BellIcon class="h-6 w-6" aria-hidden="true" />
						</button>
					</div>
					<div class="mt-3 space-y-1">
						<DisclosureButton as="a" @click="logout" class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 cursor-pointer">Sign out </DisclosureButton>
					</div>
				</div>
			</DisclosurePanel>
		</Disclosure>
		<router-view></router-view>
	</div>
</template>

<script>
import {Disclosure, DisclosureButton, DisclosurePanel, Menu, MenuButton, MenuItem, MenuItems} from "@headlessui/vue"
import {BellIcon, MenuIcon, XIcon} from "@heroicons/vue/outline"
import {useStore} from "vuex"
import {computed} from "vue"
import {useRouter} from "vue-router"

const navigation = [
	{name: "Dashboard", to: {name: "Dashboard"}},
	{name: "Task Lists", to: {name: "TaskList"}},
]

export default {
	components: {
		Disclosure,
		DisclosureButton,
		DisclosurePanel,
		Menu,
		MenuButton,
		MenuItem,
		MenuItems,
		BellIcon,
		MenuIcon,
		XIcon,
	},
	setup() {
		const store = useStore()
		const router = useRouter()
		function logout() {
			store.dispatch("logout").then(() => {
				router.push({
					name: "Login",
				})
			})
		}
		return {
			user: computed(() => store.state.user.data),
			navigation,
			logout,
		}
	},
}
</script>
