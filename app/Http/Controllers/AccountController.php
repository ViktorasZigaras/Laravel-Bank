<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Currency;
use Illuminate\Http\Request; #?
use Validator; #?
use Ramsey\Uuid\Uuid;
use Auth;
use App\Models\User;
use App\Http\Requests\StoreRequest;
use App\Http\Requests\ValueRequest;
use App\Http\Requests\UpdateRequest;

class AccountController extends Controller
{

    public function __construct()
    {
        # is needed for demanding to be logged in
        $this->middleware('auth');
    }

    public function indexData()
    {
        # it is possible that there will be no entries, but that's for later
        $currency = Currency::find(1);
        $time = time();
        if ($time - strtotime($currency->updated_at) > 3600) {
            $call = curl_init(); 
            curl_setopt($call, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?symbols=USD');
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1); 
            $json = json_decode(curl_exec($call)); 
            curl_close($call);
            $currency->rate = $json->rates->USD;
            $currency->updated_at = date($time);
            $currency->save();
        }
        $accounts = Account::all()->sortBy('surname');
        $rate = $currency->rate;
        $role = User::find(Auth::id())->role ?? User::ROLE_NONE;

        return compact('accounts', 'rate', 'role');
    }
    
    public function index()
    {
        #
        return view('account.index', $this->indexData());
    }

    public function add(ValueRequest $request, Account $account)
    {
        #
        // if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        $account->value += $request->value;
        $account->save();
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' added.');
    }

    public function remove(ValueRequest $request, Account $account)
    {
        #
        // if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        # remove later
        if ($request->value > $account->value) return redirect()->back()->withErrors('Can\'t remove more than account has.');
        $account->value -= $request->value;
        $account->save();
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' removed.');
    }

    private function generateNumber(int $length = 0) {
        $numbers = range(0, 9);
        $number = '';
        for ($i = 0; $i < $length; $i++) { 
            $number .= $numbers[rand(0, count($numbers) - 1)];
        }
        return $number;
    }

    public function create()
    {
        #
        return view('account.create', [
            'newUuid'     => (string) Uuid::uuid4(),
            'newName'     => (string) 'name ' . rand(1, 50),
            'newSurname'  => (string) 'surname ' . rand(1, 50),
            'newAccount'  => (int)    $this->generateNumber(11),
            'newPersonID' => (int)    'LT' . $this->generateNumber(20),
            'newValue'    => (int)    0,
        ]);
    }

    public function store(StoreRequest $request)
    {
        #
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
        #
        return view('account.edit', ['account' => $account]);
    }

    public function update(UpdateRequest $request, Account $account)
    {
        #
        $account->fill($request->all())->save();
        return redirect()->route('account.index')->with('success_message', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        #
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
    }

    public function editJS(Account $account)
    {
        #
        return $account;
    }

    public function indexJSdata()
    {
        #
        return $this->indexData();
    }

    public function updateJS(UpdateRequest $request, Account $account)
    {
        #
        $account->fill($request->all())->save();
        // return redirect()->route('account.index')->with('success_message', 'Account updated.');
        return 'updated';
    }

    public function destroyJS(Account $account)
    {
        #
        if (!$account->canDelete()) {
            return 'can\'t delete';
            // return redirect()->back()->withErrors('Account has to be empty.');
        }
        $account->delete();
        // return redirect()->back()->with('success_message', 'Account deleted.');
        return 'deleted';
    }

    public function addJS(ValueRequest $request, Account $account)
    {
        #
        # test why negatives does not work
        $account->value += $request->value;
        $account->save();
        return 'Amount ' . $request->value . ' added.';
    }

    public function removeJS(ValueRequest $request, Account $account)
    {
        #
        # test why negatives does not work
        # remove later
        if ($request->value > $account->value) return 'Can\'t remove more than account has.';
        $account->value -= $request->value;
        $account->save();
        return 'Amount ' . $request->value . ' removed.';
    }
}