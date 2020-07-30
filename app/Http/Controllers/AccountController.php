<?php

namespace App\Http\Controllers;

use App\Models\Account;
// use Illuminate\Http\Request; #?
// use Validator; #?
use App\Http\Requests\StoreRequest;
use App\Http\Requests\ValueRequest;
use App\Http\Requests\UpdateRequest;

use App\Services\AccountService;

class AccountController extends Controller
{

    public function __construct()
    {
        # is needed for demanding to be logged in
        $this->middleware('auth');
    }
    
    public function index(AccountService $accountService)
    {
        return view('account.index', $accountService->indexData());
    }

    public function add(AccountService $accountService, ValueRequest $request, Account $account)
    {
        $accountService->add($account, $request);
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' added.');
    }

    public function remove(AccountService $accountService, ValueRequest $request, Account $account)
    {
        $accountService->remove($account, $request);
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' removed.');
    }

    public function create(AccountService $accountService)
    {
        return view('account.create', $accountService->generateNewAccount());
    }

    public function store(StoreRequest $request)
    {
        Account::create($request->all());
        return redirect()->route('account.index')->with('success_message', 'Account created.');
    }

    public function show(Account $account)
    {
        # unused in this project
        // $a = Book::where('name', 'ona')->first();
        // $account = Account::find($id);
        // return view show
    }

    public function edit(Account $account)
    {
        return view('account.edit', ['account' => $account]);
    }

    public function update(UpdateRequest $request, Account $account)
    {
        $account->fill($request->all())->save();
        return redirect()->route('account.index')->with('success_message', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        if (!$account->canDelete()) {
            return redirect()->back()->withErrors('Account has to be empty.');
        }
        $account->delete();
        return redirect()->back()->with('success_message', 'Account deleted.');
    }

    ###

    public function indexJS()
    {
        return view('layouts.appJS');
        # how to load and pass values at same time without axios???
        // return view('layouts.appJS', $account->indexData());
    }

    public function indexJSdata(AccountService $accountService)
    {
        return $accountService->indexData();
    }

    public function editJS(Account $account)
    {
        return $account;
    }

    public function updateJS(UpdateRequest $request, Account $account)
    {
        $account->fill($request->all())->save();
        return 'Account updated.';
    }

    public function destroyJS(Account $account)
    {
        if (!$account->canDelete()) {
            return 'can\'t delete';
        }
        $account->delete();
        return 'Account deleted.';
    }

    public function addJS(AccountService $accountService, ValueRequest $request, Account $account)
    {
        $accountService->add($account, $request);
        return 'Amount ' . $request->value . ' added.';
    }

    public function removeJS(AccountService $accountService, ValueRequest $request, Account $account)
    {
        $accountService->remove($account, $request);
        return 'Amount ' . $request->value . ' removed.';
    }

    public function createJS(AccountService $accountService)
    {
        return $accountService->generateNewAccount();
    }

    public function storeJS(StoreRequest $request)
    {
        Account::create($request->all());
        return 'Account created.';
    }
}