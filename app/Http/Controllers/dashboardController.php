<?php
 namespace App\Http\Controllers; use App\Models\accounts; use App\Models\expenses; use App\Models\products; use App\Models\purchase_details; use App\Models\sale_details; use App\Models\sales; use Carbon\Carbon; use Illuminate\Container\Attributes\DB; use Illuminate\Http\Request; class dashboardController extends Controller { public function index() { $months = array(); for ($i = 0; $i < 12; $i++) { $date = Carbon::now()->subMonths($i); $firstDay = $date->copy()->firstOfMonth()->toDateString(); $lastDay = $date->copy()->lastOfMonth()->toDateString(); $monthName = $date->format("\x4d"); $months[] = array("\x66\x69\x72\163\164" => $firstDay, "\x6c\x61\163\164" => $lastDay, "\x6e\x61\155\145" => $monthName); } $months = array_reverse($months); $sales = array(); $monthNames = array(); $expenses = array(); $products = products::all(); $profits = array(); $last_sale = 0; $last_expense = 0; $last_profit = 0; foreach ($months as $key => $month) { $first = $month["\146\x69\x72\163\164"]; $last = $month["\154\141\163\x74"]; $sale = sales::whereBetween("\144\141\164\145", array($first, $last))->count(); $expense = expenses::whereBetween("\144\141\164\x65", array($first, $last))->sum("\x61\155\x6f\x75\156\164"); $sales[] = $sale; $expenses[] = $expense; $monthNames[] = $month["\x6e\141\x6d\x65"]; $profit = 0; foreach ($products as $product) { $purchases = purchase_details::where("\x70\x72\157\x64\165\x63\x74\111\104", $product->id)->whereBetween("\x64\141\x74\145", array($first, $last)); $purchases_amount = $purchases->sum("\141\x6d\157\x75\156\164"); $purchases_qty = $purchases->sum("\161\164\171"); $purchase_qty = $purchases_qty; if ($purchase_qty > 0) { $purchase_price = $purchases_amount / $purchase_qty; } else { $purchase_price = 0; } $sales1 = sale_details::where("\x70\162\x6f\x64\x75\143\x74\x49\104", $product->id)->whereBetween("\x64\141\164\145", array($first, $last)); $sales_amount = $sales1->sum("\141\x6d\x6f\165\156\x74"); $sales_qty = $sales1->sum("\161\164\171"); if ($sales_qty > 0) { $sale_price = $sales_amount / $sales_qty; } else { $sale_price = 0; } $ppi = $sale_price - $purchase_price; $ppp = $ppi * $sales_qty; $profit += $ppp; } $profits[] = $profit - $expense; $last_sale = $sale; $last_expense = $expense; $last_profit = $profit; } $topProducts = products::withSum("\x73\x61\x6c\145\104\145\164\141\x69\154\163", "\x71\x74\x79")->withSum("\x73\x61\154\145\x44\145\x74\x61\151\x6c\x73", "\141\155\x6f\x75\156\164")->orderByDesc("\x73\x61\154\145\x5f\144\145\x74\141\x69\x6c\163\x5f\163\x75\155\137\x71\164\x79")->take(5)->get(); $topProductsArray = array(); foreach ($topProducts as $product) { $stock = getStock($product->id); $price = avgSalePrice("\141\154\154", "\x61\x6c\154", $product->id); $topProductsArray[] = array("\156\x61\155\145" => $product->name, "\x70\x72\151\x63\x65" => $price, "\x73\164\x6f\x63\153" => $stock, "\141\x6d\x6f\x75\156\x74" => $product->sale_details_sum_amount, "\163\x6f\x6c\144" => $product->sale_details_sum_qty); } $topCustomers = accounts::where("\x74\171\160\x65", "\103\165\x73\x74\x6f\155\x65\x72")->withSum("\x73\x61\154\x65", "\x74\157\x74\x61\x6c")->orderByDesc("\163\x61\154\145\x5f\x73\x75\155\137\x74\x6f\x74\x61\154")->take(5)->get(); $topCustomersArray = array(); foreach ($topCustomers as $customer) { if ($customer->id != 2) { $balance = getAccountBalance($customer->id); $customer_purchases = $customer->sale_sum_total; $topCustomersArray[] = array("\156\141\x6d\145" => $customer->title, "\160\165\x72\143\150\x61\x73\x65\163" => $customer_purchases, "\142\141\x6c\x61\156\x63\145" => $balance); } } return view("\x64\x61\163\x68\142\157\141\162\x64\x2e\151\x6e\144\145\x78", compact("\163\141\x6c\x65\163", "\155\157\x6e\x74\150\116\141\x6d\x65\163", "\145\x78\x70\145\x6e\163\145\163", "\x70\162\157\x66\151\164\163", "\154\141\163\164\x5f\163\x61\x6c\x65", "\154\141\163\164\137\x65\x78\160\x65\x6e\163\x65", "\154\x61\163\x74\137\160\x72\x6f\x66\151\x74", "\164\x6f\x70\x50\x72\x6f\144\165\x63\x74\x73\x41\162\162\141\171", "\164\157\160\x43\165\x73\x74\x6f\x6d\145\162\163\101\162\162\141\x79")); } }