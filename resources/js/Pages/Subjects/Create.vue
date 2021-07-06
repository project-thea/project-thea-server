<template>
    <app-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Subjects
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4">
                    <jet-section-title>
                        <template #title>
                            <strong>Add Subject</strong>
                        </template>
                    </jet-section-title>
	
                    <form @submit.prevent="createSubject">
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
                                <jet-input id="email" type="text" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="email" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="date_of_birth" value="Date of Birth" />
                                <jet-input id="date_of_birth" type="text" class="mt-1 block w-full" v-model="form.date_of_birth" required autofocus autocomplete="date_of_birth" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="phone" value="Phone Number" />
                                <jet-input id="phone" type="tel" class="mt-1 block w-full" v-model="form.phone" required autofocus autocomplete="phone" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="next_of_kin" value="Next Of Kin" />
                                <jet-input id="next_of_kin" type="text" class="mt-1 block w-full" v-model="form.next_of_kin" required autofocus autocomplete="next_of_kin" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="next_of_kin_phone" value="Next Of Kin Phone Number" />
                                <jet-input id="next_of_kin_phone" type="tel" class="mt-1 block w-full" v-model="form.next_of_kin_phone" required autofocus autocomplete="next_of_kin_phone" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="id_number" value="ID Number" />
                                <jet-input id="id_number" type="text" class="mt-1 block w-full" v-model="form.id_number" required autofocus autocomplete="id_number" />
                            </div>

                            <div class="mt-3">
                                <jet-label for="id_type" value="ID Type" />
                                <select name="id_type" v-model="form.id_type" required autofocus autocomplete="id_type" class="mt-1 block w-full border-gray-300 focus:border-indigo-300 focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow sm">
                                    <option value="National ID">National ID</option>
                                    <option value="Drivers License">Drivers License</option>
                                </select>
                            </div>
                            
                            <div class="mt-3">
                                <jet-label for="nationality" value="Nationality" />
                                <jet-input id="nationality" type="text" class="mt-1 block w-full" v-model="form.nationality" required autofocus autocomplete="nationality" />
                            </div>
                            
                            <div class="flex items-center justify-end mt-4">
                                <inertia-link :href="route('subjects')" class="underline text-sm text-gray-600 hover:text-gray-900">
                                    Back
                                </inertia-link>
                                <jet-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Add Subject
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
    metaInfo: { title: 'Subjects' },
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
                first_name:  '',
                last_name:  '',
                email:  '',
                date_of_birth:  '',
                phone:  '',
                next_of_kin:  '',
                next_of_kin_phone:  '',
                id_number:  '',
                id_type: '',
                nationality: ''
            }),
        }
    },
    watch: {
    },
    methods: {
        createSubject() {
            this.form.post('/subjects', {
                errorBag: 'createSubject',
                preserveScroll: true,
                onSuccess: () => this.form.reset(),
                onError: () => {
                    if (this.form.errors.first_name) {
                        this.form.reset('first_name')
                        this.$refs.first_name.focus()
                    }

                    if (this.form.errors.last_name) {
                        this.form.reset('last_name')
                        this.$refs.last_name.focus()
                    }

                    if (this.form.errors.email) {
                        this.form.reset('email')
                        this.$refs.email.focus()
                    }

                    if (this.form.errors.date_of_birth) {
                        this.form.reset('date_of_birth')
                        this.$refs.date_of_birth.focus()
                    }

                    if (this.form.errors.phone) {
                        this.form.reset('phone')
                        this.$refs.phone.focus()
                    }

                    if (this.form.errors.next_of_kin) {
                        this.form.reset('next_of_kin')
                        this.$refs.next_of_kin.focus()
                    }

                    if (this.form.errors.next_of_kin_phone) {
                        this.form.reset('next_of_kin_phone')
                        this.$refs.next_of_kin_phone.focus()
                    }

                    if (this.form.errors.id_number) {
                        this.form.reset('id_number')
                        this.$refs.id_number.focus()
                    }

                    if (this.form.errors.id_type) {
                        this.form.reset('id_type')
                        this.$refs.id_type.focus()
                    }

                    if (this.form.errors.nationality) {
                        this.form.reset('nationality')
                        this.$refs.nationality.focus()
                    }
                }
            });
        }
    },
}
</script>
