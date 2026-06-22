<x-layout title="Idea">

    <div class="my-5">
        <div class="flex justify-between items-center">
            <a class="btn btn-outline btn-dash" href="/ideas">Back to Ideas</a>
            <div class="flex items-center gap-x-4">
                <a class="btn btn-outline btn-warning" href="/ideas/{{ $idea->id }}/edit">Edit Idea</a>
                <form action="/ideas/{{ $idea->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-error" type="submit">Delete</button>
                </form>
            </div>
        </div>
        <h3 class="my-5 text-4xl font-bold">{{ $idea->title }}</h3>
        <div class="my-5 flex gap-x-3 items-center">
            <span class="btn btn-outline btn-sm rounded-4xl btn-warning">{{ $idea->status }}</span>
            <span class="btn ">{{ $idea->created_at->diffForHumans() }}</span>
        </div>
        <div class="card bg-slate-800">
            @if ($idea->image_path)
                <figure>
                    <img src="{{ Storage::url($idea->image_path) }}"
                         />
                </figure>
            @endif
            <div class="card-body">
                <p>{{ $idea->description }}</p>
            </div>
        </div>

        <h3 class="my-5 text-3xl font-semibold">Steps</h3>
        @if ($idea->steps->count())
            <div class="space-y-3">
                @foreach ($idea->steps as $step)
                    <div class="card bg-slate-800">
                        <div class="card-body">
                            @props(['step'])

                            <div x-data="{ complated: {{ $step->complated ? 'true' : 'false' }} }"
                                class="flex items-center justify-between bg-gray-900 border rounded-xl p-4 transition-all duration-200"
                                :class="complated ? 'border-emerald-500/30 bg-emerald-950/10' :
                                    'border-gray-800 hover:border-gray-700'">
                                <form action="/steps/{{ $step->id }}" method="POST" x-ref="toggleForm"
                                    class="flex items-center justify-between w-full space-x-4">
                                    @csrf
                                    @method('PATCH')

                                    <label for="step_{{ $step->id }}"
                                        class="text-base select-none cursor-pointer transition-all duration-200 min-w-0 flex-1"
                                        :class="complated ? 'text-gray-500 line-through' : 'text-gray-200 font-medium'">
                                        {{ $step->description }}
                                    </label>

                                    <div class="flex items-center shrink-0">
                                        <input type="checkbox" id="step_{{ $step->id }}" name="complated"
                                            x-model="complated" @change="$nextTick(() => $refs.toggleForm.submit())"
                                            class="w-5 h-5 rounded border-gray-700 bg-gray-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-gray-900 focus:ring-offset-2 transition-colors cursor-pointer">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif

        <h3 class="my-5 text-3xl font-semibold">Links</h3>
        @if ($idea->links->count())
            <div class="space-y-3">
                @foreach ($idea->links as $link)
                    <div class="card bg-slate-800">
                        <div class="card-body">
                            <a href="{{ $link }}">{{ $link }}</a>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>

</x-layout>
