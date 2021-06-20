<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Diseases
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
					<jet-section-title>
						<template #title>
							<strong>Add Disease</strong>
						</template>
					</jet-section-title>
	
					<form @submit.prevent="createDisease">
						<div class="mt-3">
							<jet-label for="name" value="Name" />
							<jet-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
						</div>
						
						<div class="mt-3">
							<jet-label for="description" value="Description" />
							<jet-textarea id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
						</div>

						<div class="flex items-center justify-end mt-4">
							<jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
								Add Disease
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
import JetActionMessage from '@/Jetstream/ActionMessage'
import JetFormSection from '@/Jetstream/FormSection'
import JetInputError from '@/Jetstream/InputError'
import JetLabel from '@/Jetstream/Label'
import JetTextarea from '@/Jetstream/Textarea'
import JetSectionTitle from '@/Jetstream/SectionTitle'

import { Inertia } from '@inertiajs/inertia'

export default {
	metaInfo: { title: 'Diseases' },
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
	data() {
		return {
			form: this.$inertia.form({
				name:  '',
				description: ''
			}),
		}
	},
	watch: {
	},
	methods: {
		createDisease() {
			this.form.post('/diseases', {
				errorBag: 'createDisease',
				preserveScroll: true,
				onSuccess: () => this.form.reset(),
				onError: () => {
					if (this.form.errors.name) {
						this.form.reset('name')
						this.$refs.name.focus()
					}

					if (this.form.errors.description) {
						this.form.reset('description')
						this.$refs.description.focus()
					}
				}
			});
		}
	},
}
</script>
