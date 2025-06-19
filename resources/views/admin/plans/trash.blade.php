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
    .slide-background-green::before {
        background: rgb(34, 197, 94);
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
</style>
<div class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Deleted Membership Plans (Trash)</h1>
        <a href="{{ route('admin.plans.index') }}" class="action-button bg-white text-black border border-black slide-background slide-background-black">Back to Plans</a>
    </div>
    
    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded transition-all duration-300 ease-in-out">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded transition-all duration-300 ease-in-out">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-200">
            <thead>
                <tr>
                    <th class="py-2 px-4 border-b">ID</th>
                    <th class="py-2 px-4 border-b">Name</th>
                    <th class="py-2 px-4 border-b">Price</th>
                    <th class="py-2 px-4 border-b">Features</th>
                    <th class="py-2 px-4 border-b">Deleted At</th>
                    <th class="py-2 px-4 border-b">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($plans->sortBy('id') as $plan)
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
                        <td class="py-2 px-4 border-b">{{ $plan->deleted_at->format('Y-m-d H:i:s') }}</td>
                        <td class="py-2 px-4 border-b">
                            <div class="flex justify-center items-center space-x-2">
                                <a href="{{ route('admin.plans.edit', $plan->id) }}" class="action-button bg-white text-black border border-black slide-background slide-background-black">Edit</a>
                                <form action="{{ route('admin.plans.restore', $plan->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="action-button bg-white text-green-500 border border-green-500 slide-background slide-background-green">Restore</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="6" class="py-4 text-center">No deleted plans found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection 