<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Manage Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
				
					<jet-section-title>
						<template #title>
							<strong>Edit User</strong>
						</template>
					</jet-section-title>
	
					<form @submit.prevent="updateUser">
						<div class="mt-3">
							<jet-label for="first_name" value="First Name" />
							<jet-input id="first_name" type="text" class="mt-1 block w-full" v-model="form.first_name" required autofocus autocomplete="first_name" />
						</div>

                        <div class="mt-3">
							<jet-label for="last_name" value="Last Name" />
							<jet-input id="last_name" type="text" class="mt-1 block w-full" v-model="form.last_name" required autofocus autocomplete="last_name" />
						</div>

                        <div class="mt-3">
							<jet-label for="email" value="Email" />
							<jet-input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
						</div>

                        <div class="mt-4">
                            <jet-label for="role" value="Role" />
                            <select name="role" v-model="form.role" required autofocus autocomplete="role" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                <option value="1">User</option>
                                <option value="2">Admin</option>
                            </select>
                        </div>

						<div class="flex items-center justify-end mt-4">
                            <inertia-link :href="route('manage.index')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                Back
                            </inertia-link>
							<jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Edit User
							</jet-button>
						</div>
					</form>

                </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout'

import Icon from '@/Shared/Icon'
import JetButton from '@/Jetstream/Button'
import JetInput from '@/Jetstream/Input'
import JetFormSection from '@/Jetstream/FormSection'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetTextarea from '@/Jetstream/Textarea'
import JetSectionTitle from '@/Jetstream/SectionTitle'

export default {
	metaInfo: { title: 'Users' },
	components: {
		Icon,
		AppLayout,
		JetButton,
		JetInput,
		JetInputError,
		JetLabel,
		JetFormSection,
		JetTextarea,
		JetSectionTitle
	},
	props: {
		user: {
			type: Object,
			required: true,
		},
	},
	data() {
		return {
			form: this.$inertia.form({
				first_name:  this.user.first_name,
				last_name:  this.user.last_name,
				email:  this.user.email,
				role: this.user.role
			}),
		}
	},
	watch: {
	},
	methods: {
		updateUser() {
			this.form.patch('/users/manage/' + this.user.id, {
				errorBag: 'updateUser',
				preserveScroll: true,
				//onSuccess: () => this.form.reset(),
				onError: () => {
					if (this.form.errors.first_name) {
						this.form.reset('first_name', this.user.first_name)
						this.$refs.first_name.focus()
					}

                    if (this.form.errors.last_name) {
						this.form.reset('last_name', this.user.last_name)
						this.$refs.last_name.focus()
					}

                    if (this.form.errors.email) {
						this.form.reset('email', this.user.email)
						this.$refs.email.focus()
                    }

					if (this.form.errors.role) {
						this.form.reset('role', this.user.role)
						this.$refs.role.focus()
					}
				}
			});
		}
	},
}
</script>
