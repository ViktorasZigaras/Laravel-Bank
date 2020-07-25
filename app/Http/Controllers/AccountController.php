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
    
    public function index()
    {
        # it is possible that there will be no entries, but that's for later
        $currency = Currency::all()->first();
        $time = time();
        if ($time - strtotime($currency->updated_at) > 3600) {
            $call = curl_init(); 
            curl_setopt($call, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?symbols=USD');
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1); 
            $output = json_decode(curl_exec($call)); 
            curl_close($call);
            $currency->rate = $output->rates->USD;
            $currency->updated_at = date($time);
            $currency->save();
        }
        $accounts = Account::all()->sortBy('surname');
        $rate = $currency->rate;
        $role = User::find(Auth::id())->role ?? 'none';
        #
        return view('account.index', compact('accounts', 'rate', 'role'));
    }

    public function add(ValueRequest $request, Account $account)
    {
        #
        if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        $account->value += $request->value;
        $account->save();
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' added.');
    }

    public function remove(ValueRequest $request, Account $account)
    {
        #
        if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        if ($request->value > $account->value) return redirect()->back()->withErrors('Can\'t remove more than account has.');
        $account->value -= $request->value;
        $account->save();
        return redirect()->back()->with('success_message', 'Amount ' . $request->value . ' removed.');
    }

    private $numbers = ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9'];

    private function generatePersonID() {
        $person_id = '';
        for ($i = 0; $i < 11; $i++) { 
            $person_id .= $this->numbers[rand(0, count($this->numbers) - 1)];
        }
        return $person_id;
    }

    private function generateAccountID() {
        $account_id = 'LT';
        for ($i = 0; $i < 20; $i++) { 
            $account_id .= $this->numbers[rand(0, count($this->numbers) - 1)];
        }
        return $account_id;
    }

    public function create()
    {
        #
        return view('account.create', [
            'newUuid' => (string) Uuid::uuid4(),
            'newName' => 'name ' . rand(1, 50),
            'newSurname' => 'surname ' . rand(1, 50),
            'newAccount' => $this->generateAccountID(),
            'newPersonID' => $this->generatePersonID(),
            'newValue' => 0
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
        $account->fill($request->all());
        return redirect()->route('account.index')->with('success_message', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        #
        if ($account->value !== 0) {
            return redirect()->back()->withErrors('Account has to be empty.');
        } else {
            $account->delete();
            return redirect()->back()->with('success_message', 'Account deleted.');
        }
    }

    ###

    public function indexJS()
    {
        return view('layouts.appJS');
    }

    public function indexJSdata()
    {
        # it is possible that there will be no entries, but that's for later
        $currency = Currency::all()->first();
        $time = time();
        if ($time - strtotime($currency->updated_at) > 3600) {
            $call = curl_init(); 
            curl_setopt($call, CURLOPT_URL, 'https://api.exchangeratesapi.io/latest?symbols=USD');
            curl_setopt($call, CURLOPT_RETURNTRANSFER, 1); 
            $output = json_decode(curl_exec($call)); 
            curl_close($call);
            $currency->rate = $output->rates->USD;
            $currency->updated_at = date($time);
            $currency->save();
        }
        $accounts = Account::all()->sortBy('surname');
        $rate = $currency->rate;
        $role = User::find(Auth::id())->role ?? 'none';
        #
        return json_encode(compact('accounts', 'rate', 'role'));
    }
}