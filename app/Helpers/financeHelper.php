<?php
 use App\Models\ref; use App\Models\transactions; goto APukd; HOCUu: function getAccountBalance($id) { $transactions = transactions::where("\x61\143\143\x6f\x75\156\x74\111\104", $id); $cr = $transactions->sum("\x63\162"); $db = $transactions->sum("\144\142"); $balance = $cr - $db; return $balance; } goto v2_gr; APukd: function createTransaction($accountID, $date, $cr, $db, $notes, $ref) { transactions::create(array("\141\143\143\x6f\x75\x6e\164\x49\104" => $accountID, "\x64\141\x74\145" => $date, "\143\x72" => $cr, "\x64\x62" => $db, "\x6e\x6f\x74\145\163" => $notes, "\x72\145\146\x49\x44" => $ref)); } goto HOCUu; bMRxO: function spotBalanceBefore($id, $ref) { $cr = transactions::where("\x61\143\143\157\x75\x6e\164\111\104", $id)->where("\162\x65\146\111\x44", "\x3c", $ref)->sum("\x63\x72"); $db = transactions::where("\x61\x63\x63\x6f\165\x6e\x74\111\x44", $id)->where("\162\x65\146\111\104", "\x3c", $ref)->sum("\x64\142"); return $balance = $cr - $db; } goto T8XcD; v2_gr: function numberToWords($number) { $f = new NumberFormatter("\x65\156", NumberFormatter::SPELLOUT); return ucfirst($f->format($number)); } goto bMRxO; T8XcD: function spotBalance($id, $ref) { $cr = transactions::where("\141\143\143\157\165\156\164\111\104", $id)->where("\162\x65\146\x49\x44", "\x3c\75", $ref)->sum("\x63\162"); $db = transactions::where("\141\143\143\157\x75\x6e\x74\x49\x44", $id)->where("\x72\145\146\x49\x44", "\74\75", $ref)->sum("\x64\142"); return $balance = $cr - $db; }