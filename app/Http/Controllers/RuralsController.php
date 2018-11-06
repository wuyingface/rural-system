<?php

namespace App\Http\Controllers;

use App\Models\Rural;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RuralRequest;

class RuralsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

	public function index()
	{
		$rurals = Rural::paginate();
		return view('rurals.index', compact('rurals'));
	}

    public function show(Rural $rural)
    {
        return view('rurals.show', compact('rural'));
    }

	public function create(Rural $rural)
	{
		return view('rurals.create_and_edit', compact('rural'));
	}

	public function store(RuralRequest $request)
	{
		$rural = Rural::create($request->all());
		return redirect()->route('rurals.show', $rural->id)->with('message', 'Created successfully.');
	}

	public function edit(Rural $rural)
	{
        $this->authorize('update', $rural);
		return view('rurals.create_and_edit', compact('rural'));
	}

	public function update(RuralRequest $request, Rural $rural)
	{
		$this->authorize('update', $rural);
		$rural->update($request->all());

		return redirect()->route('rurals.show', $rural->id)->with('message', 'Updated successfully.');
	}

	public function destroy(Rural $rural)
	{
		$this->authorize('destroy', $rural);
		$rural->delete();

		return redirect()->route('rurals.index')->with('message', 'Deleted successfully.');
	}
}