<?php
 namespace App\Http\Controllers; use App\Models\accounts; use App\Models\expenseCategories; use App\Models\expenses; use App\Models\transactions; use Illuminate\Http\Request; use Illuminate\Support\Facades\DB; class ExpensesController extends Controller { public function index() { $expenses = expenses::orderby("\151\144", "\x64\145\x73\x63")->get(); $accounts = accounts::business()->get(); $categories = expenseCategories::all(); return view("\x46\151\x6e\x61\156\x63\145\56\x65\x78\x70\x65\156\x73\x65\x2e\x69\156\x64\x65\x78", compact("\145\x78\160\x65\x6e\163\145\163", "\141\x63\x63\x6f\x75\x6e\x74\163", "\143\141\x74\145\x67\x6f\x72\x69\x65\x73")); } public function create() { } public function store(Request $request) { try { DB::beginTransaction(); $ref = getRef(); expenses::create(array("\141\143\143\x6f\x75\x6e\x74\x49\104" => $request->accountID, "\x63\141\164\111\x44" => $request->catID, "\141\155\x6f\165\156\164" => $request->amount, "\144\x61\x74\x65" => $request->date, "\156\157\164\145\163" => $request->notes, "\162\145\146\x49\x44" => $ref)); createTransaction($request->accountID, $request->date, 0, $request->amount, "\x45\x78\x70\x65\x6e\x73\145\x20\55\40" . $request->notes, $ref); DB::commit(); return back()->with("\163\x75\x63\143\145\x73\x73", "\105\x78\160\145\156\163\145\x20\x53\x61\166\145\144"); } catch (\Exception $e) { DB::rollBack(); return back()->with("\x65\x72\x72\x6f\162", $e->getMessage()); } } public function show(expenses $expenses) { } public function edit(expenses $expenses) { } public function update(Request $request, expenses $expenses) { } public function delete($ref) { try { DB::beginTransaction(); expenses::where("\x72\x65\146\x49\104", $ref)->delete(); transactions::where("\162\x65\146\111\x44", $ref)->delete(); DB::commit(); session()->forget("\143\x6f\156\x66\151\x72\155\145\x64\137\x70\141\x73\x73\167\x6f\x72\x64"); return redirect()->route("\145\x78\x70\145\156\163\x65\x73\56\x69\156\144\145\170")->with("\163\165\x63\143\145\x73\x73", "\x45\170\x70\x65\x6e\163\x65\40\x44\x65\154\145\164\x65\x64"); } catch (\Exception $e) { DB::rollBack(); session()->forget("\143\x6f\x6e\146\151\162\x6d\145\x64\x5f\160\141\163\163\167\x6f\162\x64"); return redirect()->route("\x65\170\x70\x65\156\x73\145\163\56\151\156\x64\x65\x78")->with("\x65\x72\162\157\x72", $e->getMessage()); } } }