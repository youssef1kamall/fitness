@extends('layouts.app')

@section('content')
<style>
    .slide-background {
        position: relative;
        overflow: hidden;
        z-index: 1;
        transition: color 0.3s ease;
    }
    .slide-background::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        transition: all 0.3s ease;
        z-index: -1;
    }
    .slide-background:hover::before {
        left: 0;
    }
    .slide-background-black::before {
        background: black;
    }
    .slide-background-red::before {
        background: rgb(239, 68, 68);
    }
    .slide-background:hover {
        color: white !important;
    }
    .action-button {
        display: inline-block;
        padding: 0.5rem 1rem;
        border-radius: 0.375rem;
        font-weight: 500;
        text-align: center;
        min-width: 80px;
    }
    .button-container {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        align-items: center;
    }
</style>
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Membership Plans</h1>
        @if(auth()->user() && auth()->user()->is_admin)
        <div class="flex space-x-4">
            <a href="{{ route('admin.plans.create') }}" class="action-button bg-white text-black border border-black slide-background slide-background-black">Add Plan</a>
            <a href="{{ route('admin.plans.trash') }}" class="action-button bg-white text-black border border-black slide-background slide-background-black">View Trash</a>
        </div>
        @endif
    </div>
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded transition-all duration-300 ease-in-out">{{ session('success') }}</div>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Features</th>
                    <th class="py-2 px-4 border-b">Status</th>
                    @if(auth()->user() && auth()->user()->is_admin)
                    <th class="py-2 px-4 border-b">Actions</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                @forelse($plans->sortBy('id') as $plan)
                    @if(!$plan->trashed())
                    <tr class="text-center {{ $loop->even ? 'bg-gray-50' : 'bg-white' }}">
                        <td class="py-2 px-4 border-b">{{ $plan->id }}</td>
                        <td class="py-2 px-4 border-b">{{ $plan->name }}</td>
                        <td class="py-2 px-4 border-b">${{ number_format($plan->price, 2) }}</td>
                        <td class="py-2 px-4 border-b text-left">
                            <ul class="list-disc list-inside">
                                @foreach((array)$plan->features as $feature)
                                    <li>{{ $feature }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="py-2 px-4 border-b">
                            @if(auth()->user() && auth()->user()->is_admin)
                            <form action="{{ route('admin.plans.toggle-status', $plan->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-3 py-1 rounded {{ $plan->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }} transition-all duration-300 ease-in-out">
                                    {{ ucfirst($plan->status) }}
                                </button>
                            </form>
                            @else
                                <span class="px-3 py-1 rounded {{ $plan->status === 'active' ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                    {{ ucfirst($plan->status) }}
                                </span>
                            @endif
                        </td>
                        @if(auth()->user() && auth()->user()->is_admin)
                        <td class="py-2 px-4 border-b">
                            <div class="button-container">
                                <a href="{{ route('admin.plans.edit', $plan->id) }}" class="action-button bg-white text-black border border-black slide-background slide-background-black">Edit</a>
                                <form action="{{ route('admin.plans.destroy', $plan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-button bg-white text-red-500 border border-red-500 slide-background slide-background-red">Delete</button>
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endif
                @empty
                    <tr><td colspan="6" class="py-4 text-center">No plans found.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="block sm:hidden text-xs text-gray-500 mt-2 text-center">Scroll to see the rest of the table content</div>
    </div>
</div>
@endsection 