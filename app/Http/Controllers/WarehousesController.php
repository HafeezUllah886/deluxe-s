<?php
 namespace App\Http\Controllers; use App\Models\warehouses; use Illuminate\Http\Request; use Illuminate\Support\Facades\DB; class WarehousesController extends Controller { public function index() { $warehouses = warehouses::all(); return view("\x77\x61\x72\x65\x68\x6f\165\163\x65\x73\56\x69\x6e\x64\x65\x78", compact("\167\x61\x72\145\x68\x6f\x75\163\x65\163")); } public function create() { } public function store(Request $request) { warehouses::create($request->all()); return back()->with("\x73\165\143\x63\145\x73\163", "\127\141\162\145\x68\157\165\x73\145\x20\x43\162\x65\141\164\x65\x64"); } public function show(warehouses $warehouses) { } public function edit(warehouses $warehouses) { } public function update(Request $request, warehouses $warehouse) { $warehouse->update($request->all()); return back()->with("\163\x75\143\143\145\x73\163", "\127\141\162\x65\x68\x6f\165\163\145\x20\125\160\144\x61\164\145\144"); } public function destroy(warehouses $warehouses) { } }