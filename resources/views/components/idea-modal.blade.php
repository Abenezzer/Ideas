<div x-data="{
    open: false,
    links: [],
    newLink: '',
    steps: [],
    newStep: '',
    addLink() {
        let url = this.newLink.trim();
        if (url === '') return;
        if (!/^https?:\/\//i.test(url)) {
            url = 'https://' + url;
        }
        if (!this.links.includes(url)) {
            this.links.push(url);
        }
        this.newLink = '';
    },
    removeLink(index) {
        this.links.splice(index, 1);
    },
    addStep() {
        let stepText = this.newStep.trim();
        if (stepText === '') return;

        // Allow duplicate step names if necessary, just push to array
        this.steps.push(stepText);
        this.newStep = '';
    },
    removeStep(index) {
        this.steps.splice(index, 1);
    }
}" class="inline-block">

    <button @click="open = true"
        class="bg-indigo-600 hover:bg-indigo-500 text-white font-medium px-5 py-2.5 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-950">
        Create an Idea
    </button>

    <div x-show="open" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/75 backdrop-blur-sm"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-cloak>
        <div @click.away="open = false" @keydown.escape.window="open = false"
            class="bg-gray-900 border border-gray-800 w-full max-w-6xl rounded-xl shadow-2xl overflow-hidden flex flex-col h-auto max-h-[90vh]"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95 transform"
            x-transition:enter-end="opacity-100 scale-100 transform"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100 transform"
            x-transition:leave-end="opacity-0 scale-95 transform">
            <div class="px-8 py-5 border-b border-gray-800 flex items-center justify-between">
                <div>
                    <h3 class="text-xl font-bold text-gray-100">Create New Idea</h3>
                    <p class="text-sm text-gray-400 mt-1">Share your thoughts, set a status, and map out the details.
                    </p>
                </div>
                <button type="button" @click="open = false"
                    class="text-gray-400 hover:text-gray-200 p-2 hover:bg-gray-800 rounded-lg transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <form action="/ideas" method="POST" class="flex flex-col flex-1 min-h-0">
                @csrf

                <template x-for="(link, index) in links" :key="'link-input-' + index">
                    <input type="hidden" name="links[]" :value="link">
                </template>

                <template x-for="(step, index) in steps" :key="'step-input-' + index">
                    <input type="hidden" name="steps[]" :value="step">
                </template>

                <div class="p-8 grid grid-cols-1 lg:grid-cols-3 gap-8 overflow-y-auto max-h-[60vh]">

                    <div class="lg:col-span-2 space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-semibold text-gray-300 mb-2">Title</label>
                            <input type="text" id="title" name="title" required
                                placeholder="What is your brilliant idea called?"
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors text-lg">
                        </div>

                        <div>
                            <label for="description"
                                class="block text-sm font-semibold text-gray-300 mb-2">Description</label>
                            <textarea id="description" name="description" rows="12" required
                                placeholder="Dive deep into the details, requirements, and specifications..."
                                class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3 text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none"></textarea>
                        </div>
                    </div>

                    <div class="space-y-6">

                        <div class="bg-gray-950/50 p-6 rounded-xl border border-gray-800/80 space-y-4">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Idea Properties</h4>
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Initial
                                    Status</label>
                                <select id="status" name="status"
                                    class="w-full bg-gray-800 border border-gray-700 rounded-lg px-3 py-2.5 text-gray-100 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors cursor-pointer">
                                    <option selected value="pending">⏳ Pending</option>
                                    <option value="in_progress">⚡ In Progress</option>
                                    <option value="completed">✅ Complete</option>
                                </select>
                            </div>
                        </div>

                        <div class="bg-gray-950/50 p-6 rounded-xl border border-gray-800/80 space-y-4 flex flex-col">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Implementation Steps
                            </h4>

                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1 empty:hidden">
                                <template x-for="(step, index) in steps" :key="index">
                                    <div
                                        class="flex items-start justify-between bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-200">
                                        <div class="flex items-start min-w-0 mr-2">
                                            <span
                                                class="text-xs font-bold bg-gray-700 text-gray-400 rounded-md px-1.5 py-0.5 mr-2 mt-0.5 select-none"
                                                x-text="index + 1"></span>
                                            <span class="truncate text-gray-200" x-text="step"></span>
                                        </div>
                                        <button type="button" @click="removeStep(index)"
                                            class="text-gray-400 hover:text-red-400 p-0.5 rounded transition-colors focus:outline-none shrink-0"
                                            title="Remove Step">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <div>
                                <label for="step_input" class="block text-sm font-medium text-gray-300 mb-2">Add Next
                                    Step</label>
                                <div class="flex space-x-2">
                                    <input type="text" id="step_input" x-model="newStep"
                                        @keydown.enter.prevent="addStep()" placeholder="e.g., Setup database schema"
                                        class="flex-1 min-w-0 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <button type="button" @click="addStep()"
                                        class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-200 px-3 py-2 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-950/50 p-6 rounded-xl border border-gray-800/80 space-y-4 flex flex-col">
                            <h4 class="text-xs font-bold uppercase tracking-wider text-gray-400">Reference Links</h4>

                            <div class="space-y-2 max-h-40 overflow-y-auto pr-1 empty:hidden">
                                <template x-for="(link, index) in links" :key="index">
                                    <div
                                        class="flex items-center justify-between bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-200">
                                        <span
                                            class="truncate mr-2 text-indigo-400 hover:underline cursor-default select-none"
                                            x-text="link"></span>
                                        <button type="button" @click="removeLink(index)"
                                            class="text-gray-400 hover:text-red-400 p-0.5 rounded transition-colors focus:outline-none"
                                            title="Remove Link">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <div>
                                <label for="link_input" class="block text-sm font-medium text-gray-300 mb-2">Add
                                    Resource Link</label>
                                <div class="flex space-x-2">
                                    <input type="url" id="link_input" x-model="newLink"
                                        @keydown.enter.prevent="addLink()" placeholder="github.com/..."
                                        class="flex-1 min-w-0 bg-gray-800 border border-gray-700 rounded-lg px-3 py-2 text-sm text-gray-100 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                    <button type="button" @click="addLink()"
                                        class="bg-gray-800 hover:bg-gray-700 border border-gray-700 text-gray-200 px-3 py-2 rounded-lg text-sm font-medium transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                                        Add
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="px-8 py-5 bg-gray-950/40 border-t border-gray-800 flex items-center justify-end space-x-4">
                    <button type="button" @click="open = false"
                        class="px-5 py-2.5 text-sm font-medium text-gray-400 hover:text-gray-200 hover:bg-gray-800 rounded-lg transition-colors">
                        Cancel
                    </button>
                    <button type="submit"
                        class="px-6 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-500 rounded-lg shadow-lg shadow-indigo-600/10 transition-colors focus:outline-none focus:ring-2 focus:ring-indigo-500">
                        Create Idea
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
