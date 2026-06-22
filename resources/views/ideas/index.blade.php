<x-layout title="Ideas | Explore Your Ideas">
    <div>
        <h1 class="text-4xl my-10 text-center">Ideas</h1>
        <div class="my-5">
            <x-idea-modal></x-idea-modal>
        </div>
        <div class="my-5 flex justify-start items-center gap-4">
            <a class="btn {{ !request('status') ? 'btn-pirmary pointer-events-none': '' }}" href="/ideas">All <span class="text-sm text-white ps-3">{{ $statusCount->get('all') }}</span></a>
            @foreach (App\IdeaStatus::cases() as $status )
                 <a class="btn {{ request('status') ===  $status->value ? ' btn-primary pointer-events-none': '' }}" href="/ideas?status={{ $status->value }}">{{ $status->value }} <span class="text-sm text-white ps-3">{{ $statusCount->get($status->value) }}</span></a>
            @endforeach
            
        </div>
        <div class="grid md:grid-cols-3 gap-5">
             @forelse ($ideas as $idea)
            <a href="/ideas/{{ $idea->id }}" class="card bg-base-300 w-96 shadow-sm">
                
                <div class="card-body">
                    <h2 class="card-title">
                        {{ $idea->title }}
                        
                    </h2>
                    <x-status-badge  status="{{ $idea->status }}" :disabled="request('status') === $idea->status->value"></x-status-badge>
                    <p>{{ $idea->description }}s</p>
                    <div class="card-actions justify-end">
                        <p>Created At {{ $idea->created_at->diffforhumans() }}</p>
                    </div>
                </div>
            </a>

        @empty
            <h2>You do not have any idea</h2>
        @endforelse
        </div>
       
    </div>
</x-layout>
