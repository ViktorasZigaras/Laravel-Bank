<?php

namespace App\Http\Controllers;

use App\Account;
use Illuminate\Http\Request;
use Validator;

class AccountController extends Controller
{
    public function index()
    {
        #
        return view('account.index', ['accounts' => Account::all()->sortBy('surname')]);
    }

    public function create()
    {
        #
        return view('account.create');
    }

    public function store(Request $request)
    {
        #
        $validator = Validator::make($request->all(),
        [
            'uuid' => ['required', 'min:36', 'max:36'],
            'account' => ['required', 'min:22', 'max:22'],
            'personal_code' => ['required', 'min:11', 'max:11'],
            'name' => ['required', 'min:4', 'max:32'],
            'surname' => ['required', 'min:4', 'max:32'],
            'value' => ['required'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // $account = Account::create($request->all());
        // $account->save();
        Account::create($request->all())->save();
        return redirect()->route('account.index')->with('success_message', '<Account Created>');
    }

    public function show(Account $account)
    {
        #
        // $a = Book::where('name', 'ona')->first();
        // return view show
    }

    public function edit(Account $account)
    {
        #
        return view('account.edit', ['account' => $account]);
    }

    public function update(Request $request, Account $account)
    {
        #
        $validator = Validator::make($request->all(),
        [
            'uuid' => ['required', 'min:36', 'max:36'],
            'account' => ['required', 'min:22', 'max:22'],
            'personal_code' => ['required', 'min:11', 'max:11'],
            'name' => ['required', 'min:8', 'max:32'],
            'surname' => ['required', 'min:8', 'max:32'],
            'value' => ['required'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // $account->fill($request->all());
        // $account->save();
        $account->fill($request->all())->save();
        return redirect()->route('account.index')->with('success_message', '<Account Updated>');
    }

    public function destroy(Account $account)
    {
        #
        $account->delete();
        return redirect()->route('account.index')->with('success_message', '<Account Deleted>');
    }
}
