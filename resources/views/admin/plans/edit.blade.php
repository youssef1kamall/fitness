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
    .slide-background:hover {
        color: white !important;
    }
</style>
<div class="container mx-auto py-8 max-w-lg">
    <h1 class="text-2xl font-bold mb-6">Edit Membership Plan</h1>
    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST" class="bg-white p-6 rounded shadow">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Name</label>
            <input type="text" name="name" value="{{ old('name', $plan->name) }}" class="w-full border rounded px-3 py-2 @error('name') border-red-500 @enderror" required>
            @error('name')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Price</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $plan->price) }}" class="w-full border rounded px-3 py-2 @error('price') border-red-500 @enderror" required>
            @error('price')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Features (one per line)</label>
            <textarea name="features" rows="4" class="w-full border rounded px-3 py-2 @error('features') border-red-500 @enderror" required>{{ old('features', is_array($plan->features) ? implode("\n", $plan->features) : $plan->features) }}</textarea>
            @error('features')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="mb-4">
            <label class="block mb-1 font-semibold">Status</label>
            <select name="status" class="w-full border rounded px-3 py-2 @error('status') border-red-500 @enderror" required>
                <option value="active" {{ old('status', $plan->status) == 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ old('status', $plan->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('status')<div class="text-red-500 text-sm mt-1">{{ $message }}</div>@enderror
        </div>
        <div class="flex justify-between items-center">
            <a href="{{ route('admin.plans.index') }}" class="bg-white text-black border border-black px-4 py-2 rounded slide-background slide-background-black">Back</a>
            <button type="submit" class="bg-white text-black border border-black font-bold py-2 px-4 rounded slide-background slide-background-black">Update Plan</button>
        </div>
    </form>
</div>
@endsection 