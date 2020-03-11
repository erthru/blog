<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Writer;
use App\Quote;

class QuoteController extends Controller
{
    public function DashboardQuoteView(Request $request)
    {
        if(!$request->session()->has("id")){
            return redirect("/dashboard/login");
        }

        $writer = Writer::find($request->session()->get("id"));
        $quotes = Quote::with("writer")->orderBy("id", "DESC")->paginate(10);

        if(!empty($request->query("query"))){
            $quotes = Quote::with("writer")
            ->where("quote", "LIKE", "%" . $request->query("query") . "%")
            ->orderBy("id", "DESC")
            ->take(10)
            ->get();
        }

        $data = [
            "writer" => $writer,
            "quotes" => $quotes
        ];

        return view("dashboard.quote", $data);
    }

    public function DashboardQuoteAddView(Request $request)
    {
        if(!$request->session()->has("id")){
            return redirect("/dashboard/login");
        }

        $writer = Writer::find($request->session()->get("id"));

        $data = [
            "writer" => $writer
        ];

        return view("dashboard.quote_add", $data);
    }

    public function AddAction(Request $request)
    {
        if(!$request->session()->has("id")){
            return redirect("/dashboard/login");
        }

        $this->validate($request, [
            "quote" => "required",
        ],$this->validationErrorMsg());

        $writer = Writer::find($request->session()->get("id"));

        $body = [
            "quote" => $request->input("quote"),
            "writer_id" => $writer->id
        ];

        Quote::create($body);

        return redirect("/dashboard/quote")->with("successMsg", "Quote ditambahkan");
    }
}
