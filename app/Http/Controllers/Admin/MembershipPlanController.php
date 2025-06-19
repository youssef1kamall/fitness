<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MembershipPlan;
use Illuminate\Validation\Rule;

class MembershipPlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // List all membership plans (including soft deleted for admin)
        $plans = MembershipPlan::withTrashed()->orderByDesc('created_at')->get();
        return view('admin.plans.index', compact('plans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Show form to create a new plan
        return view('admin.plans.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate and store a new plan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'features' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);
        // Convert features textarea (one per line) to JSON array
        $validated['features'] = preg_split('/\r?\n/', trim($validated['features']));
        MembershipPlan::create($validated);
        return redirect()->route('admin.plans.index')->with('success', 'Membership plan created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Show form to edit a plan
        $plan = MembershipPlan::withTrashed()->findOrFail($id);
        // Convert features array to string for textarea
        if (is_array($plan->features)) {
            $plan->features = implode("\n", $plan->features);
        }
        return view('admin.plans.edit', compact('plan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate and update a plan
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'features' => 'required',
            'status' => ['required', Rule::in(['active', 'inactive'])],
        ]);
        // Convert features textarea (one per line) to JSON array
        $validated['features'] = preg_split('/\r?\n/', trim($validated['features']));
        $plan = MembershipPlan::withTrashed()->findOrFail($id);
        $plan->update($validated);
        return redirect()->route('admin.plans.index')->with('success', 'Membership plan updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Soft delete a plan
        $plan = MembershipPlan::findOrFail($id);
        $plan->delete();
        return redirect()->route('admin.plans.index')->with('success', 'Your membership plan has been deleted. To restore it, please visit the trash and select the option to recover.');
    }

    // Bonus: Status toggle (AJAX or form)
    public function toggleStatus($id)
    {
        $plan = MembershipPlan::withTrashed()->findOrFail($id);
        $plan->status = $plan->status === 'active' ? 'inactive' : 'active';
        $plan->save();
        return redirect()->route('admin.plans.index')->with('success', 'Plan status updated.');
    }

    // Show soft-deleted plans (trash)
    public function trash()
    {
        try {
            $plans = MembershipPlan::onlyTrashed()->orderByDesc('deleted_at')->get();
            return view('admin.plans.trash', compact('plans'));
        } catch (\Exception $e) {
            return back()->with('error', 'Error loading trash: ' . $e->getMessage());
        }
    }

    // Restore a soft-deleted plan
    public function restore($id)
    {
        $plan = MembershipPlan::onlyTrashed()->findOrFail($id);
        $plan->restore();
        return redirect()->route('admin.plans.trash')->with('success', 'Membership plan restored successfully.');
    }
}
