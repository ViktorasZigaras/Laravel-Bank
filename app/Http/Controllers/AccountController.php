<?php

namespace App\Http\Controllers;

use App\Account;
use App\Currency;
use Illuminate\Http\Request;
use Validator;
use Ramsey\Uuid\Uuid;
use Auth;
use App\User;

class AccountController extends Controller
{
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
        #
        return view('account.index', ['accounts' => Account::all()->sortBy('surname'), 'rate' => $currency->rate, 'role' => User::find(Auth::id())->role ?? 'none']);
    }

    public function add(Request $request, Account $account)
    {
        #
        $validator = Validator::make($request->all(),
        [
            'value' => ['required'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        $account->value += $request->value;
        $account->save();
        return redirect()->route('account.index')->with('success_message', 'Amount ' . $request->value . ' added.');
    }

    public function remove(Request $request, Account $account)
    {
        #
        $validator = Validator::make($request->all(),
        [
            'value' => ['required'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        if ($request->value < 0) return redirect()->back()->withErrors('Negative value can\'t be provided.');
        if ($request->value > $account->value) return redirect()->back()->withErrors('Can\'t remove more than account has.');
        $account->value -= $request->value;
        $account->save();
        return redirect()->route('account.index')->with('success_message', 'Amount ' . $request->value . ' removed.');
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
        return redirect()->route('account.index')->with('success_message', 'Account created.');
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
            // 'uuid' => ['required', 'min:36', 'max:36'],
            'account' => ['required', 'min:22', 'max:22'],
            'personal_code' => ['required', 'min:11', 'max:11'],
            'name' => ['required', 'min:8', 'max:32'],
            'surname' => ['required', 'min:8', 'max:32'],
            // 'value' => ['required'],
        ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        // $account->fill($request->all());
        // $account->save();
        $account->fill($request->all())->save();
        return redirect()->route('account.index')->with('success_message', 'Account updated.');
    }

    public function destroy(Account $account)
    {
        #
        if ($account->value !== 0) {
            return redirect()->back()->withErrors('Account has to be empty.');
        } else {
            $account->delete();
            return redirect()->route('account.index')->with('success_message', 'Account deleted.');
        }
    }
}
